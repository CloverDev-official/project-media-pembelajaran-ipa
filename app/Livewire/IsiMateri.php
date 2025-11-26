<?php

namespace App\Livewire;

use App\Helpers\ToastMagic;
use App\Models\Bab;
use App\Models\IsiLatihan;
use App\Models\Latihan;
use App\Models\NilaiLatihan;
use Livewire\Component;

class IsiMateri extends Component
{
    public $mulai = false;
    public $daftarSoal = [];
    public $jumlahSoal = 0;
    public $halamanSekarang = 1;
    public $soalSekarang;
    public $jumlahBenar = 0;
    public $jumlahSalah = 0;
    public $tampilkanHasilLatihan = false;
    public $nilai;
    public $jawaban = [];
    public $hasilJawaban = [];
    public $latihanId;
    public $latihanAda = false;
    public $selesai = false;
    public $waktuMulai;
    public $waktuPengerjaanFormated;

    public $bab;

    protected $listeners = [
        'mulaiLatihan' => 'mulaiLatihan',
    ];

    public function mount($babId)
    {
        $this->bab = Bab::with('isiBab')->find($babId);
        $latihan = Latihan::where('bab_id', $babId);
        $this->latihanId = $latihan->value('id');
        $this->latihanAda = IsiLatihan::where('latihan_id', $this->latihanId)->exists();
        if ($this->latihanAda) {
            $this->loadLatihan();
        }

        if (!$this->bab) {
            abort(403, 'Bab tidak ditemukan');
        }
    }

    public function loadLatihan(): void
    {
        $this->waktuMulai = now();
        $this->waktuPengerjaanFormated = $this->decimalToTime(
            Latihan::find($this->latihanId, ['waktu_pengerjaan'])->waktu_pengerjaan,
        );
        $this->daftarSoal = IsiLatihan::where('latihan_id', $this->latihanId)
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
                ],
            )
            ->toArray();

        $sudahDikerjakan = NilaiLatihan::where('latihan_id', $this->latihanId)
            ->where('murid_id', auth('murid')->id())
            ->exists();

        if ($sudahDikerjakan) {
            $this->selesai = true;
            return;
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

    public function getSoalById($id)
    {
        return collect($this->daftarSoal)->firstWhere('id', $id);
    }

    private function formatHasilJawaban($soalId, $jawabanUser, $jawabanBenar)
    {
        $soal = $this->getSoalById($soalId) ?? [];

        return [
            'soal' => $soal['soal'] ?? null,
            'a' => $soal['a'] ?? null,
            'b' => $soal['b'] ?? null,
            'c' => $soal['c'] ?? null,
            'd' => $soal['d'] ?? null,
            'jawaban_user' => $jawabanUser ?? null,
            'jawaban_benar' => $jawabanBenar ?? null,
            'benar' => $jawabanBenar !== null && $jawabanBenar === $jawabanUser,
        ];
    }

    public function periksaSemuaJawaban($paksa = false)
    {
        if ($paksa) {
        } elseif ($this->cekJawabanKosong()) {
            return;
        }

        $jawabanBenar = IsiLatihan::where('latihan_id', $this->latihanId)
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
    }

    public function masukanNilai()
    {
        NilaiLatihan::create([
            'latihan_id' => $this->latihanId,
            'murid_id' => auth('murid')->id(),
            'nilai' => $this->nilai,
            'benar' => $this->jumlahBenar,
            'salah' => $this->jumlahSalah,
            'dikerjakan_pada' => now(),
        ]);
    }

    public function tampilkanHasil()
    {
        $this->periksaSemuaJawaban();
        $this->masukanNilai();
        $this->tampilkanHasilLatihan = true;
    }

    public function waktuHabis()
    {
        $waktuPengerjaan = Latihan::find($this->latihanId, ['waktu_pengerjaan'])->waktu_pengerjaanl;
        $waktuSelesai = $this->waktuMulai->copy()->addMinutes($waktuPengerjaan);
        $remaining = now()->diffInSeconds($waktuSelesai, false);

        if ($remaining <= 0) {
            $this->periksaSemuaJawaban(paksa: true);
            $this->masukanNilai();
            $this->tampilkanHasilLatihan = true;
        }
    }

    function decimalToTime($decimal)
    {
        $hours = floor($decimal);
        $minutes = round(($decimal - $hours) * 60);

        return sprintf('%02d:%02d', $hours, $minutes);
    }

    public function mulaiLatihan()
    {
        $this->mulai = true;
        $this->dispatch('closeMulaiLatihan');
    }

    public function render()
    {
        return view('livewire.isi-materi')->layout('components.layouts.app');
    }
}
