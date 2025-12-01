<?php

namespace App\Livewire\Mobile;

use App\Models\Bab;
use Livewire\Component;

class BerandaMobile extends Component
{

    public $daftarMateri;

    public function mount()
    {
        $this->daftarMateri = Bab::inRandomOrder()->take(3)->get();
    }

    public function render()
    {
        return view('livewire.mobile.beranda-mobile');
    }
}
