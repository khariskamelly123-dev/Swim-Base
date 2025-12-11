<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     * Expects route action 'roles' to contain comma-separated allowed roles.
     */
    public function handle(Request $request, Closure $next)
    {
        // Get allowed roles from route action 'roles'
        $rolesValue = $request->route() ? $request->route()->getAction('roles') : null;

        if (!$rolesValue) {
            // If no roles defined, deny by default
            return abort(403, 'Access denied (no role specified)');
        }

        $allowed = array_map('trim', explode(',', (string) $rolesValue));

        // Determine current role(s) by checking available guards
        $currentRoles = [];

        // web guard (users table)
        if (Auth::guard('web')->check()) {
            $user = Auth::guard('web')->user();
            if (isset($user->role)) {
                $currentRoles[] = $user->role;
            }
        }

        // club guard
        if (method_exists(Auth::class, 'guard') && Auth::guard('club')->check()) {
            $currentRoles[] = 'klub';
        }

        // sekouniv guard
        if (method_exists(Auth::class, 'guard') && Auth::guard('sekouniv')->check()) {
            $currentRoles[] = 'sekolah';
        }

        // Fallback: session-based keys (backwards compatibility)
        if (session()->has('club_id')) {
            $currentRoles[] = 'klub';
        }

        if (session()->has('sekouniv_id')) {
            $currentRoles[] = 'sekolah';
        }

        // If no detected role, deny
        if (empty($currentRoles)) {
            return redirect('/')->withErrors(['auth' => 'Anda harus login untuk mengakses halaman ini.']);
        }

        // Check intersection
        foreach ($currentRoles as $r) {
            if (in_array($r, $allowed, true)) {
                return $next($request);
            }
        }

        return abort(403, 'Access denied');
    }
}
