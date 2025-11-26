<?php

namespace App\Livewire\Guru;

use App\Models\Ulangan as ModelsUlangan;
use Livewire\Component;

class Ulangan extends Component
{
    protected $listeners = ['ulanganUpdated' => 'refreshData'];
    public $daftarUlangan;

    public function mount()
    {
        $this->refreshData();
    }

    public function refreshData()
    {
        $this->daftarUlangan = ModelsUlangan::all();
    }

    public function render()
    {
        return view('livewire.guru.ulangan')->layout('components.layouts.app-guru');
    }
}
