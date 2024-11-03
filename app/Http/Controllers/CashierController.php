<?php

namespace App\Http\Controllers;

use App\Models\Cashier;
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
}
