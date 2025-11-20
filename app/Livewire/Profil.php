<?php

namespace App\Livewire;

use Livewire\Component;

class Profil extends Component
{
    public $infoMurid;

    public function mount()
    {
        $this->infoMurid = auth('murid')->user()->load('kelas');
    }

    public function render()
    {
        return view('livewire.profil');
    }
}
