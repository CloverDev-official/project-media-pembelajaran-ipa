<?php

namespace App\Livewire\Auth;

use App\Helpers\ToastMagic;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Tymon\JWTAuth\Facades\JWTAuth;

class LoginMurid extends Component
{
    public $nipd;
    public $password;
    public $error = '';

    public function mount()
    {
        $token = Cookie::get('token_murid');
        if (!$token) {
            return;
        }

        try {
            $user = auth('murid')->setToken($token)->authenticate();
        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException) {
            try {
                $token = auth('murid')->refresh();
                Cookie::queue('token_murid', $token, 20160);
                $user = auth('murid')->setToken($token)->authenticate();
            } catch (\Exception) {
                Cookie::queue(Cookie::forget('token_murid'));
                return;
            }
        } catch (\Exception) {
            Cookie::queue(Cookie::forget('token_murid'));
            return;
        }

        if (!empty($user)) {
            $this->redirectRoute('beranda', navigate: true);
        }
    }

    public function login()
    {
        $this->validate([
            'nipd' => 'required|string',
            'password' => 'required|string',
        ]);

        try {
            $response = Http::post(route('murid.auth.login'), [
                'NIPD' => $this->nipd,
                'password' => $this->password,
            ]);

            if ($response->failed()) {
                ToastMagic::error('NIPD atau password salah');
                return;
            }

            $data = $response->json();

            Cookie::queue('token_murid', $data['access_token'], 20160);

            $this->redirectRoute('beranda', navigate: true);
        } catch (\Exception $e) {
            $this->error = 'Terjadi kesalahan. Coba lagi.';
        }
    }

    public function render()
    {
        return view('livewire.auth.login-murid')->layout('components.layouts.app-auth');
    }
}
