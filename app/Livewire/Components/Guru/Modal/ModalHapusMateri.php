<?php

namespace App\Livewire\Components\Guru\Modal;

use App\Models\Bab;
use Livewire\Component;

class ModalHapusMateri extends Component
{
    public $showModal = false;
    public $babId;

    protected $listeners = [
        'openHapusMateri' => 'open',
        'closeHapusMateri' => 'close',
    ];

    public function open($id)
    {
        $this->babId = $id;
        $this->showModal = true;
    }

    public function close()
    {
        $this->showModal = false;
    }

    public function confirmDelete()
    {
        $bab = Bab::find($this->babId);
        $bab->delete();

        $this->close();
        $this->dispatch('materiUpdated');
    }

    public function render()
    {
        return view('livewire.components.guru.modal.modal-hapus-materi');
    }
}
