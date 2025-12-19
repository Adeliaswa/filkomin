<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Jika belum login atau bukan admin
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            abort(403);
        }

        // WAJIB return next
        return $next($request);
    }
}
