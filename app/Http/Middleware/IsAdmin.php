<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        // Jika user belum login, atau login tapi rolenya bukan admin, tendang ke login
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return redirect('/login')->with('error', 'Akses ditolak. Halaman ini hanya untuk manajemen internal.');
        }

        return $next($request);
    }
}