<?php

namespace App\Livewire\Components\Mobile;

use Livewire\Component;

class NavbarMobile extends Component
{
    public $infoMurid;

    public function mount()
    {
        $murid = auth('murid')->user();
        $this->infoMurid = $murid->load('kelas');
    }

    public function render()
    {
        return view('livewire.components.mobile.navbar-mobile');
    }
}
