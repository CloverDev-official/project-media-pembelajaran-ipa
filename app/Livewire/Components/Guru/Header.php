<?php

namespace App\Livewire\Components\Guru;

use Livewire\Component;
use Carbon\Carbon;

class Header extends Component
{
    public function render()
    {
        Carbon::setLocale('id');
        $dateNow = Carbon::now()->translatedFormat('d F Y, l');

        return view('livewire.components.guru.header', [
            'welcomeMessage' => 'Selamat datang, Guru',
            'dateNow' => $dateNow,
        ]);
    }
}
