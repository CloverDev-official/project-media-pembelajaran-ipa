<?php

namespace App\Livewire;

use App\Models\Bab;
use Livewire\Component;

class IsiMateri extends Component
{
    public $mulai = false;
    public $bab;
    
    public function mount($babId)
    {
        $this->bab = Bab::with('isiBab')->find($babId);

        if (!$this->bab) {
            abort(404, 'Bab tidak ditemukan');
        }
    }

    public function mulaiLatihan()
    {
        $this->mulai = true;
    }

    public function render()
    {
        return view('livewire.isi-materi')->layout('components.layouts.app');
    }
}
