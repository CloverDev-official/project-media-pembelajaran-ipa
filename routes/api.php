<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\GuruAuthController;
use App\Http\Controllers\API\MuridAuthController;

Route::group(
    [
        'prefix' => 'auth/guru',
        'middleware' => 'api',
    ],
    function () {
        Route::post('login', [GuruAuthController::class, 'login'])->name('guru.auth.login');
        Route::post('logout', [GuruAuthController::class, 'logout'])->name('guru.auth.logout');
        Route::post('refresh', [GuruAuthController::class, 'refresh'])->name('guru.auth.refresh');
        Route::post('me', [GuruAuthController::class, 'me'])->name('guru.auth.me');
    },
);

Route::group(
    [
        'prefix' => 'auth/murid',
        'middleware' => 'api',
    ],
    function () {
        Route::post('login', [MuridAuthController::class, 'login'])->name('murid.auth.login');
        Route::post('logout', [MuridAuthController::class, 'logout'])->name('murid.auth.login');
        Route::post('refresh', [MuridAuthController::class, 'refresh'])->name('murid.auth.login');
        Route::post('me', [MuridAuthController::class, 'me'])->name('murid.auth.login');
    },
);
