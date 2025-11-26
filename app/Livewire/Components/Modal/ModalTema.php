<?php

namespace App\Livewire\Components\Modal;

use Livewire\Component;

class ModalTema extends Component
{
    public $showModal = false;
    public $activeTab = 'tema';

    protected $listeners = ['openTema' => 'open', 'closeTema' => 'close'];

    public function open()
    {
        $this->showModal = true;
    }

    public function close()
    {
        $this->showModal = false;
    }

    public function switchTab($tab)
    {
        $this->activeTab = $tab;
    }

    public function pilihTema($warna)
    {
        $this->dispatch('temaChanged', ['color' => $warna]);
        // $this->closeTema();
    }

    public function render()
    {
        return view('livewire.components.modal.modal-tema');
    }
}
