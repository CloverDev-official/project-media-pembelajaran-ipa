<?php

namespace App\Livewire\Components\Guru\Modal;

use Livewire\Component;

class ModalKonfirmasiSaveMateri extends Component
{
    public $showModal = false;
    public $babId;

    protected $listeners = [
        'openModalKonfirmasiSaveMateri' => 'open',
        'closeModalKonfirmasiSaveMateri' => 'close',
    ];

    public function open($babId)
    {
        $this->babId = $babId;
        $this->showModal = true;
    }

    public function close()
    {
        $this->dispatch('openFormLatihan', ['id' => $this->babId]);
        $this->showModal = false;
    }

    public function confirmSave()
    {
        $this->dispatch('saveMateri', ['paksa' => true]);
        $this->close();
    }

    public function render()
    {
        return view('livewire.components.guru.modal.modal-konfirmasi-save-materi');
    }
}
