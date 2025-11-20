<?php

namespace App\Livewire\Guru;

use App\Helpers\ToastMagic;
use App\Models\IsiUlangan;
use App\Models\Ulangan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class FormIsiUlangan extends Component
{
    use WithFileUploads;
    public $ulanganId;
    public $daftarSoal = [];

    public $gambar;

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

        if (!$this->daftarSoal) {
            abort(404, 'Bab tidak ditemukan');
        }
    }

    public function save()
    {
        $judulFolder = Str::slug(Ulangan::where('id', $this->ulanganId)->value('judul'), '_');

        foreach ($this->daftarSoal as $soalData) {
            $soal = IsiUlangan::find($soalData['id']);

            if (!$soal) {
                continue;
            }

            $gambarPath = $soal->gambar;

            if ($soalData['gambar'] instanceof TemporaryUploadedFile) {
                if ($soal->gambar) {
                    Storage::disk('public')->delete($soal->gambar);
                }

                $ext = $soalData['gambar']->extension();

                $gambarPath = $soalData['gambar']->storeAs(
                    "gambar_ulangan/gambar_soal/{$judulFolder}",
                    "soal-{$soalData['id']}.{$ext}",
                    'public',
                );
            }

            $soal->update([
                'soal' => $soalData['soal'],
                'jawaban_a' => $soalData['a'],
                'jawaban_b' => $soalData['b'],
                'jawaban_c' => $soalData['c'],
                'jawaban_d' => $soalData['d'],
                'jawaban_benar' => $soalData['benar'],
                'gambar' => $gambarPath,
            ]);
        }

        ToastMagic::success('Ulangan berhasil disimpan', useSessionFlash: true);
        $this->redirectRoute('guru.ulangan', navigate: true);
    }

    public function render()
    {
        return view('livewire.guru.form-isi-ulangan')->layout('components.layouts.app-guru');
    }
}
