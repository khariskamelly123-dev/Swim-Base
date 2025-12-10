<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Logout;
use App\Services\ActivityLogger;

class LogoutListener
{
    public function handle(Logout $event)
    {
        ActivityLogger::log('logout', $event->user, []);
    }
}
