<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nama_depan' => ['required', 'string', 'max:255'],
            'nama_belakang' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Cek apakah akun dengan email tersebut sudah ada dan is_active = 0
        $user = User::where('email', $request->email)->first();

        if ($user && $user->is_active == 0) {
            // Perbarui informasi pengguna yang sudah ada
            $user->nama_depan = $request->nama_depan;
            $user->nama_belakang = $request->nama_belakang;
            $user->password = Hash::make($request->password);
            $user->email_verified_at = null;  // Kosongkan status verifikasi email
            $user->is_active = 1;  // Aktifkan kembali akun

            $user->save();

            // Kirimkan email verifikasi ulang
            $user->sendEmailVerificationNotification();
        } else {
            // Jika akun tidak ada atau is_active = 1, buat akun baru
            $user = User::create([
                'nama_depan' => $request->nama_depan,
                'nama_belakang' => $request->nama_belakang,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
        }

        // Setelah akun diperbarui atau dibuat, login pengguna
        Auth::login($user);

        return redirect(route('home', absolute: false));
    }

}
