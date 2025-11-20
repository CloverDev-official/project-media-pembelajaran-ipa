<?php

namespace App\Livewire\Guru;

use App\Models\Kelas;
use Livewire\Component;

class RekapNilai extends Component
{
    public $daftarKelas;
    public $daftarUlangan;
    public $daftarLatihan;

    public function mount()
    {
        $this->daftarKelas = Kelas::with([
            'murid' => function ($query) {
                $query->orderBy('absen', 'asc')->with(['nilaiUlangan', 'nilaiLatihan']);
            },
        ])->get();
    }

    public function render()
    {
        return view('livewire.guru.rekap-nilai')->layout('components.layouts.app-guru');
    }
}
