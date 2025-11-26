<?php

namespace App\Livewire\Guru;

use App\Models\Kelas;
use App\Models\Latihan;
use App\Models\Ulangan;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\RekapNilaiExport;

class RekapNilai extends Component
{
    public $daftarKelas;
    public $daftarLatihan;
    public $daftarUlangan;

    public function mount()
    {
        // kelas + murid + semua nilai murid
        $this->daftarKelas = Kelas::with([
            'murid' => function ($q) {
                $q->orderBy('absen', 'asc'); // relasi: Murid hasMany NilaiUlangan
            },
        ])->get();

        $this->daftarLatihan = Latihan::select('id', 'bab_id')->with('bab:id,judul_bab')->get();

        $this->daftarUlangan = Ulangan::select('id', 'judul')->get();
    }

    public function exportKelas($kelasId)
    {
        $kelas = Kelas::with(['murid.nilaiLatihan', 'murid.nilaiUlangan'])->findOrFail($kelasId);

        return Excel::download(
            new RekapNilaiExport($kelas),
            'rekap_nilai_kelas_' . $kelas->nama_kelas . '.xlsx',
        );
    }

    public function render()
    {
        return view('livewire.guru.rekap-nilai')->layout('components.layouts.app-guru');
    }
}
