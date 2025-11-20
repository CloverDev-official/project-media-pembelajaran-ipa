<?php

namespace App\Livewire\Components\Guru\Modal;

use App\Models\Kelas;
use Livewire\Component;

class ModalHapusKelas extends Component
{
    public $showModal = false;
    public $daftarKelas;
    public $kelasId;

    protected $listeners = [
        'openHapusKelas' => 'open',
        'closeHapusKelas' => 'close',
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

    public function confirmDelete()
    {
        $kelas = Kelas::find($this->kelasId);
        if (!$kelas) {
            return;
        }
        $kelas->delete();

        $this->close();
        $this->dispatch('muridUpdated');
    }

    public function render()
    {
        return view('livewire.components.guru.modal.modal-hapus-kelas');
    }
}
