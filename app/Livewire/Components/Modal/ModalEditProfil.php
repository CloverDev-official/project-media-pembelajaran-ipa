<?php

namespace App\Livewire\Components\Modal;

use Livewire\Component;

class ModalEditProfil extends Component
{
    public $showModalEditProfil = false;

    protected $listeners = ['toggleEditProfilPopup' => 'toggle'];

    public function toggle()
    {
        $this->showModalEditProfil = !$this->showModalEditProfil;
    }

    public function render()
    {
        return view('livewire.components.modal.modal-edit-profil');
    }
}
