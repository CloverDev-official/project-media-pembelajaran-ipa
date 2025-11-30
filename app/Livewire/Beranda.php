<?php

namespace App\Livewire;

use App\Models\NilaiLatihan;
use App\Models\NilaiUlangan;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\Volt\Compilers\Mount;

#[Title('Beranda')]
class Beranda extends Component
{
    public $jumlahNilai;
    public $nilaiRataRata;

    public function mount()
    {
        $murid = auth('murid')->user();

        $ulangan = NilaiUlangan::select('id', 'nilai', 'ulangan_id', 'murid_id')
            ->where('murid_id', $murid->id)
            ->get();

        $latihan = NilaiLatihan::select('id', 'nilai', 'latihan_id')
            ->where('murid_id', $murid->id)
            ->get();


        $semuaNilai = $latihan->pluck('nilai')->concat($ulangan->pluck('nilai'));
        $this->jumlahNilai = $semuaNilai->count();
        $this->nilaiRataRata = $this->jumlahNilai > 0 ? round($semuaNilai->avg(), 2) : 0;
    }

    public function render()
    {
        return view('livewire.beranda');
    }
}
