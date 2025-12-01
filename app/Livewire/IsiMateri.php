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
        $this->bab = Bab::with('isiBab.interactiveVideos')->find($babId);
        
        if (!$this->bab) {
            abort(404, 'Bab tidak ditemukan');
        }

        $latihan = Latihan::where('bab_id', $babId)->first();
        
        if ($latihan) {
            $this->latihanId = $latihan->id;
            $this->latihanAda = IsiLatihan::where('latihan_id', $this->latihanId)->exists();
            
            if ($this->latihanAda) {
                $this->loadLatihan();
            }
        }
    }

    public function loadLatihan(): void
    {
        $this->waktuMulai = now();
        $latihan = Latihan::find($this->latihanId);
        $this->waktuPengerjaanFormated = $this->decimalToTime($latihan->waktu_pengerjaan);
        
        $this->daftarSoal = IsiLatihan::where('latihan_id', $this->latihanId)
            ->inRandomOrder()
            ->get()
            ->map(fn($soal) => [
                'id' => $soal->id,
                'soal' => $soal->soal,
                'a' => $soal->jawaban_a,
                'b' => $soal->jawaban_b,
                'c' => $soal->jawaban_c,
                'd' => $soal->jawaban_d,
            ])
            ->toArray();

        $sudahDikerjakan = NilaiLatihan::where('latihan_id', $this->latihanId)
            ->where('murid_id', auth('murid')->id())
            ->exists();

        if ($sudahDikerjakan) {
            $this->selesai = true;
            return;
        }

        $this->soalSekarang = $this->daftarSoal[0] ?? null;
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
        $kosong = [];
        foreach ($this->daftarSoal as $index => $soal) {
            if (!isset($this->jawaban[$soal['id']])) {
                $kosong[] = $index + 1;
            }
        }

        if (!empty($kosong)) {
            $nomorSoal = implode(', ', $kosong);
            ToastMagic::warning("Soal nomor {$nomorSoal} belum dijawab. Silakan periksa kembali.");
            return true;
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
            'soal' => $soal['soal'] ?? 'Soal tidak ditemukan',
            'a' => $soal['a'] ?? '',
            'b' => $soal['b'] ?? '',
            'c' => $soal['c'] ?? '',
            'd' => $soal['d'] ?? '',
            'jawaban_user' => $jawabanUser,
            'jawaban_benar' => $jawabanBenar,
            'benar' => $jawabanBenar !== null && $jawabanBenar === $jawabanUser,
        ];
    }

    public function periksaSemuaJawaban($paksa = false)
    {
        if (!$paksa && $this->cekJawabanKosong()) {
            return false;
        }

        // Reset counters
        $this->jumlahBenar = 0;
        $this->jumlahSalah = 0;
        $this->hasilJawaban = [];

        $jawabanBenar = IsiLatihan::where('latihan_id', $this->latihanId)
            ->pluck('jawaban_benar', 'id')
            ->toArray();

        foreach ($this->daftarSoal as $soal) {
            $soalId = $soal['id'];
            $jawabanUser = $this->jawaban[$soalId] ?? null;

            $hasil = $this->formatHasilJawaban(
                $soalId,
                $jawabanUser,
                $jawabanBenar[$soalId] ?? null
            );

            $this->hasilJawaban[] = $hasil;

            if ($hasil['benar']) {
                $this->jumlahBenar++;
            } else {
                $this->jumlahSalah++;
            }
        }

        $this->nilai = $this->jumlahSoal > 0 
            ? round(($this->jumlahBenar / $this->jumlahSoal) * 100, 2) 
            : 0;

        return true;
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
        if ($this->periksaSemuaJawaban()) {
            $this->masukanNilai();
            $this->tampilkanHasilLatihan = true;
            
            // Scroll to top smoothly
            $this->dispatch('scroll-to-top');
            
            ToastMagic::success('Latihan berhasil diselesaikan!');
        }
    }

    public function waktuHabis()
    {
        $latihan = Latihan::find($this->latihanId);
        $waktuSelesai = $this->waktuMulai->copy()->addMinutes($latihan->waktu_pengerjaan);
        $remaining = now()->diffInSeconds($waktuSelesai, false);

        if ($remaining <= 0) {
            $this->periksaSemuaJawaban(paksa: true);
            $this->masukanNilai();
            $this->tampilkanHasilLatihan = true;
            
            ToastMagic::info('Waktu pengerjaan telah habis. Latihan diselesaikan otomatis.');
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
        $this->dispatch('scroll-to-section', ['section' => 'latihan']);
    }

    public function render()
    {
        return view('livewire.isi-materi')->layout('components.layouts.app');
    }
}