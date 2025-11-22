<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle($request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            // not authenticated
            return redirect()->route('login');
        }

        $userRole = trim(strtolower(Auth::user()->role ?? ''));

        // normalize requested roles
        $roles = array_map(function($r) {
            return trim(strtolower($r));
        }, $roles);

        if (!in_array($userRole, $roles, true)) {
            // unauthorized: send to homepage with a message
            return redirect('/')->with('error', 'Unauthorized access.');
        }

        return $next($request);
    }
}
