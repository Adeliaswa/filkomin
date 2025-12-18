<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminOnly
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Kalau belum login
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        // Kalau bukan admin
        if (auth()->user()->role !== 'admin') {
            abort(403); // bisa juga redirect('/dashboard')
        }

        return $next($request);
    }
}
