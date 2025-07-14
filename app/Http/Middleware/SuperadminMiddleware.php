<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class SuperadminMiddleware
{
    public function handle($request, Closure $next)
    {
        if (!Auth::guard('superadmin')->check()) {
            return redirect()->route('superadmin.login');
        }

        return $next($request);
    }
}
