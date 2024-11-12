<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class UserController extends Controller
{
    /**
     * Display a listing of users.
     */
    public function index()
    {
        // Mengambil semua data user dengan pagination
        $users = User::paginate(10);

        return view('owner.pages.users.users', compact('users'));
    }

    public function edit($id)
    {
        // Ambil data user berdasarkan ID
        $user = User::findOrFail($id);

        // Tampilkan form edit dengan data user
        return view('owner.pages.users.users-edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'nama_depan' => 'required|string|max:255',
            'nama_belakang' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'phone' => 'nullable|string|max:20',
            'role' => 'required|string',
            'is_active' => 'required|boolean',
            'password' => 'nullable|min:6|confirmed',
            'password_confirmation' => 'nullable|min:6' // Tambahkan ini
        ]);

        $userData = $request->except(['password', 'password_confirmation']);

        if ($request->filled('password')) {
            $userData['password'] = Hash::make($request->password);
        }

        $user->update($userData);

        return redirect()->route('users.index')
            ->with('success', 'User berhasil diupdate');
    }
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')
            ->with('success', 'User berhasil dihapus');
    }

}
