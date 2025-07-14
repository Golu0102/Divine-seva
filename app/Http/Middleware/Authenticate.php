<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\AuthenticationException;

class Authenticate
{
    public function handle(Request $request, Closure $next, ...$guards)
    {
        if (Auth::guard($guards[0] ?? 'web')->check()) {
            return $next($request);
        }

        throw new AuthenticationException('Unauthenticated.', $guards);
    }
}
