<?php

namespace App\Services;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

class ActivityLogger
{
    public static function log(string $action, $subject = null, array $meta = []) : ActivityLog
    {
        $userId = Auth::id();
        $actorType = null;

        // try to determine actor type from guards
        try {
            if (Auth::guard('club')->check()) {
                $actorType = 'club';
                $userId = Auth::guard('club')->id();
            } elseif (Auth::guard('sekouniv')->check()) {
                $actorType = 'sekolah';
                $userId = Auth::guard('sekouniv')->id();
            } elseif (Auth::guard('web')->check()) {
                $actorType = 'user';
                $userId = Auth::guard('web')->id();
            }
        } catch (\Exception $e) {
            // ignore
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
            'user_id' => $userId,
            'actor_type' => $actorType,
            'action' => $action,
            'subject_type' => $subjectType,
            'subject_id' => $subjectId,
            'ip_address' => $request->ip(),
            'user_agent' => $request->header('User-Agent'),
            'meta' => $meta,
        ]);

        return $log;
    }
}
