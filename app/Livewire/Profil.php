<?php

namespace App\Livewire;

use App\Models\NilaiLatihan;
use App\Models\NilaiUlangan;
use Livewire\Component;

class Profil extends Component
{
    public $infoMurid;

    public $nilaiTertinggi;
    public $nilaiTerendah;
    public $nilaiRataRata;

    public $daftarNilai = [];

    public function mount()
    {
        $murid = auth('murid')->user();
        $this->infoMurid = $murid->load('kelas');

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
        // Gabungkan semua nilai
        $semuaNilai = $latihan->pluck('nilai')->concat($ulangan->pluck('nilai'));

        // Cari nilai tertinggi & terendah
        $this->nilaiTertinggi = $semuaNilai->max();
        $this->nilaiTerendah = $semuaNilai->min();
        $this->nilaiRataRata = $semuaNilai->count() > 0 ? round($semuaNilai->avg(), 2) : 0;

        $this->chart();
    }

    public function chart()
    {
        $this->dispatch('renderChart', chartData: $this->daftarNilai);
    }

    public function render()
    {
        return view('livewire.profil');
    }
}
