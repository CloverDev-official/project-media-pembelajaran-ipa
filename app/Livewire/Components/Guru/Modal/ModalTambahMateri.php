<?php

namespace App\Livewire\Components\Guru\Modal;

use App\Helpers\ValidateMagic;
use App\Models\Bab;
use App\Models\IsiBab;
use App\Models\Kelas;
use App\Models\Latihan;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class ModalTambahMateri extends Component
{
    use WithFileUploads;

    public $showModal = false;
    public $judul;
    public $deskripsi;
    public $gambar;
    public $kelasId;
    public $daftarKelas;
    protected $listeners = [
        'openTambahMateri' => 'open',
        'closeTambahMateri' => 'close',
    ];

    public function mount()
    {
        $this->loadData();
    }

    public function open()
    {
        $this->loadData();
        $this->showModal = true;
    }

    public function close()
    {
        $this->showModal = false;
    }

    public function loadData()
    {
        $this->daftarKelas = Kelas::all();
        $this->kelasId = $this->daftarKelas->first()->id ?? null;
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
            ],
            [
                'judul.required' => 'Judul wajib diisi!',
                'judul.max' => 'Judul tidak boleh lebih dari 255 karakter!',
                'gambar.image' => 'File yang diunggah harus berupa gambar!',
                'gambar.max' => 'Ukuran gambar tidak boleh lebih dari 5MB!',
                'deskripsi.string' => 'Deskripsi harus berupa teks!',
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
                "gambar_materi/{$judulFolder}",
                "sampul-{$uniq}.{$ext}",
                'public',
            );
        }

        $guruId = auth('guru')->id();

        $bab = Bab::create([
            'guru_id' => $guruId,
            'kelas_id' => $this->kelasId,
            'judul_bab' => $this->judul,
            'deskripsi' => $this->deskripsi,
            'gambar' => $gambarPath,
        ]);

        IsiBab::create([
            'bab_id' => $bab->id,
        ]);

        Latihan::create([
            'guru_id' => $guruId,
            'bab_id' => $bab->id,
        ]);

        $this->close();
        $this->reset(['judul', 'deskripsi', 'kelasId']);
        return redirect()->route('guru.form-isi-materi', $bab->id);
    }

    public function render()
    {
        return view('livewire.components.guru.modal.modal-tambah-materi');
    }
}
