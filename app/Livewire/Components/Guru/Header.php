<?php

namespace App\Livewire\Components\Guru;

use Livewire\Component;
use Carbon\Carbon;

class Header extends Component
{
    // public $namaGuru;
    public $dateNow;

    public function mount()
    {
        Carbon::setLocale('id');
        $this->dateNow = Carbon::now()->translatedFormat('d F Y, l');
        // $this->namaGuru = auth('guru')->user()->nama;
    }

    public function render()
    {
        return view('livewire.components.guru.header');
    }
}
