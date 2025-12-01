<?php
use App\Livewire\Auth\LoginGuru;
use App\Livewire\Auth\LoginMurid;
use App\Livewire\Beranda;
use App\Livewire\DaftarUlangan;
use App\Livewire\Gim; // Ini untuk halaman daftar level gim murid
use App\Livewire\GimPencocokan; // Tambahkan komponen gim murid dari folder utama
use App\Livewire\Guru\Dashboard;
use App\Livewire\Guru\DataMurid;
use App\Livewire\Guru\FormIsiLatihan;
use App\Livewire\Guru\FormIsiMateri;
use App\Livewire\Guru\FormIsiUlangan;
use App\Livewire\Guru\Gim as GuruGim;
use App\Livewire\Guru\GimLevelManager;
use App\Livewire\IsiMateri;
use App\Livewire\Guru\Materi as GuruMateri;
use App\Livewire\Guru\RekapNilai;
use App\Livewire\Guru\Ulangan as GuruUlangan;
use App\Livewire\Materi;
use App\Livewire\Profil;
use App\Livewire\Ulangan;
use Illuminate\Support\Facades\Route;
use App\Livewire\Guru\InteractiveVideoManager;
use App\Livewire\Guru\InteractiveQuestionManager;

Route::middleware('auth.murid')->group(function () {
    Route::get('/', Beranda::class)->name('beranda');
    Route::get('/materi', Materi::class)->name('materi');
    Route::get('/gim', Gim::class)->name('gim');
    Route::get('/gim/main/{levelId}', GimPencocokan::class)->name('gim.main'); // Route untuk memainkan level
    Route::get('/profil', Profil::class)->name('profil');
    Route::get('/daftar-ulangan', DaftarUlangan::class)->name('daftar-ulangan');
    Route::get('/ulangan/{ulanganId}', Ulangan::class)->name('ulangan');
    Route::get('/bab/{babId}', IsiMateri::class)->name('isi.materi');
});

Route::middleware('auth.guru')
    ->prefix('guru')
    ->name('guru.')
    ->group(function () {
        Route::get('/dashboard', Dashboard::class)->name('dashboard');
        Route::get('/data-murid', DataMurid::class)->name('data-murid');
        Route::get('/rekap-nilai', RekapNilai::class)->name('rekap-nilai');
        Route::get('/materi', GuruMateri::class)->name('materi');
        Route::get('/ulangan', GuruUlangan::class)->name('ulangan');
        Route::get('/gim', GimLevelManager::class)->name('gim');
        Route::get('/ulangan/{babId}', IsiMateri::class)->name('isi.ulangan');
        Route::get('/form/bab/{babId}', FormIsiMateri::class)->name('form-isi-materi');
        Route::get('/form/ulangan/{ulanganId}', FormIsiUlangan::class)->name('form-isi-ulangan');
        Route::get('/form/latihan/{latihanId}', FormIsiLatihan::class)->name('form-isi-latihan');
        Route::get('/interactive-video', InteractiveVideoManager::class)->name('video-interaktif');
        Route::get('/interactive-question/{video}', InteractiveQuestionManager::class)->name(
            'edit-pertanyaan-video-interaktif',
        );
    });

route::middleware('tamu')
    ->name('auth.')
    ->group(function () {
        Route::get('/login-guru', LoginGuru::class)->name('login-guru');
        Route::get('/login-murid', LoginMurid::class)->name('login-murid');
    });