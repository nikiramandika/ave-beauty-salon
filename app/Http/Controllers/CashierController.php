<?php

namespace App\Http\Controllers;

use App\Models\Cashier;
use App\Models\Category;
use App\Models\Member;
use App\Models\Product;
use App\Models\Promo;
use App\Models\Refund;
use App\Models\SellingInvoice;
use App\Models\Treatment;
use App\Models\User;
use DB;
use Illuminate\Http\Request;
use Str;

class CashierController extends Controller
{
    /**
     * Display a listing of cashiers.
     */
    public function index()
    {

        $cashiers = Cashier::get();
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
            ->with('member')
            ->where('role', 'User')
            ->select('id', 'nama_depan', 'nama_belakang', 'phone', 'email')
            ->get();
        $categories = Category::all();

        return view('cashier.index', compact('products', 'categories', 'treatments', 'promos', 'users'));
    }

    public function pesananOnline()
    {
        // Ambil semua data invoices (tanpa refund dan bukan pesanan offline)
        $invoices = SellingInvoice::with('details')
            ->whereNull('refund_id') // Hanya ambil data yang refund_id-nya NULL
            ->where('recipient_address', '!=', 'Pesanan Offline') // Tidak ambil jika alamat adalah 'Pesanan Offline'
            ->get()
            ->map(function ($invoice) {
                // Hitung total harga untuk invoice ini
                $invoice->total_price = $invoice->details->sum(function ($detail) {
                    return $detail->quantity * $detail->price;
                });
                return $invoice;
            });

        // Ambil data refunds (pesanan yang direfund)
        $refunds = SellingInvoice::whereNotNull('refund_id') // Ambil hanya invoice yang memiliki refund_id
            ->with('details', 'refunds') // Pastikan Anda memuat relasi details untuk detail pesanan
            ->get()
            ->map(function ($invoice) {
                // Hitung total harga untuk invoice ini
                $invoice->total_price = $invoice->details->sum(function ($detail) {
                    return $detail->quantity * $detail->price;
                });
                return $invoice;
            });

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


    public function updateRefundStatus(Request $request)
    {
        $request->validate([
            'refund_id' => 'required|exists:refunds,refund_id', // Pastikan 'refund_id' digunakan
            'refund_status' => 'required|string',
        ]);

        try {
            // Cari refund berdasarkan refund_id, bukan id
            $refund = Refund::where('refund_id', $request->refund_id)->firstOrFail();

            // Cek apakah status yang diminta valid
            if (!in_array($request->refund_status, ['Pending', 'Refund on Process', 'Refund Success', 'Cancelled'])) {
                return response()->json(['success' => false, 'message' => 'Status tidak valid']);
            }

            $refund->refund_status = $request->refund_status;
            $refund->save();

            return response()->json(data: ['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }


    public function updateOrderStatus(Request $request)
    {
        // Log data request untuk memastikan permintaan diterima
        \Log::info('Request received:', $request->all());

        try {
            // Validasi input
            $validated = $request->validate([
                'invoice_id' => 'required|exists:selling_invoices,selling_invoice_id',
                'order_status' => 'required|string',
                'refundReason' => 'nullable|string',  // Alasan Pembatalan
                'refundFile' => 'nullable|file|mimes:jpg,png,pdf',  // Bukti Pengembalian
            ]);

            // Cari faktur berdasarkan ID
            $invoice = SellingInvoice::findOrFail($validated['invoice_id']);

            // Jika status adalah Refund, tambahkan alasan dan file bukti
            if ($validated['order_status'] == 'Refund') {
                $invoice->order_status = 'Refund';

                // Menambahkan refund jika ada
                if ($validated['refundReason']) {
                    $refund = new Refund;  // Membuat objek refund baru
                    $refund->refund_reason = $validated['refundReason'];

                    // Menyimpan file refund
                    if ($request->hasFile('refundFile')) {
                        $path = $request->file('refundFile')->store('refund_files', 'public');
                        $refund->admin_refund_file = $path;  // Menyimpan path file di database
                    }

                    $refund->refund_status = 'Refund Success';

                    // Simpan data refund
                    $invoice->refunds()->save($refund);

                    // Setelah refund disimpan, update kolom refund_id pada selling_invoices
                    $invoice->refund_id = $refund->refund_id;
                }
            } else {
                // Untuk status lainnya, perbarui status pesanan
                $invoice->order_status = $validated['order_status'];
            }

            // Update cashier_id
            $invoice->cashier_id = auth()->id(); // Isi dengan ID kasir yang sedang login

            // Simpan perubahan invoice
            $invoice->save();

            return redirect()->back();
        } catch (\Exception $e) {
            // Menangani error umum
            \Log::error('Error updating order status:', ['error' => $e->getMessage()]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memperbarui status.',
                'error' => $e->getMessage()
            ], 500);  // Internal Server Error
        }
    }



    public function processInvoiceCashier(Request $request)
    {
        try {
            // Debug data request sebelum validasi
            \Log::info('Data sebelum validasi:', $request->all());

            // Validasi input
            $data = $request->validate([
                'cashier_id' => 'required',
                'customer_id' => 'nullable',
                'recipient_name' => 'nullable',
                'recipient_email' => 'nullable|email',
                'recipient_phone' => 'nullable',
                'recipient_address' => 'nullable|string',
                'payment_method' => 'required|string',
                'recipient_bank' => 'nullable|string',
                'cart' => 'required|array',
                'cart.*.detailId' => 'nullable|integer',
                'cart.*.name' => 'required|string',
                'cart.*.price' => 'required|numeric',
                'cart.*.quantity' => 'required|integer',
                'cart.*.size' => 'nullable|string',
                'cart.*.type' => 'required|string',
                'cart.*.used_points' => 'nullable|integer',
                'cart.*.discount_from_points' => 'nullable|numeric'
            ]);

            // Debug data setelah validasi
            \Log::info('Data setelah validasi:', $data);

            // Convert cart array to JSON
            $cartJson = json_encode($data['cart']);

            DB::transaction(function () use ($data, $cartJson) {
                // Tentukan nilai default untuk recipient_address jika kosong
                $recipientAddress = $data['recipient_address'] ?? 'Pesanan Offline';

                // Tentukan recipient_bank jika metode pembayaran adalah Non-Tunai
                $recipientBank = null;
                if ($data['payment_method'] === 'Bank Transfer') {
                    $recipientBank = $data['recipient_bank'] ?? 'Bank Tidak Ditentukan';
                }

                // Debug data sebelum memanggil prosedur
                \Log::info('Data sebelum prosedur:', [
                    'cashier_id' => $data['cashier_id'],
                    'customer_id' => $data['customer_id'],
                    'recipient_name' => $data['recipient_name'],
                    'recipient_email' => $data['recipient_email'],
                    'recipient_phone' => $data['recipient_phone'],
                    'recipient_address' => $recipientAddress,
                    'recipient_bank' => $recipientBank,
                    'payment_method' => $data['payment_method'],
                    'cart_json' => $cartJson
                ]);

                // Panggil prosedur MySQL untuk memproses invoice
                DB::statement('CALL insertInvoiceProcedurecashier5(?, ?, ?, ?, ?, ?, ?, ?, ?)', [
                    $data['cashier_id'],
                    $data['customer_id'] ?? null,
                    $data['recipient_name'],
                    $data['recipient_email'],
                    $data['recipient_phone'],
                    $recipientAddress,
                    $recipientBank,
                    $data['payment_method'],
                    $cartJson
                ]);

                // Loop untuk memanggil prosedur pengurangan stok produk
                foreach ($data['cart'] as $cartItem) {
                    if (isset($cartItem['detailId']) && isset($cartItem['quantity'])) {
                        // Call the stored procedure to update product stock
                        DB::statement('CALL update_product_stock(?, ?)', [
                            $cartItem['detailId'],    // ID produk detail
                            $cartItem['quantity']     // Kuantitas produk yang dibeli
                        ]);

                        // Get the product_id from product_details based on detailId
                        $productDetail = DB::table('product_details')
                            ->where('detail_id', $cartItem['detailId'])
                            ->first();  // Get the product detail record

                        if ($productDetail) {
                            // Check if the product stock is 0 after the update
                            if ($productDetail->product_stock == 0) {
                                // Update the product's is_active to 0 in the products table if stock is 0
                                DB::table('products')
                                    ->where('product_id', $productDetail->product_id)
                                    ->update(['is_active' => 0]);

                                // Log the update action
                                \Log::info('Product stock is 0, setting is_active to 0', [
                                    'product_id' => $productDetail->product_id
                                ]);
                            }

                            // Log the success with the details of the operation
                            \Log::info('Successfully updated product stock', [
                                'product_id' => $cartItem['detailId'],
                                'quantity' => $cartItem['quantity']
                            ]);
                        }
                    } else {
                        // Log a warning if detailId or quantity is missing
                        \Log::warning('Missing detailId or quantity in cart item:', $cartItem);
                    }
                }


            });
            $invoiceCode = DB::table('selling_invoices')
                ->where('recipient_address', 'Pesanan Offline')  // Menambahkan kondisi filter untuk recipient_address
                ->orderBy('order_date', 'desc')  // Mengurutkan berdasarkan order_date secara descending
                ->first()
                ->invoice_code;  // Mengambil invoice_code dari data pertama yang sesuai
            // Mengambil invoice_code dari data pertama
            
            // Debug setelah transaksi selesai
            \Log::info('Transaksi selesai, invoice berhasil diproses dan stok produk diperbarui');

            return response()->json([
                'message' => 'Invoice processed and product stock updated successfully',
                'invoice_code' => $invoiceCode  // Return invoice_code to the frontend
            ]);
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

    public function member()
    {
        // Dapatkan daftar user_id yang sudah menjadi member
        $memberUserIds = Member::pluck('user_id');

        // Ambil data user dengan role "User" dan is_active = 1, tetapi belum menjadi member
        $users = User::where('role', 'User')
            ->where('is_active', 1)
            ->whereNotIn('id', $memberUserIds) // Mengecualikan user yang sudah menjadi member
            ->get();

        // Ambil data members
        $members = Member::with('user') // Mengambil relasi user dari member
            ->get();

        // Kirim data ke view
        return view('cashier.member', [
            'users' => $users,
            'members' => $members,
        ]);
    }
    public function updateMember(Request $request, Member $member)
    {
        $request->validate([
            'points' => 'required|integer|min:0',
            'is_active' => 'required|boolean',
        ]);

        // Ambil ID kasir yang sedang login
        $cashierId = auth()->id(); // Pastikan Auth sudah dikonfigurasi
        // Perbarui data member, termasuk cashier_id
        $member->update([
            'points' => $request->points,
            'is_active' => $request->is_active,
            'cashier_id' => $cashierId, // Tambahkan cashier_id di sini
            'updated_at' => now(),      // Perbarui kolom updated_at
        ]);

        return redirect()->back()->with('success', 'Member updated successfully!');
    }



    public function storeMember(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'phone' => 'required|string',  // Validasi phone number
        ]);

        // Ambil ID kasir dari sesi autentikasi
        $cashierId = auth()->id(); // Pastikan autentikasi terkonfigurasi dengan benar

        // Update phone number pada tabel users
        $user = User::find($request->user_id);
        $user->phone = $request->phone;  // Update nomor telepon
        $user->save();  // Simpan perubahan

        // Buat data member baru, termasuk cashier_id
        Member::create([
            'member_id' => (string) Str::uuid(),
            'user_id' => $request->user_id,
            'membership_number' => 'MBR' . rand(10000, 99999),
            'points' => 0,
            'joined_date' => now(),
            'is_active' => 1,
            'cashier_id' => $cashierId, // Tambahkan cashier_id di sini
        ]);

        return redirect()->back()->with('success', 'User has been added as a member.');
    }


    public function destroyMember(Member $member)
    {
        // Ambil ID kasir yang sedang login
        $cashierId = auth()->id(); // Pastikan Auth sudah dikonfigurasi

        // Simpan log penghapusan ke tabel member_logs sebelum menghapus data
        DB::table('member_logs')->insert([
            'log_id' => (string) Str::uuid(),         // ID unik untuk log
            'log_time' => now(),                     // Waktu penghapusan
            'user_id' => $member->user_id,           // ID user terkait
            'member_id' => $member->member_id,       // ID member yang dihapus
            'membership_number' => $member->membership_number, // Nomor keanggotaan
            'cashier_id' => $cashierId,              // ID kasir yang melakukan penghapusan
            'action_type' => 'remove',               // Jenis aksi
            'old_points' => $member->points,         // Poin saat ini (sebelum dihapus)
            'new_points' => null,                    // Tidak relevan setelah dihapus
            'is_active' => $member->is_active        // Status keanggotaan sebelum dihapus
        ]);

        // Hapus data member
        $member->delete();

        return redirect()->back()->with('success', 'Member has been removed.');
    }



}
