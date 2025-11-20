<?php

namespace App\Livewire\Components\Guru\Modal;

use App\Helpers\ValidateMagic;
use App\Models\Kelas;
use Livewire\Component;

class ModalTambahKelas extends Component
{
    public $showModal = false;
    public $namaKelas;

    protected $listeners = [
        'openTambahKelas' => 'open',
        'closeTambahKelas' => 'close',
    ];

    public function open()
    {
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
                'namaKelas' => 'required|string|max:255|unique:kelas,nama_kelas,',
            ],
            [
                'namaKelas.required' => 'Kelas wajib diisi!',
                'namaKelas.unique' => 'Kelas sudah terdaftar!',
                'namaKelas.max' => 'Kelas tidak boleh lebih dari 255 karakter!',
            ],
            'error',
        );

        if (!$validated) {
            return;
        }

        Kelas::create([
            'nama_kelas' => $this->namaKelas,
        ]);

        $this->close();
        $this->reset(['namaKelas']);
        $this->dispatch('muridUpdated');
    }

    public function render()
    {
        return view('livewire.components.guru.modal.modal-tambah-kelas');
    }
}
