<?php

namespace App\Livewire;

use App\Helpers\ToastMagic;
use App\Models\IsiUlangan;
use App\Models\NilaiUlangan;
use Livewire\Component;
use App\Models\Ulangan as ModelsUlangan;

class Ulangan extends Component
{
    public $ulanganId;
    public $ulangan;
    public $daftarSoal = [];
    public $jumlahSoal = 0;
    public $halamanSekarang = 1;
    public $soalSekarang;
    public $jawaban = [];
    public $hasilJawaban = [];
    public $jumlahBenar = 0;
    public $jumlahSalah = 0;
    public $tampilkanHasil = false;
    public $nilai;
    public $waktuMulai;
    public $waktuPengerjaanFormated;

    protected $listeners = [
        'cekJawaban' => 'periksaSemuaJawaban',
        'waktuHabis' => 'waktuHabis',
    ];

    public function mount()
    {
        $this->ulangan = ModelsUlangan::find($this->ulanganId);
        $this->waktuMulai = now();
        $this->waktuPengerjaanFormated = $this->decimalToTime($this->ulangan->waktu_pengerjaan);

        $sudahDikerjakan = NilaiUlangan::where('ulangan_id', $this->ulanganId)
            ->where('murid_id', auth('murid')->id())
            ->exists();

        if ($sudahDikerjakan) {
            abort(403, 'Anda sudah mengerjakan ulangan ini.');
        }

        $this->daftarSoal = IsiUlangan::where('ulangan_id', $this->ulanganId)
            ->inRandomOrder()
            ->get()
            ->map(
                fn($soal) => [
                    'id' => $soal->id,
                    'soal' => $soal->soal,
                    'a' => $soal->jawaban_a,
                    'b' => $soal->jawaban_b,
                    'c' => $soal->jawaban_c,
                    'd' => $soal->jawaban_d,
                    'gambar' => $soal->gambar,
                ],
            )
            ->toArray();

        if (!$this->daftarSoal) {
            abort(404, 'Soal tidak ditemukan');
        }

        $this->soalSekarang = $this->daftarSoal[$this->halamanSekarang - 1];
        $this->jumlahSoal = count($this->daftarSoal);
    }

    public function goToPage($halaman)
    {
        if ($halaman < 1 || $halaman > $this->jumlahSoal) {
            return;
        }

        $this->halamanSekarang = $halaman;
        $this->soalSekarang = $this->daftarSoal[$halaman - 1];
    }

    public function getSoalById($id)
    {
        return collect($this->daftarSoal)->firstWhere('id', $id);
    }

    public function cekJawabanKosong()
    {
        foreach ($this->daftarSoal as $soal) {
            if (!isset($this->jawaban[$soal['id']])) {
                ToastMagic::warning('Masih ada jawaban yang kosong, silakan periksa kembali.');
                return true;
            }
        }

        return false;
    }

    private function formatHasilJawaban($soalId, $jawabanUser, $jawabanBenar)
    {
        $soal = $this->getSoalById($soalId) ?? [];

        return [
            'soal' => $soal['soal'] ?? null,
            'gambar' => $soal['gambar'] ?? null,
            'jawaban_user' => $soal[strtolower($jawabanUser)] ?? null,
            'jawaban_benar' => $soal[strtolower($jawabanBenar)] ?? null,
            'benar' => $jawabanBenar !== null && $jawabanBenar === $jawabanUser,
        ];
    }

    public function periksaSemuaJawaban($paksa = false)
    {
        if ($paksa) {
        } elseif ($this->cekJawabanKosong()) {
            return;
        }

        $jawabanBenar = IsiUlangan::where('ulangan_id', $this->ulanganId)
            ->pluck('jawaban_benar', 'id')
            ->toArray();

        foreach ($this->daftarSoal as $soal) {
            $soalId = $soal['id'];
            $jawabanUser = $this->jawaban[$soalId] ?? null;

            $hasil = $this->formatHasilJawaban(
                $soalId,
                $jawabanUser,
                $jawabanBenar[$soalId] ?? null,
            );

            $this->hasilJawaban[] = $hasil;

            $this->jumlahBenar += $hasil['benar'] ? 1 : 0;
            $this->jumlahSalah += !$hasil['benar'] ? 1 : 0;
        }

        $this->nilai = round(($this->jumlahBenar / $this->jumlahSoal) * 100, 2);
        $this->masukanNilai();
        $this->tampilkanHasil();
    }

    public function masukanNilai()
    {
        NilaiUlangan::create([
            'ulangan_id' => $this->ulanganId,
            'murid_id' => auth('murid')->id(),
            'nilai' => $this->nilai,
            'benar' => $this->jumlahBenar,
            'salah' => $this->jumlahSalah,
            'dikerjakan_pada' => now(),
        ]);
    }

    public function waktuHabis()
    {
        $waktuPengerjaan = $this->ulangan->waktu_pengerjaan;
        $waktuSelesai = $this->waktuMulai->copy()->addMinutes($waktuPengerjaan);
        $remaining = now()->diffInSeconds($waktuSelesai, false);

        if ($remaining <= 0) {
            $this->periksaSemuaJawaban(true);
        }
    }

    public function tampilkanHasil()
    {
        $this->tampilkanHasil = true;
    }

    function decimalToTime($decimal)
    {
        $hours = floor($decimal);
        $minutes = round(($decimal - $hours) * 60);

        return sprintf('%02d:%02d', $hours, $minutes);
    }

    public function render()
    {
        return view('livewire.ulangan');
    }
}
