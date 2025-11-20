<?php

namespace App\Livewire\Components\Modal;

use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class ModalProfilSiswa extends Component
{
    public $showModalProfil = false;

    protected $listeners = ['toggleProfilPopup' => 'toggle'];

    public function toggle()
    {
        $this->showModalProfil = !$this->showModalProfil;
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
        return view('livewire.components.modal.modal-profil-siswa');
    }
}
