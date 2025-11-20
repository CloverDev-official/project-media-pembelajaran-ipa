<?php

namespace App\Livewire;

use App\Models\IsiUlangan;
use Livewire\Component;

class Ulangan extends Component
{
    public $ulanganId;
    public $daftarSoal = [];

    public function mount()
    {
        $this->daftarSoal = IsiUlangan::where('ulangan_id', $this->ulanganId)
            ->get()
            ->map(
                fn($soal) => [
                    'id' => $soal->id,
                    'soal' => $soal->soal,
                    'a' => $soal->jawaban_a,
                    'b' => $soal->jawaban_b,
                    'c' => $soal->jawaban_c,
                    'd' => $soal->jawaban_d,
                    'benar' => $soal->jawaban_benar,
                    'gambar' => $soal->gambar,
                ],
            )
            ->toArray();
    }
    public function render()
    {
        return view('livewire.ulangan');
    }
}
