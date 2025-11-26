<?php

namespace App\Livewire;

use App\Models\Ulangan;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Ulangan')]
class DaftarUlangan extends Component
{
    public $daftarUlangan;

    protected $listeners = [
        'updateStatusUlangan' => 'updateUlangan',
    ];

    public function mount()
    {
        $this->daftarUlangan = Ulangan::all()->map(function ($ulangan) {
            $ulangan->dibuka =
                $ulangan->waktu_dibuka && $ulangan->waktu_ditutup
                    ? now()->between($ulangan->waktu_dibuka, $ulangan->waktu_ditutup)
                    : false;
            $ulangan->dikerjakan = $ulangan
                ->nilaiUlangan()
                ->where('murid_id', auth('murid')->id())
                ->exists();

            return $ulangan;
        });

        // dd($this->daftarUlangan->toArray());
    }

    public function updateUlangan($id)
    {
        foreach ($this->daftarUlangan as $i => $item) {
            if ($item->id == $id) {
                $this->daftarUlangan[$i]['dibuka'] = now()->between(
                    $item['waktu_dibuka'],
                    $item['waktu_ditutup'],
                );
                break;
            }
        }
    }

    public function render()
    {
        return view('livewire.daftar-ulangan');
    }
}
