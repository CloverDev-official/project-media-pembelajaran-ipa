<?php

namespace App\Livewire\Guru;

use App\Models\Kelas;
use App\Models\Latihan;
use App\Models\NilaiLatihan;
use App\Models\NilaiUlangan;
use App\Models\Ulangan;
use Livewire\Component;

class Dashboard extends Component
{
    public $kelasTerpilih;
    public $ringkasanNilai;
    public $infoGuru;
    public $daftarLatihan;
    public $daftarUlangan;
    public $peformaKelas = [];

    public function mount()
    {
        $this->infoGuru = auth('guru')->user();

        // 2 kelas acak, tiap kelas 3 murid acak + nilai
        $this->kelasTerpilih = Kelas::with([
            'murid' => function ($query) {
                $query->inRandomOrder()->take(3);
            },
        ])
            ->inRandomOrder()
            ->take(2)
            ->get();

        foreach ($this->kelasTerpilih as $kelas) {
            $jumlahMurid = $kelas->murid()->count();

            $totalLatihan = NilaiLatihan::whereHas('murid', function ($q) use ($kelas) {
                $q->where('kelas_id', $kelas->id);
            })->sum('nilai');

            $totalUlangan = NilaiUlangan::whereHas('murid', function ($q) use ($kelas) {
                $q->where('kelas_id', $kelas->id);
            })->sum('nilai');

            $totalNilai = $totalLatihan + $totalUlangan;

            $rataRata = $jumlahMurid > 0 ? round($totalNilai / $jumlahMurid, 2) : 0;

            $this->peformaKelas[] = [
                'label' => $kelas->nama_kelas,
                'value' => $rataRata,
            ];
        }

        // kalau tidak ada kelas sama sekali
        if ($this->kelasTerpilih->isEmpty()) {
            $this->ringkasanNilai = null;
            $this->daftarLatihan = collect();
            $this->daftarUlangan = collect();
            return;
        }

        $this->ringkasanNilai = $this->kelasTerpilih->first();

        $this->daftarLatihan = Latihan::select('id', 'bab_id')->with('bab:id,judul_bab')->get();

        $this->daftarUlangan = Ulangan::select('id', 'judul')->get();

        $this->chart();
    }

    public function chart()
    {
        $this->dispatch('renderChart', chartData: $this->peformaKelas);
    }

    public function render()
    {
        return view('livewire.guru.dashboard')->layout('components.layouts.app-guru');
    }
}
