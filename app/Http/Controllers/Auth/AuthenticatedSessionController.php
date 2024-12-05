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

        // Coba autentikasi pengguna
        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();

            // Cek apakah akun pengguna aktif
            if (Auth::user()->is_active == 0) {
                // Jika akun tidak aktif, logout dan tampilkan pesan
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return back()->withErrors([
                    'email' => 'Your email or password is incorrect. Please try again.',
                ]);
            }

            // Menambahkan pengecekan role di sini
            if (Auth::user()->role === 'Admin') {
                return redirect()->intended('/dashboard-owner');  // Jika pengguna adalah Admin
            } elseif (Auth::user()->role === 'Cashier') {
                return redirect()->intended('/cashiers');  // Jika pengguna adalah Cashier
            } elseif (Auth::user()->role === 'User') {
                return redirect()->intended('/');  // Jika pengguna adalah User atau peran lain
            } else {
                return redirect()->intended('/');  // Jika pengguna adalah User atau peran lain
            }
        }

        return back()->withErrors([
            'email' => 'Your email or password is incorrect. Please try again.',
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
