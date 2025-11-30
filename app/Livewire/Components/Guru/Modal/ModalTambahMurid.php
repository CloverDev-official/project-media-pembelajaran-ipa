<?php

namespace App\Livewire\Components\Guru\Modal;

use App\Helpers\ToastMagic;
use App\Helpers\ValidateMagic;
use App\Models\SMPN11Murid;
use Livewire\Component;

class ModalTambahMurid extends Component
{
    public $showModal = false;
    public $nipd;
    public $nama;
    public $kelasId;
    public $absen;

    protected $listeners = [
        'openTambahMurid' => 'open',
        'closeTambahMurid' => 'close',
    ];

    public function open($id)
    {
        $this->kelasId = $id;
        $this->showModal = true;
    }

    public function close()
    {
        $this->showModal = false;
    }

    public function save()
    {
        $validated = ValidateMagic::run(
            [
                'nipd' => 'required|string|unique:murid,nipd',
                'nama' => 'required|string|max:255',
                'absen' => 'required|integer|unique:murid,absen',
            ],
            [
                'nipd.required' => 'NIPD wajib diisi!',
                'nipd.unique' => 'NIPD sudah terdaftar!',
                'nama.required' => 'Nama wajib diisi!',
                'nama.max' => 'Nama tidak boleh lebih dari 255 karakter!',
                'absen.required' => 'Nomor absen wajib diisi!',
                'absen.integer' => 'Nomor absen harus berupa angka!',
                'absen.unique' => 'Nomor absen sudah terdaftar!',
            ],
            'error',
        );

        if (!$validated) {
            return;
        }

        SMPN11Murid::create([
            'nipd' => $this->nipd,
            'kelas_id' => $this->kelasId,
            'nama' => $this->nama,
            'sekolah' => 'SMPN 11',
            'absen' => $this->absen,
            'password' => bcrypt('smpn11bjm'),
        ]);

        $this->close();
        $this->reset(['nipd', 'nama', 'absen']);
        $this->dispatch('muridUpdated');
    }

    public function render()
    {
        return view('livewire.components.guru.modal.modal-tambah-murid');
    }
}
