<?php

namespace App\Livewire\Components\Guru\Modal;

use App\Helpers\ToastMagic;
use App\Helpers\ValidateMagic;
use App\Models\Bab;
use App\Models\IsiBab;
use App\Models\Kelas;
use App\Models\Latihan;
use Livewire\Component;

class ModalEditMateri extends Component
{
    public $showModal = false;
    public $judul;
    public $bab;
    public $babId;
    public $kelasId;
    public $daftarKelas;

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
    }

    public function loadKelas()
    {
        $this->daftarKelas = Kelas::all();
        $this->kelasId = $this->daftarKelas->first()->id ?? null;
    }

    public function save()
    {
        $validated = ValidateMagic::run(
            [
                'judul' => 'required|string|max:255',
            ],
            [
                'judul.required' => 'Judul wajib diisi!',
                'judul.max' => 'Judul tidak boleh lebih dari 255 karakter!',
            ],
            'error',
        );

        if (!$validated) {
            return;
        }

        $this->bab->update([
            'kelas_id' => $this->kelasId,
            'judul_bab' => $this->judul,
        ]);

        $this->close();
        $this->reset(['judul']);
        return redirect()->route('guru.form-isi-materi', $this->babId);
    }

    public function render()
    {
        return view('livewire.components.guru.modal.modal-edit-materi');
    }
}
