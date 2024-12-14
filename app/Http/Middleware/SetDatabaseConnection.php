<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SetDatabaseConnection
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            $user = Auth::user();

            // Set the database connection based on the user's role
            if ($user->role === 'Admin') {
                DB::setDefaultConnection('admin'); // Admin connection
            } elseif ($user->role === 'Cashier') {
                DB::setDefaultConnection('kasir'); // Customer connection
            } elseif ($user->role === 'User') {
                DB::setDefaultConnection('customer'); // Customer connection
            } else {
                // Default to the primary connection if the role is not specified
                DB::setDefaultConnection(config('database.default'));
            }
        }

        return $next($request);
    }
}