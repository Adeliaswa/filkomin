<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        // belum login
        if (!auth()->check()) {
            return redirect('/login');
        }

        $user = auth()->user();

        // role TIDAK BOLEH null
        if (!$user->role) {
            abort(403);
        }

        // bandingkan role (STRING, case-insensitive)
        if (strtolower($user->role) !== strtolower($role)) {
            abort(403);
        }

        return $next($request);
    }
}
