<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request; // <--- JANGAN LUPA IMPORT INI
use App\Http\Middleware\CheckRole; 

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        
        // 1. Alias Middleware Custom Kamu
        $middleware->alias([
            'role' => CheckRole::class,
        ]);

        // 2. LOGIKA REDIRECT (Ini Solusi Error Route Not Defined)
        // Kode ini memberi tahu Laravel: "Kalau belum login, lempar ke sini..."
        $middleware->redirectGuestsTo(function (Request $request) {
            
            // Jika user mencoba akses halaman klub atau atlet
            if ($request->is('club/*') || $request->is('atlet*')) {
                return route('club.login');
            }
            
            // Jika user mencoba akses halaman sekolah
            if ($request->is('schuniv/*')) {
                return route('schuniv.login');
            }
            
            // Default (jika bukan keduanya) lempar ke halaman welcome
            return route('welcome');
        });

    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();