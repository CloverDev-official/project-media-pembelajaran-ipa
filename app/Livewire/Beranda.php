<?php

namespace App\Livewire;

use App\Models\Bab;
use App\Models\NilaiLatihan;
use App\Models\NilaiUlangan;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\Volt\Compilers\Mount;

#[Title('Beranda')]
class Beranda extends Component
{
    public $daftarMateri;
    public $jumlahNilai;
    public $nilaiRataRata;
    public $daftarNilai = [];

    public function mount()
    {
        $murid = auth('murid')->user();

        $this->daftarMateri = Bab::inRandomOrder()->take(3)->get();

        // Ambil seluruh nilai (latihan + ulangan) dalam 2 query
        $ulangan = NilaiUlangan::select('id', 'nilai', 'ulangan_id', 'murid_id')
            ->with('ulangan:id,judul')
            ->where('murid_id', $murid->id)
            ->get();

        $latihan = NilaiLatihan::select('id', 'nilai', 'latihan_id')
            ->with(['latihan:id,bab_id', 'latihan.bab:id,judul_bab'])
            ->where('murid_id', $murid->id)
            ->get();

        // Map nilai latihan
        $nilaiLatihan = $latihan->map(function ($item) {
            return [
                'label' => $item->latihan->bab->judul_bab . ' (Latihan)',
                'value' => $item->nilai,
            ];
        });

        // Map nilai ulangan
        $nilaiUlangan = $ulangan->map(function ($item) {
            return [
                'label' => $item->ulangan->judul . ' (Ulangan)',
                'value' => $item->nilai,
            ];
        });

        // Gabungkan menjadi satu daftar
        $this->daftarNilai = $nilaiLatihan->concat($nilaiUlangan)->values()->toArray();
        $semuaNilai = $latihan->pluck('nilai')->concat($ulangan->pluck('nilai'));
        $this->jumlahNilai = $semuaNilai->count();
        $this->nilaiRataRata = $this->jumlahNilai > 0 ? round($semuaNilai->avg(), 2) : 0;

        $this->chart();

    }
    public function chart()
    {
        $this->dispatch('renderChart', chartData: $this->daftarNilai);
    }

    public function render()
    {
        return view('livewire.beranda');
    }
}
