<?php

namespace App\Livewire\Auth;

use App\Helpers\ToastMagic;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Tymon\JWTAuth\Facades\JWTAuth;

class LoginGuru extends Component
{
    public $username;
    public $password;
    public $error = '';

    public function mount()
    {
        $token = Cookie::get('token_guru');
        if (!$token) {
            return;
        }

        try {
            $user = auth('guru')->setToken($token)->authenticate();
        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException) {
            try {
                $token = auth('guru')->refresh();
                Cookie::queue('token_guru', $token, 20160);
                $user = auth('guru')->setToken($token)->authenticate();
            } catch (\Exception) {
                Cookie::queue(Cookie::forget('token_guru'));
                return;
            }
        } catch (\Exception) {
            Cookie::queue(Cookie::forget('token_guru'));
            return;
        }

        if (!empty($user)) {
            $this->redirectRoute('guru.dashboard', navigate: true);
        }
    }

    public function login()
    {
        $this->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        try {
            $response = Http::post(route('guru.auth.login'), [
                'email' => $this->username,
                'password' => $this->password,
            ]);

            if ($response->failed()) {
                ToastMagic::error('Username atau password salah');
                return;
            }

            $data = $response->json();

            Cookie::queue('token_guru', $data['access_token'], 20160);

            $this->redirectRoute('guru.dashboard', navigate: true);
        } catch (\Exception $e) {
            $this->error = 'Terjadi kesalahan. Coba lagi.';
        }
    }

    public function render()
    {
        return view('livewire.auth.login-guru')->layout('components.layouts.app-auth');
    }
}
