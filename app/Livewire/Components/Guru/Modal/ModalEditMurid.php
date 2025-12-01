<?php

namespace App\Livewire\Components\Guru\Modal;

use App\Helpers\ToastMagic;
use App\Helpers\ValidateMagic;
use App\Models\SMPN11Murid;
use Illuminate\Validation\Rule;
use Livewire\Component;

class ModalEditMurid extends Component
{
    public $showModal = false;
    public $murid;
    public $nipd;
    public $nama;
    public $absen;

    protected $listeners = [
        'openEditMurid' => 'open',
        'closeEditMurid' => 'close',
    ];

    public function open($muridId)
    {
        $this->murid = SMPN11Murid::find($muridId);
        $this->nipd = $this->murid->nipd;
        $this->nama = $this->murid->nama;
        $this->absen = $this->murid->absen;

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
                'nipd' => 'required|string|unique:murid,nipd,' . $this->murid->id,
                'nama' => 'required|string|max:255',
                'absen' => [
                    'required',
                    'integer',
                    Rule::unique('murid', 'absen')->where('kelas_id', $this->murid->kelas_id)->ignore($this->murid->id),
                ],
            ],
            [
                'nipd.required' => 'NIPD wajib diisi!',
                'nipd.unique' => 'NIPD sudah terdaftar!',
                'nama.required' => 'Nama wajib diisi!',
                'nama.max' => 'Nama tidak boleh lebih dari 255 karakter!',
                'absen.required' => 'Nomor absen wajib diisi!',
                'absen.integer' => 'Nomor absen harus berupa angka!',
                'absen.unique' => 'Nomor absen sudah terdaftar di kelas ini!',
            ],
            'error',
        );


        if (!$validated) {
            return;
        }

        $this->murid->update([
            'nipd' => $this->nipd,
            'nama' => $this->nama,
            'absen' => $this->absen,
        ]);

        $this->close();
        $this->dispatch('muridUpdated');
    }

    public function render()
    {
        return view('livewire.components.guru.modal.modal-edit-murid');
    }
}
