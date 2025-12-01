<?php

namespace App\Livewire\Components\Guru\Modal;

use App\Helpers\ToastMagic;
use App\Helpers\ValidateMagic;
use App\Models\Bab;
use App\Models\IsiBab;
use App\Models\Kelas;
use App\Models\Latihan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class ModalEditMateri extends Component
{
    use WithFileUploads;

    public $showModal = false;
    public $judul;
    public $bab;
    public $babId;
    public $kelasId;
    public $deskripsi;
    public $daftarKelas;
    public $gambar;

    protected $listeners = [
        'openEditMateri' => 'open',
        'closeEditMateri' => 'close',
    ];

    public function mount()
    {
        $this->loadKelas();
    }

    public function open($babId)
    {
        $this->babId = $babId;
        $this->loadKelas();
        $this->loadBab();
        $this->showModal = true;
    }

    public function close()
    {
        $this->showModal = false;
    }

    public function loadBab()
    {
        $this->bab = Bab::find($this->babId);
        $this->judul = $this->bab->judul_bab;
        $this->deskripsi = $this->bab->deskripsi;
    }

    public function loadKelas()
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
                'gambar' => 'nullable|image|max:5120',
                'deskripsi' => 'nullable|string',
            ],
            [
                'judul.required' => 'Judul wajib diisi!',
                'judul.max' => 'Judul tidak boleh lebih dari 255 karakter!',
                'gambar.image' => 'File harus berupa gambar!',
                'gambar.max' => 'Gambar tidak boleh lebih dari 5MB!',
                'deskripsi.string' => 'Deskripsi harus berupa teks!',
            ],
            'error',
        );

        if (!$validated) {
            return;
        }

        $gambarPath = $this->bab->gambar;
        if ($this->gambar instanceof TemporaryUploadedFile) {
            Storage::disk('public')->delete($this->bab->gambar);

            $uniq = uniqid();
            $ext = $this->gambar->extension();
            $judulFolder = Str::slug($this->judul, '_');
            $gambarPath = $this->gambar->storeAs(
                "gambar_materi/{$judulFolder}",
                "sampul-{$uniq}.{$ext}",
                'public',
            );
        }

        $this->bab->update([
            'kelas_id' => $this->kelasId,
            'judul_bab' => $this->judul,
            'gambar' => $gambarPath,
            'deskripsi' => $this->deskripsi,
        ]);

        $this->close();
        $this->reset(['judul','deskripsi','gambar','kelasId']);
        return redirect()->route('guru.form-isi-materi', $this->babId);
    }

    public function render()
    {
        return view('livewire.components.guru.modal.modal-edit-materi');
    }
}
