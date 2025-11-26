<?php

namespace App\Livewire\Components\Guru;

use Livewire\Component;

class Sidebar extends Component
{
    public $sidebarCollapsed = true;

    public $currentRoute;

    public function mount()
    {
        $this->sidebarCollapsed = session('sidebarCollapsed', true);
        $this->currentRoute = request()->route()->getName();
    }

    public function toggleSidebar()
    {
        $this->sidebarCollapsed = !$this->sidebarCollapsed;
        session(['sidebarCollapsed' => $this->sidebarCollapsed]);
        $this->dispatch('sidebar-toggled', collapsed: $this->sidebarCollapsed);
    }

    public function render()
    {
        return view('livewire.components.guru.sidebar');
    }
}
