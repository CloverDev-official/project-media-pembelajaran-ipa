<?php

namespace App\Livewire\Components\Guru\Modal;

use App\Helpers\ValidateMagic;
use App\Models\Bab;
use App\Models\IsiBab;
use App\Models\Kelas;
use App\Models\Latihan;
use Livewire\Component;

class ModalTambahMateri extends Component
{
    public $showModal = false;
    public $judul;
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

        $guruId = auth('guru')->id();

        $bab = Bab::create([
            'guru_id' => $guruId,
            'kelas_id' => $this->kelasId,
            'judul_bab' => $this->judul,
        ]);

        IsiBab::create([
            'bab_id' => $bab->id,
        ]);

        Latihan::create([
            'guru_id' => $guruId,
            'bab_id' => $bab->id,
        ]);

        $this->close();
        $this->reset(['judul']);
        return redirect()->route('guru.form-isi-materi', $bab->id);
    }

    public function render()
    {
        return view('livewire.components.guru.modal.modal-tambah-materi');
    }
}
