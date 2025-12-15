<?php

namespace App\Services;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

class ActivityLogger
{
    public static function log(string $action, $subject = null, array $meta = []) : ActivityLog
    {
        // Variabel untuk kolom database 'user_id' (Default NULL agar aman)
        $dbUserId = null; 
        $actorType = null;
        
        // Kita simpan ID asli penguna (baik itu club id, sekolah id, atau user id) 
        // untuk keperluan meta atau jika nanti Anda menambahkan kolom 'actor_id'
        $currentActorId = null; 

        // try to determine actor type from guards
        try {
            if (Auth::guard('club')->check()) {
                $actorType = 'club';
                $currentActorId = Auth::guard('club')->id();
                // $dbUserId tetap NULL, karena Club bukan User

            } elseif (Auth::guard('sekouniv')->check()) {
                $actorType = 'sekolah';
                $currentActorId = Auth::guard('sekouniv')->id();
                // $dbUserId tetap NULL, karena Sekolah bukan User

            } elseif (Auth::guard('web')->check()) {
                $actorType = 'user';
                $currentActorId = Auth::guard('web')->id();
                // HANYA isi $dbUserId jika yang login adalah User (guard web)
                $dbUserId = $currentActorId; 
            }
        } catch (\Exception $e) {
            // ignore
        }

        // Jika user_id null (misal Club yang login), kita simpan ID aslinya di dalam array meta
        // agar kita tetap tahu Club ID berapa yang melakukan aksi.
        if (is_null($dbUserId) && $currentActorId) {
            $meta['actor_id'] = $currentActorId;
        }

        $subjectType = null;
        $subjectId = null;
        if ($subject) {
            if (is_object($subject)) {
                $subjectType = get_class($subject);
                $subjectId = $subject->getKey();
            } elseif (is_array($subject)) {
                $subjectType = $subject['type'] ?? null;
                $subjectId = $subject['id'] ?? null;
            }
        }

        $request = request();

        $log = ActivityLog::create([
            'user_id'      => $dbUserId, // Ini sekarang aman (bisa NULL)
            'actor_type'   => $actorType,
            'action'       => $action,
            'subject_type' => $subjectType,
            'subject_id'   => $subjectId,
            'ip_address'   => $request->ip(),
            'user_agent'   => $request->header('User-Agent'),
            'meta'         => $meta,
        ]);

        return $log;
    }
}