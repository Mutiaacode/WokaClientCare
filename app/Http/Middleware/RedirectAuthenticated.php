<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectAuthenticated
{
    public function handle($request, Closure $next)
    {

        if (Auth::check()) {
            $role = Auth::user()->role;

            switch ($role) {
                case 'admin':
                    return redirect()->route('admin.dashboard');
                case 'staff':
                    return redirect()->route('staff.dashboard');
                case 'teknisi':
                    return redirect()->route('teknisi.dashboard');
                case 'client':
                    return redirect()->route('client.dashboard');
                default:
                    return redirect('/');
            }
        }

        return $next($request);
    }
}
