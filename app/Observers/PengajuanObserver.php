<?php

namespace App\Observers;

use App\Models\pengajuan;
use App\Services\ActivityLogger;

class PengajuanObserver
{
    public function created(pengajuan $pengajuan)
    {
        ActivityLogger::log('created_pengajuan', $pengajuan, ['data' => $pengajuan->toArray()]);
    }

    public function updated(pengajuan $pengajuan)
    {
        ActivityLogger::log('updated_pengajuan', $pengajuan, ['data' => $pengajuan->getChanges()]);
    }

    public function deleted(pengajuan $pengajuan)
    {
        ActivityLogger::log('deleted_pengajuan', $pengajuan, ['data' => $pengajuan->toArray()]);
    }
}
