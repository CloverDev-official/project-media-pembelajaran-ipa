<?php

namespace App\Livewire\Guru;

use App\Models\GimLevel;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class GimLevelManager extends Component
{
    use WithPagination, WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    // Hapus properti 'urutan'
    public $judul_level, $deskripsi, $aktif = false;
    public $pasangan = [['kiri' => '', 'kanan' => '']];
    public $editId = null;
    public $search = '';
    public $thumbnail;
    public $thumbnailPath;

    public function render()
    {
        $levels = GimLevel::where('judul_level', 'like', '%' . $this->search . '%')
                         ->orderBy('urutan')
                         ->paginate(10);

        return view('livewire.guru.gim-level-manager', [
            'levels' => $levels
        ])->layout('components.layouts.app-guru');
    }

    public function tambahPasangan()
    {
        $this->pasangan[] = ['kiri' => '', 'kanan' => ''];
    }

    public function hapusPasangan($index)
    {
        unset($this->pasangan[$index]);
        $this->pasangan = array_values($this->pasangan); // Re-index array
    }

    public function simpan()
    {
        $this->validate([
            'judul_level' => 'required|string|max:255',
            'pasangan' => 'required|array|min:1',
            'pasangan.*.kiri' => 'required|string|max:255',
            'pasangan.*.kanan' => 'required|string|max:255',
            'thumbnail' => 'nullable|image|max:2048', // 2MB Max
        ]);

        $thumbnailPath = $this->thumbnailPath;
        
        if ($this->thumbnail) {
            $thumbnailPath = $this->thumbnail->store('thumbnails', 'public');
        }

        if ($this->editId) {
            $level = GimLevel::findOrFail($this->editId);
            $level->update([
                'judul_level' => $this->judul_level,
                'deskripsi' => $this->deskripsi,
                'pasangan' => $this->pasangan,
                // Hapus 'urutan' dari update
                'aktif' => $this->aktif,
                'thumbnail' => $thumbnailPath,
            ]);
            session()->flash('message', 'Level berhasil diperbarui.');
        } else {
            GimLevel::create([
                'judul_level' => $this->judul_level,
                'deskripsi' => $this->deskripsi,
                'pasangan' => $this->pasangan,
                // Hapus 'urutan' dari create
                'aktif' => $this->aktif,
                'thumbnail' => $thumbnailPath,
            ]);
            session()->flash('message', 'Level berhasil ditambahkan.');
        }

        $this->resetInput();
    }

    public function edit($id)
    {
        $level = GimLevel::findOrFail($id);
        $this->editId = $level->id;
        $this->judul_level = $level->judul_level;
        $this->deskripsi = $level->deskripsi;
        $this->pasangan = $level->pasangan;
        // Hapus assignment untuk 'urutan'
        $this->aktif = $level->aktif;
        $this->thumbnailPath = $level->thumbnail;
        $this->thumbnail = null;
    }

    public function hapus($id)
    {
        GimLevel::destroy($id);
        session()->flash('message', 'Level berhasil dihapus.');
    }

    public function batal()
    {
        $this->resetInput();
    }

    private function resetInput()
    {
        // Hapus 'urutan' dari reset
        $this->reset(['judul_level', 'deskripsi', 'pasangan', 'aktif', 'editId', 'thumbnail', 'thumbnailPath']);
        $this->pasangan = [['kiri' => '', 'kanan' => '']];
    }
}