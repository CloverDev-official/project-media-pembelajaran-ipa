<?php

namespace App\Providers;

use App\Http\Middleware\AuthGuru;
use App\Http\Middleware\AuthMurid;
use App\Http\Middleware\Tamu;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Livewire::addPersistentMiddleware([
            AuthGuru::class, AuthMurid::class,
        ]);
        Route::aliasMiddleware('auth.guru', AuthGuru::class);
        Route::aliasMiddleware('auth.murid', AuthMurid::class);
        Route::aliasMiddleware('tamu', Tamu::class);
    }
}
