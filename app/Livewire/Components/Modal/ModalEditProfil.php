<?php

namespace App\Livewire\Components\Modal;

use App\Helpers\ToastMagic;
use App\Helpers\ValidateMagic;
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
        SMPN11Murid::find($murid->id)->update([
            'gambar' => null,
        ]);
        Storage::disk('public')->delete($murid->gambar);
        $this->toggle();
        return redirect()->route('profil');
    }

    public function updatedGambar()
    {
        $validate = ValidateMagic::run(
            [
                'gambar' => 'nullable|image|max:5120', // 5MB
            ],
            [
                'gambar.max' => 'Ukuran gambar maksimal adalah 5MB.',
                'gambar.image' => 'File yang diunggah harus berupa gambar.',
            ]
        );

        if (!$validate && $this->gambar instanceof TemporaryUploadedFile){
            $this->gambar->delete();
            $this->reset('gambar');
        }
    }

    public function uploadGambar()
    {
        $validate = ValidateMagic::run(
            [
                'gambar' => 'nullable|image|max:5120', // 5MB
            ],
            [
                'gambar.max' => 'Ukuran gambar maksimal adalah 5MB.',
                'gambar.image' => 'File yang diunggah harus berupa gambar.',
            ]
        );

        if (!$validate){
            return;
        }

        $murid = auth('murid')->user();
        $gambarPath = $murid->gambar;
        if ($this->gambar instanceof TemporaryUploadedFile) {
            if ($murid->gambar) {
                Storage::disk('public')->delete($gambarPath);
            }
            
            $uniq = uniqid();
            $ext = $this->gambar->extension();
            $judulFile = Str::slug($murid->nama, '-');
            $gambarPath = $this->gambar->storeAs(
                "gambar_profil",
                "{$murid->nipd}-{$judulFile}-{$uniq}.{$ext}",
                'public',
            );
        }
        
        SMPN11Murid::find($murid->id)->update([
            'gambar' => $gambarPath,
        ]);
        
        $this->toggle();
        return redirect()->route('profil');
    }

    public function render()
    {
        return view('livewire.components.modal.modal-edit-profil');
    }
}
