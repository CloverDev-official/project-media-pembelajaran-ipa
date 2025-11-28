<?php

namespace App\Livewire;

use App\Models\Bab;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Materi')]

class Materi extends Component
{
    public $daftarMateri;

    public function mount()
    {
        $this->daftarMateri = Bab::all();
    }

    public function render()
    {
        return view('livewire.materi');
    }
}
