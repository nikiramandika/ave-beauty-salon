<?php

namespace App\Http\Controllers;

use App\Models\Cashier;
use App\Models\Category;
use App\Models\Product;
use App\Models\Promo;
use App\Models\Refund;
use App\Models\SellingInvoice;
use App\Models\Treatment;
use App\Models\User;
use DB;
use Illuminate\Http\Request;

class CashierController extends Controller
{
    /**
     * Display a listing of cashiers.
     */
    public function index()
    {
        $cashiers = Cashier::with('user')->paginate(10);
        return view('owner.pages.cashiers.cashiers', compact('cashiers'));
    }


    /**
     * Show the form for editing the specified cashier.
     */
    public function edit($cashierId)
    {
        $cashier = Cashier::with('user')->findOrFail($cashierId);
        return view('owner.pages.cashiers.cashiers-edit', compact('cashier'));
    }

    /**
     * Update the specified cashier.
     */
    public function update(Request $request, $cashierId)
    {
        // Validate the request data
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'is_active' => 'required|boolean',
        ]);

        // Find the cashier and update the details
        $cashier = Cashier::with('user')->findOrFail($cashierId);

        // Update user details
        $cashier->user->nama_depan = $request->first_name;
        $cashier->user->nama_belakang = $request->last_name;
        $cashier->is_active = $request->is_active;

        // Save both user and cashier changes
        $cashier->user->save();
        $cashier->save();

        return redirect()->route('cashiers.index')->with('success', 'Cashier updated successfully');
    }
    /**
     * Remove the specified cashier from storage.
     */
    public function destroy($cashierId)
    {
        $cashier = Cashier::findOrFail($cashierId);
        $cashier->delete();

        return redirect()->route('cashiers.index')->with('success', 'Cashier deleted successfully');
    }

    public function cashierProduct()
    {
        $products = Product::where('is_active', 1)
            ->with(['details', 'description', 'category'])
            ->get();
        $treatments = Treatment::where('is_active', 1)
            ->with('description')
            ->get();
        $promos = Promo::with('description')
            ->where('is_active', 1)
            ->get();
        $users = User::where('is_active', 1)
            ->where('role', 'User')
            ->select('id', 'nama_depan', 'nama_belakang', 'phone', 'email')
            ->get();
        $categories = Category::all();
        return view('cashier.index', compact('products', 'categories', 'treatments', 'promos', 'users'));
    }

    public function pesananOnline()
    {
        // Ambil semua data invoices
        $invoices = SellingInvoice::with('details')
        ->whereNull('refund_id') // Hanya ambil data yang refund_id-nya NULL
        ->where('recipient_address', '!=', 'Pesanan Offline') // Tidak ambil jika alamat adalah 'Pesanan Offline'
        ->get();    

        // Ambil hanya invoices yang memiliki refund_id
        $refunds = SellingInvoice::whereNotNull('refund_id') // Ambil hanya invoice yang memiliki refund_id
            ->with('refunds') // Pastikan Anda memuat relasi details untuk detail pesanan
            ->get();

        // Kirim kedua data ke view
        return view('cashier.pesanan-online', compact('invoices', 'refunds'));
    }

    public function uploadAdminFile(Request $request, $refundId)
    {
        // Validasi file
        $request->validate([
            'admin_refund_file' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        // Cari data refund berdasarkan ID
        $refund = Refund::findOrFail($refundId);

        // Simpan file ke storage
        $path = $request->file('admin_refund_file')->store('refunds', 'public');

        // Update kolom admin_refund_file
        $refund->admin_refund_file = $path;
        $refund->save();

        return redirect()->back()->with('success', 'Bukti pengembalian berhasil diunggah.');
    }

    public function updateOrderStatus(Request $request)
    {
        // Log data request untuk memastikan permintaan diterima
        \Log::info('Request received:', $request->all());

        $validated = $request->validate([
            'invoice_id' => 'required|exists:selling_invoices,selling_invoice_id',
            'order_status' => 'required|string'
        ]);

        try {
            // Cari faktur berdasarkan ID
            $invoice = SellingInvoice::findOrFail($validated['invoice_id']);
            \Log::info('Invoice found:', $invoice->toArray());

            // Perbarui status dan field cashier_id
            $invoice->order_status = $validated['order_status'];
            $invoice->cashier_id = auth()->id(); // Isi dengan ID kasir yang sedang login
            $invoice->save();

            \Log::info('Invoice updated successfully:', [
                'order_status' => $invoice->order_status,
                'cashier_id' => $invoice->cashier_id
            ]);

            return response()->json(['success' => true, 'message' => 'Status berhasil diperbarui!']);
        } catch (\Exception $e) {
            \Log::error('Error updating order status:', ['error' => $e->getMessage()]);
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan saat memperbarui status.'], 500);
        }
    }

    public function processInvoiceCashier(Request $request)
    {
        try {
            // Debug data request sebelum validasi
            \Log::info('Data sebelum validasi:', $request->all());

            // Validasi input
            $data = $request->validate([
                'cashier_id' => 'required',             // ID kasir (wajib)
                'customer_id' => 'nullable',            // ID pelanggan (opsional)
                'recipient_name' => 'nullable',         // Nama penerima (opsional)
                'recipient_email' => 'nullable|email',  // Email (opsional)
                'recipient_phone' => 'nullable',        // Nomor telepon (opsional)
                'recipient_address' => 'nullable',      // Alamat (opsional)
                'payment_method' => 'required',         // Metode pembayaran (wajib)
                'recipient_bank' => 'nullable|string',  // Bank penerima (opsional, hanya untuk Non-Tunai)
                'cart' => 'required|array',             // Data keranjang (wajib, harus array)
            ]);

            // Debug data setelah validasi
            \Log::info('Data setelah validasi:', $data);

            // Convert cart array to JSON
            $cartJson = json_encode($data['cart']);

            // Debug JSON hasil konversi dari cart
            \Log::info('Cart JSON:', ['cart' => $cartJson]);

            DB::transaction(function () use ($data, $cartJson) {
                // Tentukan nilai default untuk recipient_address jika kosong
                $recipientAddress = $data['recipient_address'] ?? 'Pesanan Offline';

                // Tentukan recipient_bank jika metode pembayaran adalah Non-Tunai
                $recipientBank = null;
                if ($data['payment_method'] === 'Bank Transfer') {
                    $recipientBank = $data['recipient_bank'] ?? 'Bank Tidak Ditentukan';
                }

                // Debug data sebelum memanggil prosedur
                \Log::info('Sebelum memanggil prosedur:', [
                    'cashier_id' => $data['cashier_id'],            // ID kasir
                    'customer_id' => $data['customer_id'] ?? null,  // ID pelanggan (bisa NULL)
                    'recipient_name' => $data['recipient_name'],    // Recipient Name
                    'recipient_email' => $data['recipient_email'],  // Email
                    'recipient_phone' => $data['recipient_phone'],  // Phone
                    'recipient_address' => $recipientAddress,       // Address (dengan nilai default)
                    'recipient_bank' => $recipientBank,             // Bank penerima
                    'payment_method' => $data['payment_method'],    // Payment Method
                    'cart' => $cartJson                             // Cart in JSON format
                ]);

                // Panggil prosedur MySQL
                DB::statement('CALL insertInvoiceProcedurecashier1(?, ?, ?, ?, ?, ?, ?, ?, ?)', [
                    $data['cashier_id'],            // ID kasir
                    $data['customer_id'] ?? null,   // ID pelanggan (bisa NULL)
                    $data['recipient_name'],        // Recipient Name
                    $data['recipient_email'],       // Email
                    $data['recipient_phone'],       // Phone
                    $recipientAddress,              // Address (dengan nilai default jika kosong)
                    $recipientBank,                 // Bank penerima
                    $data['payment_method'],        // Payment Method
                    $cartJson                       // Cart in JSON format
                ]);
            });

            // Debug setelah transaksi selesai
            \Log::info('Transaksi selesai, invoice berhasil diproses');

            return response()->json(['message' => 'Invoice processed successfully']);
        } catch (\Throwable $e) {
            // Tangkap error dan log
            \Log::error('Error processing invoice:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }




    public function process(Request $request)
    {
        $validated = $request->validate([
            'total_amount' => 'required|numeric',
            'payment_method' => 'required|in:cash,cashless',
            'cash_amount' => 'required_if:payment_method,cash|numeric',
        ]);

        // Proses pembayaran disini
        $change = 0;
        if ($request->payment_method === 'cash') {
            $change = $request->cash_amount - $request->total_amount;
        }

        return response()->json([
            'success' => true,
            'change' => $change,
            'message' => 'Pembayaran berhasil!'
        ]);
    }
}