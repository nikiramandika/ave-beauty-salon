<?php

namespace App\Http\Controllers;

use App\Models\Cashier;
use App\Models\Category;
use App\Models\Product;
use App\Models\Promo;
use App\Models\SellingInvoice;
use App\Models\Treatment;
use App\Models\User;
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
        $invoices = SellingInvoice::with('details')->get();
        return view('cashier.pesanan-online', compact('invoices'));
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

            // Perbarui status
            $invoice->order_status = $validated['order_status'];
            $invoice->save();

            return response()->json(['success' => true, 'message' => 'Status berhasil diperbarui!']);
        } catch (\Exception $e) {
            \Log::error('Error updating order status:', ['error' => $e->getMessage()]);
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan saat memperbarui status.'], 500);
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