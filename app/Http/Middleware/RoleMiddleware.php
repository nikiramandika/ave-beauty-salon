<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RoleMiddleware
{
    public function handle($request, Closure $next, $roles)
    {
        // Pastikan $roles berupa array
        $roles = is_array($roles) ? $roles : explode('|', $roles);

        // Ambil user yang sedang login
        $user = Auth::user();

        // Jika user belum login atau role tidak sesuai, abort
        if (!$user || !in_array($user->role, $roles)) {
            abort(403, 'Unauthorized');
        }

        // Atur koneksi database berdasarkan role
        $connectionMap = [
            'Admin' => 'admin',
            'Cashier' => 'kasir',
            'User' => 'avebeautysalon',
        ];

        $connection = $connectionMap[$user->role] ?? 'default'; // Gunakan koneksi default jika role tidak ditemukan

        DB::setDefaultConnection($connection);

        // Lanjutkan request
        return $next($request);
    }
}
