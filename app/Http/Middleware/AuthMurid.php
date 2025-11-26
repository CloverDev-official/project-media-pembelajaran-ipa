<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthMurid
{
    public function handle(Request $request, Closure $next)
    {
        try {
            // Ambil token dari cookie (nama cookie: token_murid)
            $token = $request->cookie('token_murid');

            if (!$token) {
                // Jika cookie tidak ada, redirect ke halaman login murid
                return redirect()->route('auth.login-murid');
            }

            // Set token dan autentikasi user
            $user = auth('murid')->setToken($token)->authenticate();

            if (!$user) {
                // Jika token valid tapi user tidak ditemukan
                return redirect()->route('auth.login-murid');
            }

            // Login-kan user ke guard 'murid'
            auth()->guard('murid')->setUser($user);
        } catch (JWTException $e) {
            // Token invalid, expired, atau gagal didecode
            return redirect()->route('auth.login-murid');
        }

        return $next($request);
    }
}
