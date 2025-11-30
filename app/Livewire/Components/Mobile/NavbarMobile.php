<?php

namespace App\Livewire\Components\Mobile;

use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class NavbarMobile extends Component
{
    public $murid;
    public $infoMurid;
    protected $listeners = [
        'refreshFotoProfil' => 'refresh'
    ];

    public function mount()
    {
        $this->murid = auth('murid')->user();
        $this->infoMurid = $this->murid->load('kelas');
    }

    public function logout()
    {
        $token = Cookie::get('token_murid');

        if ($token) {
            try {
                Http::withToken($token)->post(route('murid.auth.logout'));
            } catch (\Exception $e) {
            }
        }

        Cookie::queue(Cookie::forget('token_murid'));

        $this->redirectRoute('auth.login-murid', navigate: true);
    }


    public function render()
    {
        return view('livewire.components.mobile.navbar-mobile');
    }
}
