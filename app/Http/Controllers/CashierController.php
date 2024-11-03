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
     * Display the specified cashier.
     */
    public function show($cashierId)
    {
        $cashier = Cashier::with('user')->findOrFail($cashierId);
        return view('owner.pages.cashiers.show', compact('cashier'));
    }

    /**
     * Show the form for editing the specified cashier.
     */
    public function edit($cashierId)
    {
        $cashier = Cashier::with('user')->findOrFail($cashierId);
        return view('owner.pages.cashiers.edit', compact('cashier'));
    }

    /**
     * Update the specified cashier.
     */
    public function update(Request $request, $cashierId)
    {
        // Validate the request data
        $request->validate([
            'user_id' => 'nullable|exists:users,id',
            'is_active' => 'required|boolean',
        ]);

        $cashier = Cashier::findOrFail($cashierId);
        $cashier->user_id = $request->user_id;
        $cashier->is_active = $request->is_active;
        $cashier->save();

        return redirect()->route('cashiers.cashiers')->with('success', 'Cashier updated successfully');
    }

    /**
     * Remove the specified cashier from storage.
     */
    public function destroy($cashierId)
    {
        $cashier = Cashier::findOrFail($cashierId);
        $cashier->delete();

        return redirect()->route('cashiers.cashiers')->with('success', 'Cashier deleted successfully');
    }
}
