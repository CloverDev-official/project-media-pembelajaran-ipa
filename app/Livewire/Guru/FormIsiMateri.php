<?php

namespace App\Livewire\Guru;

use App\Helpers\ToastMagic;
use App\Models\Bab;
use App\Models\InteractiveVideo;
use App\Models\IsiBab;
use Livewire\Component;

class FormIsiMateri extends Component
{
    public $babId;
    public $judulBab;
    public $deskripsiBab;
    public $isiBab;
    public $teksBab;
    public $editorId = 'teksBab';
    public $selectedVideos = [];
    public $showVideoModal = false;
    public $formChanged = false; // Track if form has changed

    protected $listeners = [
        'openVideoModal' => 'openVideoModal',
        'closeVideoModal' => 'closeVideoModal',
        // Remove the automatic save listener
    ];

    public function mount($babId)
    {
        $this->babId = $babId;
        $bab = Bab::with(['isiBab' => function($query) {
            $query->with('interactiveVideos');
        }])->find($this->babId);

        if (!$bab) {
            abort(404, 'Bab tidak ditemukan');
        }

        $this->judulBab = $bab->judul_bab;
        $this->deskripsiBab = $bab->deskripsi;

        if ($bab->isiBab) {
            $this->isiBab = $bab->isiBab;
            $this->teksBab = ['main' => $bab->isiBab->isi_materi ?? ''];
            $this->selectedVideos = $bab->isiBab->interactiveVideos ? 
                $bab->isiBab->interactiveVideos->pluck('id')->toArray() : [];
        } else {
            $this->isiBab = null;
            $this->teksBab = ['main' => ''];
            $this->selectedVideos = [];
        }
    }

    public function updated($propertyName)
    {
        $this->formChanged = true;
    }

    public function save()
    {
        $this->validate([
            'teksBab.main' => 'required|string',
        ]);

        if (!$this->isiBab) {
            $this->isiBab = IsiBab::create([
                'bab_id' => $this->babId,
                'isi_materi' => $this->teksBab['main'],
            ]);
        } else {
            $this->isiBab->update([
                'isi_materi' => $this->teksBab['main'],
            ]);
        }

        $this->isiBab->interactiveVideos()->sync($this->selectedVideos);

        ToastMagic::success('Materi berhasil disimpan', useSessionFlash: true);
        $this->formChanged = false;
        
        $this->redirectRoute('guru.materi', navigate: true);
    }

    public function cancel()
    {
        if ($this->formChanged) {
            $this->dispatchBrowserEvent('confirm-cancel', [
                'message' => 'Perubahan yang belum disimpan akan hilang. Apakah Anda yakin ingin membatalkan?'
            ]);
            return;
        }
        
        $this->redirectRoute('guru.materi', navigate: true);
    }

    public function forceCancel()
    {
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