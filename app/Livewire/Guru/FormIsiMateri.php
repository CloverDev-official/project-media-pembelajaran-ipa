<?php

namespace App\Livewire\Guru;

use App\Helpers\ToastMagic;
use App\Models\Bab;
use Livewire\Component;

class FormIsiMateri extends Component
{
    public $babId;
    public $judulBab;
    public $isiBab;
    public $subBab;
    public $teksBab;
    public $editorId = 'teksBab';

    public function mount()
    {
        $bab = Bab::with('isiBab')->find($this->babId);

        if (!$bab) {
            abort(404, 'Bab tidak ditemukan');
        }

        $this->judulBab = $bab->judul_bab;

        $isiBab = $bab->isiBab;
        $this->isiBab = $isiBab;
        $this->subBab = $isiBab->sub_bab;
        $this->teksBab = ['main' => $isiBab->isi_materi ?? ''];
    }

    public function save()
    {
        if ($this->isiBab) {
            $this->isiBab->update([
                'judul_sub_bab' => $this->subBab,
                'isi_materi' => $this->teksBab['main'],
            ]);

            $this->reset(['subBab', 'teksBab']);

            ToastMagic::success('Materi berhasil disimpan', useSessionFlash: true);
        }

        $this->redirectRoute('guru.materi', navigate: true);
    }

    public function render()
    {
        return view('livewire.guru.form-isi-materi')->layout('components.layouts.app-guru');
    }
}
