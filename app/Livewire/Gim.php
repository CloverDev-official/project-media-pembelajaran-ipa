<?php

namespace App\Livewire;

use App\Models\GimLevel;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Gim')]
class Gim extends Component
{
    public $levels;

    public function mount()
    {
        $this->levels = GimLevel::where('aktif', true)->orderBy('urutan')->get();
    }

    public function render()
    {
        return view('livewire.gim');
    }
}