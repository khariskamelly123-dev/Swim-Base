<?php

namespace App\Observers;

use App\Models\Atlet;
use App\Services\ActivityLogger;

class AtletObserver
{
    public function created(Atlet $atlet)
    {
        ActivityLogger::log('created_atlet', $atlet, ['data' => $atlet->toArray()]);
    }

    public function updated(Atlet $atlet)
    {
        ActivityLogger::log('updated_atlet', $atlet, ['data' => $atlet->getChanges()]);
    }

    public function deleted(Atlet $atlet)
    {
        ActivityLogger::log('deleted_atlet', $atlet, ['data' => $atlet->toArray()]);
    }
}
