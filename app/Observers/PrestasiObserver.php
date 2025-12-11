<?php

namespace App\Observers;

use App\Models\Prestasi;
use App\Services\ActivityLogger;

class PrestasiObserver
{
    public function created(Prestasi $prestasi)
    {
        ActivityLogger::log('created_prestasi', $prestasi, ['data' => $prestasi->toArray()]);
    }

    public function updated(Prestasi $prestasi)
    {
        ActivityLogger::log('updated_prestasi', $prestasi, ['data' => $prestasi->getChanges()]);
    }

    public function deleted(Prestasi $prestasi)
    {
        ActivityLogger::log('deleted_prestasi', $prestasi, ['data' => $prestasi->toArray()]);
    }
}
