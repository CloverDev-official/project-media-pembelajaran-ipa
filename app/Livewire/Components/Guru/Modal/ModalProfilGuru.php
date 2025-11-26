<?php

namespace App\Livewire\Components\Guru\Modal;

use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class ModalProfilGuru extends Component
{
    public $showModalProfil = false;

    protected $listeners = ['toggleProfilPopup' => 'toggle'];

    public function toggle()
    {
        $this->showModalProfil = !$this->showModalProfil;
    }

    public function logout()
    {
        $token = Cookie::get('token_guru');

        if ($token) {
            try {
                Http::withToken($token)->post(route('guru.auth.logout'));
            } catch (\Exception $e) {
            }
        }

        Cookie::queue(Cookie::forget('token_guru'));

        $this->redirectRoute('auth.login-guru', navigate: true);
    }

    public function render()
    {
        return view('livewire.components.guru.modal.modal-profil-guru');
    }
}
