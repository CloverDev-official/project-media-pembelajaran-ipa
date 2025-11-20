<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthGuru
{
    public function handle(Request $request, Closure $next)
    {
        try {
            // Ambil token dari cookie (nama cookie: token_guru)
            $token = $request->cookie('token_guru');

            if (!$token) {
                // Jika cookie tidak ada, redirect ke halaman login murid
                return redirect()->route('auth.login-guru');
            }
            // Set token dan autentikasi user
            $user = auth('guru')->setToken($token)->authenticate();
            
            if (!$user) {
                // Jika token valid tapi user tidak ditemukan
                return redirect()->route('auth.login-guru');
            }

            // Login-kan user ke guard 'guru'
            auth()->guard('guru')->setUser($user);
        } catch (JWTException $e) {
            // Token invalid, expired, atau gagal didecode
            return redirect()->route('auth.login-guru');
        }

        return $next($request);
    }
}
