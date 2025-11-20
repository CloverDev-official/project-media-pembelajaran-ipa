<?php

namespace App\Livewire\Components\Guru\Modal;

use App\Helpers\ToastMagic;
use App\Helpers\ValidateMagic;
use App\Models\SMPN11Murid;
use Livewire\Component;

class ModalEditMurid extends Component
{
    public $showModal = false;
    public $muridId;
    public $kelasId;
    public $nipd;
    public $nama;
    public $absen;

    protected $listeners = [
        'openEditMurid' => 'open',
        'closeEditMurid' => 'close',
    ];

    public function open($muridId, $kelasId)
    {
        $this->muridId = $muridId;
        $this->kelasId = $kelasId;

        $murid = SMPN11Murid::find($muridId);
        $this->nipd = $murid->nipd;
        $this->nama = $murid->nama;
        $this->absen = $murid->absen;

        $this->showModal = true;
    }

    public function close()
    {
        $this->showModal = false;
    }

    public function update()
    {
        $validated = ValidateMagic::run(
            [
                'nipd' => 'required|string|unique:murid,nipd,' . $this->muridId,
                'nama' => 'required|string|max:255',
            ],
            [
                'nipd.required' => 'NIPD wajib diisi!',
                'nipd.unique' => 'NIPD sudah terdaftar!',
                'nama.required' => 'Nama wajib diisi!',
                'nama.max' => 'Nama tidak boleh lebih dari 255 karakter!',
            ],
            'error',
        );

        if (!$validated) {
            return;
        }

        $murid = SMPN11Murid::find($this->muridId);
        $murid->update([
            'nipd' => $this->nipd,
            'nama' => $this->nama,
            'absen' => $this->absen,
            'kelas_id' => $this->kelasId,
        ]);

        $this->close();
        $this->dispatch('muridUpdated');
    }

    public function render()
    {
        return view('livewire.components.guru.modal.modal-edit-murid');
    }
}
