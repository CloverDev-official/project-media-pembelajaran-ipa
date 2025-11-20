<?php

namespace App\Livewire\Components\Guru\Modal;

use App\Models\Ulangan;
use Livewire\Component;

class ModalHapusUlangan extends Component
{
    public $showModal = false;
    public $ulanganId;

    protected $listeners = [
        'openHapusUlangan' => 'open',
        'closeHapusUlangan' => 'close',
    ];

    public function open($id)
    {
        $this->ulanganId = $id;
        $this->showModal = true;
    }

    public function close()
    {
        $this->showModal = false;
    }

    public function confirmDelete()
    {
        $ulanganBab = Ulangan::find($this->ulanganId);
        $ulanganBab->delete();

        $this->close();
        $this->dispatch('ulanganUpdated');
    }

    public function render()
    {
        return view('livewire.components.guru.modal.modal-hapus-ulangan');
    }
}
