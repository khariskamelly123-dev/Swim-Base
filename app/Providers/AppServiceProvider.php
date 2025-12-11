<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;

use App\Models\Atlet;
use App\Models\pengajuan;
use App\Models\Prestasi;
use App\Observers\AtletObserver;
use App\Observers\PengajuanObserver;
use App\Observers\PrestasiObserver;

use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Auth\Events\Authenticated;
use App\Listeners\LoginListener;
use App\Listeners\LogoutListener;
use App\Listeners\AuthenticatedListener;

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
        // Register model observers
        if (class_exists(Atlet::class) && class_exists(AtletObserver::class)) {
            Atlet::observe(AtletObserver::class);
        }

        if (class_exists(pengajuan::class) && class_exists(PengajuanObserver::class)) {
            pengajuan::observe(PengajuanObserver::class);
        }

        if (class_exists(Prestasi::class) && class_exists(PrestasiObserver::class)) {
            Prestasi::observe(PrestasiObserver::class);
        }

        // Register auth event listeners
        Event::listen(Login::class, [LoginListener::class, 'handle']);
        Event::listen(Logout::class, [LogoutListener::class, 'handle']);
        Event::listen(Authenticated::class, [AuthenticatedListener::class, 'handle']);
    }
}
