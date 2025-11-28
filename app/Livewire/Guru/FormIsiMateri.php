<?php

namespace App\Livewire\Guru;

use App\Helpers\ToastMagic;
use App\Models\Bab;
use App\Models\InteractiveVideo;
use App\Models\IsiBab; // Add this import
use Livewire\Component;

class FormIsiMateri extends Component
{
    public $babId;
    public $judulBab;
    public $isiBab;
    public $teksBab;
    public $editorId = 'teksBab';
    public $selectedVideos = [];
    public $showVideoModal = false;

    protected $listeners = [
        'openVideoModal' => 'openVideoModal',
        'closeVideoModal' => 'closeVideoModal',
    ];

    public function mount($babId)
    {
        $this->babId = $babId;
        $bab = Bab::with(['isiBab' => function($query) {
            $query->with('interactiveVideos'); // Eager load videos
        }])->find($this->babId);

        if (!$bab) {
            abort(404, 'Bab tidak ditemukan');
        }

        $this->judulBab = $bab->judul_bab;

        // Check if isiBab exists before accessing its properties
        if ($bab->isiBab) {
            $this->isiBab = $bab->isiBab;
            $this->teksBab = ['main' => $bab->isiBab->isi_materi ?? ''];
            
            // Safely get selected videos
            $this->selectedVideos = $bab->isiBab->interactiveVideos ? 
                $bab->isiBab->interactiveVideos->pluck('id')->toArray() : [];
        } else {
            // Initialize empty values if no isiBab exists
            $this->isiBab = null;
            $this->teksBab = ['main' => ''];
            $this->selectedVideos = [];
        }
    }

    public function save()
    {
        // If isiBab doesn't exist, create it first
        if (!$this->isiBab) {
            $this->isiBab = IsiBab::create([
                'bab_id' => $this->babId,
                'isi_materi' => $this->teksBab['main'],
            ]);
        } else {
            // Update existing isiBab
            $this->isiBab->update([
                'isi_materi' => $this->teksBab['main'],
            ]);
        }

        // Sync videos (will work even if isiBab was just created)
        $this->isiBab->interactiveVideos()->sync($this->selectedVideos);

        $this->reset([ 'teksBab', 'selectedVideos']);

        ToastMagic::success('Materi berhasil disimpan', useSessionFlash: true);

        $this->redirectRoute('guru.materi', navigate: true);
    }

    public function openVideoModal()
    {
        $this->showVideoModal = true;
    }

    public function closeVideoModal()
    {
        $this->showVideoModal = false;
    }

    public function toggleVideo($videoId)
    {
        if (in_array($videoId, $this->selectedVideos)) {
            $this->selectedVideos = array_diff($this->selectedVideos, [$videoId]);
        } else {
            $this->selectedVideos[] = $videoId;
        }
        $this->selectedVideos = array_values($this->selectedVideos);
    }

    public function render()
    {
        $allInteractiveVideos = InteractiveVideo::all();
        return view('livewire.guru.form-isi-materi', [
            'allInteractiveVideos' => $allInteractiveVideos
        ])->layout('components.layouts.app-guru');
    }
}