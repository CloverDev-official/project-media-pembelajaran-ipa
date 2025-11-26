<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Tamu
{
    public function handle(Request $request, Closure $next)
    {
        // cek guard guru
        if (auth('guru')->check()) {
            return redirect()->route('guru.dashboard');
        }

        // cek guard murid
        if (auth('murid')->check()) {
            return redirect()->route('beranda');
        }

        // jika tidak ada token valid, lanjut ke halaman login
        return $next($request);
    }
}
