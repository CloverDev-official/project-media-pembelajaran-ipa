<?php

namespace App\Livewire;

use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Gim')]

class Gim extends Component
{
    public function render()
    {
        return view('livewire.gim');
    }
}
