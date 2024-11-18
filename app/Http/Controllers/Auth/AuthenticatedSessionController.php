<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request)
    {
        // Validasi manual untuk email dan password
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();

            // Menambahkan pengecekan role di sini
            if (Auth::user()->role === 'Admin') {
                return redirect()->intended('/dashboard-owner');  // Jika pengguna adalah Admin
            } elseif (Auth::user()->role === 'Cashier') {
                return redirect()->intended('/cashier');  // Jika pengguna adalah Cashier
            } else {
                return redirect()->intended('/');  // Jika pengguna adalah User atau peran lain
            }
        }

        return back()->withErrors([
            'email' => 'Your email or password is incorret. Please try again.',
        ]);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
