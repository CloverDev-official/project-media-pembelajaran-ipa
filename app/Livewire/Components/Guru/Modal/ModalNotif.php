<?php

namespace App\Livewire\Components\Guru\Modal;

use Livewire\Component;

class ModalNotif extends Component
{
    public $showModalNotification = false;

    protected $listeners = ['toggleNotificationPopup' => 'toggle'];

    public function toggle()
    {
        $this->showModalNotification = !$this->showModalNotification;
    }

    public function render()
    {
        return view('livewire.components.guru.modal.modal-notif');
    }
}
