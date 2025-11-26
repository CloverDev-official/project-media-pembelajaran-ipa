<?php

namespace App\Livewire\Components\Guru\Modal;

use App\Helpers\ValidateMagic;
use App\Models\IsiLatihan;
use App\Models\Latihan;
use Livewire\Component;

class ModalFormLatihan extends Component
{
    public $babId;
    public $waktuPengerjaan;
    public $jumlahSoal;
    public $latihan;
    public $showModal = false;

    protected $listeners = [
        'openFormLatihan' => 'open',
        'closeFormLatihan' => 'close',
    ];

    public function open($id)
    {
        $this->babId = $id;
        $this->loadData();
        $this->showModal = true;
    }

    public function close()
    {
        $this->showModal = false;
    }

    private function loadData()
    {
        $this->latihan = Latihan::where('bab_id', $this->babId)->first();

        if ($this->latihan) {
            $this->fill([
                'waktuPengerjaan' => $this->latihan->waktu_pengerjaan,
                'jumlahSoal' => $this->latihan->jumlah_soal,
            ]);
        }
    }

    public function save()
    {
        $validated = ValidateMagic::run(
            [
                'waktuPengerjaan' => 'required|integer|min:1',
                'jumlahSoal' => 'required|integer|min:1',
            ],
            [
                'waktuPengerjaan.required' => 'Waktu pengerjaan wajib diisi!',
                'waktuPengerjaan.integer' => 'Waktu pengerjaan harus berupa angka!',
                'waktuPengerjaan.min' => 'Waktu pengerjaan minimal 1 menit!',
                'jumlahSoal.required' => 'Jumlah soal wajib diisi!',
                'jumlahSoal.integer' => 'Jumlah soal harus berupa angka!',
                'jumlahSoal.min' => 'Jumlah soal minimal 1!',
            ],
            'error',
        );

        if (!$validated) {
            return;
        }

        if (IsiLatihan::where('latihan_id', $this->latihan->id)->doesntExist()) {
            $dataIsiLatihan = array_fill(0, $this->jumlahSoal, [
                'latihan_id' => $this->latihan->id,
            ]);

            IsiLatihan::insert($dataIsiLatihan);
        } else {
            if ($this->jumlahSoal > $this->latihan->jumlah_soal) {
                $jumlahTambah = $this->jumlahSoal - $this->latihan->jumlah_soal;

                $data = array_fill(0, $jumlahTambah, ['latihan_id' => $this->latihan->id]);
                IsiLatihan::insert($data);
            } else {
                $jumlahHapus = $this->latihan->jumlah_soal - $this->jumlahSoal;

                IsiLatihan::where('latihan_id', $this->latihan->id)
                    ->orderByDesc('id')
                    ->limit($jumlahHapus)
                    ->delete();
            }
        }

        $this->latihan->update([
            'waktu_pengerjaan' => $this->waktuPengerjaan,
            'jumlah_soal' => $this->jumlahSoal,
        ]);

        $this->reset(['waktuPengerjaan', 'jumlahSoal']);

        $this->redirectRoute('guru.form-isi-latihan', [$this->latihan->id], navigate: true);
    }

    public function render()
    {
        return view('livewire.components.guru.modal.modal-form-latihan');
    }
}
