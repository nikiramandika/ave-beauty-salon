<?php

namespace App\Http\Controllers;

use App\Models\Cashier;
use App\Models\Category;
use App\Models\Product;
use App\Models\Promo;
use App\Models\Treatment;
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
        $categories = Category::all();
        return view('cashier.products.index', compact('products', 'categories'));
    }

    public function cashierTreatment()
    {
        // Ambil semua treatment dengan relasi description
        $treatments = Treatment::with('description')->where('is_active', 1)
            ->get();

        return view('cashier.treatments.index', compact('treatments'));
    }

    public function cashierPromos()
    {
        // Fetch all promos with related description
        $promos = Promo::with('description')
            ->where('is_active', 1)
            ->get();

        return view('cashier.promos.index', compact('promos'));
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