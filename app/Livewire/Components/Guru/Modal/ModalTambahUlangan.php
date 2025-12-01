<?php

namespace App\Livewire\Components\Guru\Modal;

use App\Helpers\ValidateMagic;
use App\Models\Ulangan;
use App\Models\IsiUlangan;
use App\Models\Kelas;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class ModalTambahUlangan extends Component
{
    use WithFileUploads;

    public $showModal = false;
    public $daftarKelas;

    // Properti input
    public $judul;
    public $deskripsi;
    public $gambar;
    public $waktuPengerjaan;
    public $kelasId;
    public $jumlahSoal;
    public $waktuDibuka;
    public $waktuDitutup;

    protected $listeners = [
        'openTambahUlangan' => 'open',
        'closeTambahUlangan' => 'close',
    ];

    public function mount()
    {
        $this->daftarKelas = Kelas::all();
        $this->kelasId = $this->daftarKelas->first()->id ?? null;
    }

    public function open()
    {
        $this->showModal = true;
    }

    public function close()
    {
        $this->showModal = false;
    }

    public function updatedGambar()
    {
        $validate = ValidateMagic::run(
            [
                'gambar' => 'nullable|image|max:5120', // 5MB
            ],
            [
                'gambar.max' => 'Ukuran gambar maksimal adalah 5MB.',
                'gambar.image' => 'File yang diunggah harus berupa gambar.',
            ]
        );

        if (!$validate && $this->gambar instanceof TemporaryUploadedFile){
            $this->gambar->delete();
            $this->reset('gambar');
        }
    }

    public function save()
    {
        $validated = ValidateMagic::run(
            [
                'judul' => 'required|string|max:255',
                'deskripsi' => 'nullable|string',
                'gambar' => 'nullable|image|max:5120',
                'waktuPengerjaan' => 'required|integer|min:1',
                'kelasId' => 'required|exists:kelas,id',
                'jumlahSoal' => 'required|integer|min:1',
                'waktuDibuka' => 'required|date',
                'waktuDitutup' => 'required|date|after:waktuDibuka',
            ],
            [
                'judul.required' => 'Judul wajib diisi!',
                'judul.max' => 'Judul tidak boleh lebih dari 255 karakter!',
                'gambar.image' => 'Gambar harus berupa file gambar!',
                'gambar.max' => 'Gambar tidak boleh lebih dari 5MB!',
                'waktuPengerjaan.required' => 'Waktu pengerjaan wajib diisi!',
                'waktuPengerjaan.integer' => 'Waktu pengerjaan harus berupa angka!',
                'waktuPengerjaan.min' => 'Waktu pengerjaan minimal 1 menit!',
                'kelasId.required' => 'Kelas wajib dipilih!',
                'kelasId.exists' => 'Kelas tidak valid!',
                'jumlahSoal.required' => 'Jumlah soal wajib diisi!',
                'jumlahSoal.integer' => 'Jumlah soal harus berupa angka!',
                'jumlahSoal.min' => 'Jumlah soal minimal 1!',
                'waktuDibuka.required' => 'Waktu dibuka wajib diisi!',
                'waktuDibuka.date' => 'Waktu dibuka tidak valid!',
                'waktuDitutup.required' => 'Waktu ditutup wajib diisi!',
                'waktuDitutup.date' => 'Waktu ditutup tidak valid!',
                'waktuDitutup.after' => 'Waktu ditutup harus setelah waktu dibuka!',
            ],
            'error',
        );

        if (!$validated) {
            return;
        }

        $gambarPath = null;
        if ($this->gambar) {
            $uniq = uniqid();
            $ext = $this->gambar->extension();
            $judulFolder = Str::slug($this->judul, '_');
            $gambarPath = $this->gambar->storeAs(
                "gambar_ulangan/{$judulFolder}",
                "sampul-{$uniq}.{$ext}",
                'public',
            );
        }

        $guruId = auth('guru')->id();

        $ulangan = Ulangan::create([
            'guru_id' => $guruId,
            'judul' => $this->judul,
            'deskripsi' => $this->deskripsi,
            'gambar' => $gambarPath,
            'waktu_pengerjaan' => $this->waktuPengerjaan,
            'kelas_id' => $this->kelasId,
            'jumlah_soal' => $this->jumlahSoal,
            'waktu_dibuka' => $this->waktuDibuka,
            'waktu_ditutup' => $this->waktuDitutup,
        ]);

        $dataIsiUlangan = array_fill(0, $this->jumlahSoal, [
            'ulangan_id' => $ulangan->id,
        ]);

        IsiUlangan::insert($dataIsiUlangan);

        $this->reset([
            'judul',
            'deskripsi',
            'gambar',
            'waktuPengerjaan',
            'kelasId',
            'jumlahSoal',
            'waktuDibuka',
            'waktuDitutup',
        ]);

        $this->close();

        $this->redirectRoute('guru.form-isi-ulangan', [$ulangan->id], navigate: true);
    }

    public function render()
    {
        return view('livewire.components.guru.modal.modal-tambah-ulangan');
    }
}
