<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
        api: __DIR__ . '/../routes/api.php',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->encryptCookies(except: ['token_guru', 'token_murid']);

        $middleware->alias([
            'auth.guru' => \App\Http\Middleware\AuthGuru::class,
            'auth.murid' => \App\Http\Middleware\AuthMurid::class,
            'tamu' => \App\Http\Middleware\Tamu::class,
        ]);

    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })

    ->create();
