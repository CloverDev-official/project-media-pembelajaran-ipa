<?php

namespace App\Livewire\Components\Guru\Modal;

use App\Helpers\ValidateMagic;
use App\Models\IsiUlangan;
use App\Models\Kelas;
use App\Models\Ulangan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class ModalEditUlangan extends Component
{
    use WithFileUploads;

    public $showModal = false;
    public $daftarKelas;
    public $ulanganId;
    public $ulangan;

    // Properti form
    public $judul;
    public $deskripsi;
    public $gambar;
    public $waktuPengerjaan;
    public $kelasId;
    public $jumlahSoal;
    public $waktuDibuka;
    public $waktuDitutup;

    protected $listeners = [
        'openEditUlangan' => 'open',
        'closeEditUlangan' => 'close',
    ];

    public function mount()
    {
        $this->daftarKelas = Kelas::select('id', 'nama_kelas')->get();
    }

    public function open($id)
    {
        $this->ulanganId = $id;
        $this->loadData();
        $this->showModal = true;
    }

    public function close()
    {
        $this->reset([
            'judul',
            'deskripsi',
            'gambar',
            'waktuPengerjaan',
            'kelasId',
            'jumlahSoal',
            'waktuDibuka',
            'waktuDitutup',
        ]);
        $this->showModal = false;
    }

    private function loadData()
    {
        $this->ulangan = Ulangan::find($this->ulanganId);

        if ($this->ulangan) {
            $this->fill([
                'judul' => $this->ulangan->judul,
                'deskripsi' => $this->ulangan->deskripsi,
                'gambar' => null,
                'waktuPengerjaan' => $this->ulangan->waktu_pengerjaan,
                'kelasId' => $this->ulangan->kelas_id,
                'jumlahSoal' => $this->ulangan->jumlah_soal,
                'waktuDibuka' => $this->ulangan->waktu_dibuka,
                'waktuDitutup' => $this->ulangan->waktu_ditutup,
            ]);
        }
    }

    public function update()
    {
        $validated = ValidateMagic::run(
            [
                'judul' => 'required|string|max:255',
                'deskripsi' => 'nullable|string',
                'gambar' => 'nullable|sometimes|image|max:5120',
                'waktuPengerjaan' => 'required|integer|min:1',
                'kelasId' => 'required|exists:kelas,id',
                'jumlahSoal' => 'required|integer|min:1',
                'waktuDibuka' => 'required|date',
                'waktuDitutup' => 'required|date|after:waktuDibuka',
            ],
            [
                'judul.required' => 'Judul wajib diisi!',
                'judul.max' => 'Judul tidak boleh lebih dari 255 karakter!',
                'gambar.image' => 'Gambar harus berupa file gambar!',
                'gambar.max' => 'Gambar tidak boleh lebih dari 5MB!',
                'waktuPengerjaan.required' => 'Waktu pengerjaan wajib diisi!',
                'waktuPengerjaan.integer' => 'Waktu pengerjaan harus berupa angka!',
                'waktuPengerjaan.min' => 'Waktu pengerjaan minimal 1 menit!',
                'kelasId.required' => 'Kelas wajib dipilih!',
                'kelasId.exists' => 'Kelas tidak valid!',
                'jumlahSoal.required' => 'Jumlah soal wajib diisi!',
                'jumlahSoal.integer' => 'Jumlah soal harus berupa angka!',
                'jumlahSoal.min' => 'Jumlah soal minimal 1!',
                'waktuDibuka.required' => 'Waktu dibuka wajib diisi!',
                'waktuDibuka.date' => 'Waktu dibuka tidak valid!',
                'waktuDitutup.required' => 'Waktu ditutup wajib diisi!',
                'waktuDitutup.date' => 'Waktu ditutup tidak valid!',
                'waktuDitutup.after' => 'Waktu ditutup harus setelah waktu dibuka!',
            ],
            'error',
        );

        if (!$validated) {
            return;
        }

        if ($this->jumlahSoal > $this->ulangan->jumlah_soal) {
            $jumlahTambah = $this->jumlahSoal - $this->ulangan->jumlah_soal;

            $data = array_fill(0, $jumlahTambah, ['ulangan_id' => $this->ulangan->id]);
            IsiUlangan::insert($data);
        } else {
            $jumlahHapus = $this->ulangan->jumlah_soal - $this->jumlahSoal;

            IsiUlangan::where('ulangan_id', $this->ulangan->id)
                ->orderByDesc('id')
                ->limit($jumlahHapus)
                ->delete();
        }

        $gambarPath = $this->ulangan->gambar;
        if ($this->gambar instanceof TemporaryUploadedFile) {
            Storage::disk('public')->delete($this->ulangan->gambar);

            $uniq = uniqid();
            $ext = $this->gambar->extension();
            $judulFolder = Str::slug($this->judul, '_');
            $gambarPath = $this->gambar->storeAs(
                "gambar_ulangan/{$judulFolder}",
                "sampul-{$uniq}.{$ext}",
                'public',
            );
        }

        $this->ulangan->update([
            'judul' => $this->judul,
            'deskripsi' => $this->deskripsi,
            'gambar' => $gambarPath,
            'waktu_pengerjaan' => $this->waktuPengerjaan,
            'kelas_id' => $this->kelasId,
            'jumlah_soal' => $this->jumlahSoal,
            'waktu_dibuka' => $this->waktuDibuka,
            'waktu_ditutup' => $this->waktuDitutup,
        ]);

        $this->close();

        $this->redirectRoute('guru.form-isi-ulangan', [$this->ulangan->id], navigate: true);
    }

    public function render()
    {
        return view('livewire.components.guru.modal.modal-edit-ulangan');
    }
}
