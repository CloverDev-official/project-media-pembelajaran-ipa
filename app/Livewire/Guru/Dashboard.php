<?php

namespace App\Livewire\Guru;

use App\Models\Kelas;
use Livewire\Component;

class Dashboard extends Component
{
    public $kelasTerpilih;
    public $ringkasanNilai;
    public $infoGuru;

    public function mount()
    {
        $this->infoGuru = auth('guru')->user();

        $this->kelasTerpilih = Kelas::with([
            'murid' => function ($query) {
                $query
                    ->with(['nilaiUlangan', 'nilaiLatihan'])
                    ->inRandomOrder()
                    ->take(3);
            },
        ])
            ->inRandomOrder()
            ->take(2)
            ->get();

        if ($this->kelasTerpilih->isEmpty()) {
            $this->ringkasanNilai = collect();
            return;
        }

        $this->ringkasanNilai = [$this->kelasTerpilih->first()];
    }

    public function render()
    {
        return view('livewire.guru.dashboard')->layout('components.layouts.app-guru');
    }
}
