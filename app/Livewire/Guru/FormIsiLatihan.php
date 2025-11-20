<?php

namespace App\Livewire\Guru;

use App\Helpers\ToastMagic;
use App\Models\IsiLatihan;
use App\Models\Latihan;
use Livewire\Component;

class FormIsiLatihan extends Component
{
    public $latihanId;
    public $daftarSoal = [];

    public $gambar;

    public function mount()
    {
        $this->daftarSoal = IsiLatihan::where('latihan_id', $this->latihanId)
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

        if (!$this->daftarSoal) {
            abort(404, 'Bab tidak ditemukan');
        }
    }

    public function save()
    {
        foreach ($this->daftarSoal as $soalData) {
            $soal = IsiLatihan::find($soalData['id']);
            if ($soal) {
                // Jika ada upload baru
                // if (
                //     $soalData['gambar'];
                // ) {
                //     $path = $soalData['gambar']->store('soal', 'public');
                //     $soal->gambar = $path;
                // }

                $soal->update([
                    'soal' => $soalData['soal'],
                    'jawaban_a' => $soalData['a'],
                    'jawaban_b' => $soalData['b'],
                    'jawaban_c' => $soalData['c'],
                    'jawaban_d' => $soalData['d'],
                    'jawaban_benar' => $soalData['benar'],
                ]);
            }
        }
        // dd($soal->toArray());
        ToastMagic::success('Latihan berhasil disimpan', useSessionFlash: true);
        $this->redirectRoute('guru.form-isi-materi', [Latihan::find($soal->latihan_id)->bab_id]);
    }
    public function render()
    {
        return view('livewire.guru.form-isi-latihan')->layout('components.layouts.app-guru');
    }
}
