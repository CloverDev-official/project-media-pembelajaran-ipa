<?php

namespace App\Livewire;

use App\Models\Ulangan;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Ulangan')]
class DaftarUlangan extends Component
{
    public $daftarUlangan;

    public function mount()
    {
        $this->daftarUlangan = Ulangan::all();
    }

    public function render()
    {
        return view('livewire.daftar-ulangan');
    }
}
