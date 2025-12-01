<?php

namespace App\Livewire;

use App\Models\GimLevel;
use Livewire\Component;

#[Title('Gim Pencocokan')]
class GimPencocokan extends Component
{
    public $levelId;
    public $level;
    public $pasanganAcak = []; // Akan menyimpan pasangan yang sudah diacak
    public $jawabanMurid = []; // Struktur: ['teks_kanan' => 'teks_kiri']
    public $hasilAkhir = []; // Untuk menyimpan hasil benar/salah per item kiri
    public $selesai = false;
    public $skor = 0;
    public $title = 'Gim Pencocokan';
    public $semuaLevel;
    public $pesan = 'Taruh semua item ke drop slot terlebih dahulu!'; // Untuk menyimpan pesan validasi

    public function mount($levelId = null)
    {
        $this->semuaLevel = GimLevel::where('aktif', true)->orderBy('urutan')->get();
        if ($levelId) {
            $this->setLevel($levelId);
        } else {
            $levelPertama = $this->semuaLevel->first();
            if ($levelPertama) {
                $this->setLevel($levelPertama->id);
            }
        }
    }

    public function setLevel($levelId)
    {
        $this->levelId = $levelId;
        $this->level = GimLevel::findOrFail($levelId);
        $this->acakPasangan();
        $this->resetPermainan();
    }

    /**
     * Fungsi untuk mengacak urutan pasangan, tetapi memastikan 'kiri' dan 'kanan' tetap berpasangan.
     */
    private function acakPasangan()
    {
        $pasangan = $this->level->pasangan; // Ambil pasangan asli
        shuffle($pasangan); // Acak array pasangannya
        $this->pasanganAcak = $pasangan;
    }

    public function resetPermainan()
    {
        $this->acakPasangan(); // Acak ulang saat permainan diulang secara penuh
        $this->jawabanMurid = [];
        $this->hasilAkhir = [];
        $this->selesai = false;
        $this->skor = 0;
        $this->pesan = '';
    }

    // Method baru untuk mereset hanya slot drop
    public function resetSlot()
    {
        $this->jawabanMurid = [];
        $this->hasilAkhir = [];
        $this->skor = 0;
        $this->selesai = false; // Karena jawaban direset, permainan kembali aktif
        $this->pesan = '';
    }

    /**
     * Metode baru yang akan dipanggil dari JavaScript untuk memperbarui jawaban.
     */
    public function updateJawaban($target, $source)
    {
        // $target adalah teks di kolom kanan, $source adalah teks yang diseret dari kolom kiri
        $this->jawabanMurid[$target] = $source;
    }

    public function submit()
    {
        // Validasi: periksa apakah semua item sudah diisi
        $totalPasangan = count($this->level->pasangan);
        if (count($this->jawabanMurid) < $totalPasangan) {
            $this->pesan = 'Mohon lengkapi semua pasangan terlebih dahulu!';
            return;
        }

        $pasanganBenar = $this->level->pasangan;
        $benar = 0;
        $this->hasilAkhir = []; // Reset hasil
        $this->pesan = ''; // Reset pesan

        // Buat peta (map) untuk pencarian cepat: ['teks_kanan' => 'teks_kiri']
        $petaBenar = [];
        foreach ($pasanganBenar as $item) {
            $petaBenar[$item['kanan']] = $item['kiri'];
        }

        // Periksa setiap jawaban murid
        foreach ($this->jawabanMurid as $targetKanan => $sourceKiri) {
            if (isset($petaBenar[$targetKanan]) && $petaBenar[$targetKanan] === $sourceKiri) {
                $benar++;
                // Simpan hasil berdasarkan 'kiri' untuk memudahkan tampilan di Blade
                $this->hasilAkhir[$sourceKiri] = true;
            } else {
                // Jika salah, simpan juga statusnya
                $this->hasilAkhir[$sourceKiri] = false;
            }
        }

        // Jika ada item yang tidak diisi, tandai sebagai salah
        foreach($pasanganBenar as $item) {
            if(!array_key_exists($item['kiri'], $this->hasilAkhir)) {
                $this->hasilAkhir[$item['kiri']] = false;
            }
        }

        $this->skor = $benar;
        $this->selesai = true;
    }

    public function render()
    {
        return view('livewire.gim-pencocokan');
    }
}