<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\SetDatabaseConnection;
use DB;
class RoleMiddleware
{
    public function handle($request, Closure $next, $role)
    {
        if (Auth::check() && Auth::user()->role === 'Admin') {
            DB::setDefaultConnection('admin'); 
            return $next($request);
        }
        else if(Auth::check() && Auth::user()->role === 'Cashier'){
            DB::setDefaultConnection('kasir'); 
            return $next($request);
        }
        else if(Auth::check() && Auth::user()->role === 'User'){
            DB::setDefaultConnection('user'); 
            return $next($request);
        }
        return redirect()->intended('/dashboard');
    }
}