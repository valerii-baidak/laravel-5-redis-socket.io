<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;


class RedirectIfAuthenticated
{

    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            $role = Auth::user()->role;
            switch ($role) {
                case 'manager':
                    return redirect('/manager');
                case 'cook':
                    return redirect()->intended('/cook');
                case 'waiter':
                    return redirect('/waiter');
                default:
                    return redirect('/');
            }
        }

        return $next($request);
    }
}
