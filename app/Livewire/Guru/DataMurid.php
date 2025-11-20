<?php

namespace App\Livewire\Guru;

use App\Models\Kelas;
use Livewire\Component;

class DataMurid extends Component
{
    protected $listeners = ['muridUpdated' => 'refreshData'];

    public $daftarKelas;

    public function mount()
    {
        $this->refreshData();
    }

    public function refreshData()
    {
        $this->daftarKelas = Kelas::with([
            'murid' => fn($query) => $query->orderBy('absen', 'asc'),
        ])->get();
    }

    public function render()
    {
        return view('livewire.guru.data-murid')->layout('components.layouts.app-guru');
    }
}
