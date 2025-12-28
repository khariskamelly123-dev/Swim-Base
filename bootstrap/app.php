<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request; 
use App\Http\Middleware\CheckRole; 

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        
        // 1. Alias Middleware Custom
        $middleware->alias([
            'role' => CheckRole::class,
        ]);

        // 2. LOGIKA REDIRECT DINAMIS (Penting untuk Multi-Auth)
        // Jika user belum login mencoba akses halaman tertentu, Laravel akan melempar ke pintu yang tepat
        $middleware->redirectGuestsTo(function (Request $request) {
            
            // Jika akses dashboard super admin
            if ($request->is('super-admin/*')) {
                return route('super.login');
            }

            // Jika akses dashboard admin
            if ($request->is('admin/*')) {
                return route('admin.login');
            }

            // Jika akses portal klub atau data atlet privat
            if ($request->is('club/*')) {
                return route('club.login');
            }
            
            // Jika akses portal institusi (Sekolah/Univ)
            // UPDATED: Dari schuniv ke institution
            if ($request->is('institution/*')) {
                return route('institution.login');
            }
            
            // Default: Dilempar ke halaman pilihan login utama
            // UPDATED: Menggunakan route login yang baru kita buat
            return route('login'); 
        });

    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();