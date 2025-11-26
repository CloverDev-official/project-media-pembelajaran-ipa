<?php

namespace App\Livewire\Guru;

use App\Models\Bab;
use Livewire\Component;

class Materi extends Component
{
    protected $listeners = ['materiUpdated' => 'refreshData'];
    public $daftarBab;

    public function mount()
    {
        $this->refreshData();
    }

    public function refreshData()
    {
        $this->daftarBab = Bab::all();
    }

    public function render()
    {
        return view('livewire.guru.materi')->layout('components.layouts.app-guru');
    }
}
