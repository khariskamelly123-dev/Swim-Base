<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use App\Services\ActivityLogger;

class LoginListener
{
    public function handle(Login $event)
    {
        // $event->user is the authenticated user
        ActivityLogger::log('login', $event->user, []);
    }
}
