<?php

namespace App\Livewire\Components\Modal;

use Livewire\Component;

class ModalMulaiLatihan extends Component
{
    public $showModal = false;
    protected $listeners = [
        'openMulaiLatihan' => 'open',
        'closeMulaiLatihan' => 'close',
    ];

    public function open()
    {
        $this->showModal = true;
    }

    public function close()
    {
        $this->showModal = false;
    }
    public function render()
    {
        return view('livewire.components.modal.modal-mulai-latihan');
    }
}
