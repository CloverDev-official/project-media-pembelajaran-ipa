<?php
namespace App\Livewire\Components;
use Livewire\Component;

class Navbar extends Component
{
    public $murid;
    public $infoMurid;
    
    protected $listeners = [
        'refreshFotoProfil' => 'refresh'
    ];
    
    public function mount()
    {
        $this->murid = auth('murid')->user();
        
        // Add null check before calling load()
        if ($this->murid) {
            $this->infoMurid = $this->murid->load('kelas');
        }
    }
    
    public function render()
    {
        return view('livewire.components.navbar');
    }
}