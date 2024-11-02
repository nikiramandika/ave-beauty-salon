<?php

namespace App\Http\Controllers;

use App\Models\User;
use Hash;
use Illuminate\Http\Request;

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
            'name_depan' => 'required|string|max:255',
            'nama_belakang' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'phone' => 'required|string|max:20',
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
    /**
     * Display the specified user.
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }

    /**
     * Display a listing of active users.
     */
    public function activeUsers()
    {
        $users = User::where('is_active', true)->paginate(10);
        return view('users.active', compact('users'));
    }

    /**
     * Display users by role.
     */
    public function usersByRole($role)
    {
        $users = User::where('role', $role)->paginate(10);
        return view('users.by_role', compact('users', 'role'));
    }
}