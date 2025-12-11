<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Authenticated;
use App\Services\ActivityLogger;

class AuthenticatedListener
{
    public function handle(Authenticated $event)
    {
        ActivityLogger::log('authenticated', $event->user, []);
    }
}
