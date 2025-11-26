<?php

namespace App\Livewire\Mobile;

use App\Models\Bab;
use Livewire\Component;

class MateriMobile extends Component
{   
    public function mount()
    {
        $this->daftarMateri = Bab::select('id', 'judul_bab')->get();
    }
    public function render()
    {
        return view('livewire.mobile.materi-mobile');
    }
}
