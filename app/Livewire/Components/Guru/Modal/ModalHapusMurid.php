<?php

namespace App\Livewire\Components\Guru\Modal;

use App\Models\SMPN11Murid;
use Livewire\Component;

class ModalHapusMurid extends Component
{
    public $showModal = false;
    public $muridId;

    protected $listeners = [
        'openHapusMurid' => 'open',
        'closeHapusMurid' => 'close',
    ];

    public function open($muridId)
    {
        $this->muridId = $muridId;
        $this->showModal = true;
    }

    public function close()
    {
        $this->showModal = false;
    }

    public function confirmDelete()
    {
        $murid = SMPN11Murid::find($this->muridId);
        $murid->delete();

        $this->close();
        $this->dispatch('muridUpdated');
    }

    public function render()
    {
        return view('livewire.components.guru.modal.modal-hapus-murid');
    }
}
