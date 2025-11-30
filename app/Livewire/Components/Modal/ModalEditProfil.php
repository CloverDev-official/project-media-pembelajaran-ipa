<?php

namespace App\Livewire\Components\Modal;

use App\Helpers\ToastMagic;
use App\Models\SMPN11Murid;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class ModalEditProfil extends Component
{
    use WithFileUploads;

    public $showModal = false;
    public $gambar;

    protected $listeners = ['toggleEditProfilPopup' => 'toggle'];

    public function toggle()
    {
        $this->showModal = !$this->showModal;
    }

    public function hapusGambar()
    {
        $murid = auth('murid')->user();
        Storage::disk('public')->delete($murid->gambar);
    }

    public function uploadGambar()
    {
        $murid = auth('murid')->user();
        $gambarPath = $murid->gambar;
        if ($this->gambar instanceof TemporaryUploadedFile) {
            if ($murid->gambar) {
                Storage::disk('public')->delete($gambarPath);
            }

            $ext = $this->gambar->extension();
            $judulFile = Str::slug($murid->nama, '-');
            $gambarPath = $this->gambar->storeAs(
                "gambar_profil",
                "{$murid->nipd}-{$judulFile}.{$ext}",
                'public',
            );
        }
        
        SMPN11Murid::find($murid->id)->update([
            'gambar' => $gambarPath,
        ]);

        ToastMagic::success('Berhasil memperbarui foto profil!');
        $this->toggle();
        $this->dispatch('refreshFotoProfil');
    }

    public function render()
    {
        return view('livewire.components.modal.modal-edit-profil');
    }
}
