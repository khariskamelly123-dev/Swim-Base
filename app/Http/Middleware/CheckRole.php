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
    public function handle(Request $request, Closure $next, $roles = null)
    {
        // Roles may be passed as middleware parameter (e.g. ->middleware('role:admin'))
        // or as a route default action 'roles'. Prefer middleware param if provided.
        $rolesValue = $roles ?: ($request->route() ? $request->route()->getAction('roles') : null);

        // If no roles defined, allow any authenticated user (backwards-compatible)
        if (!$rolesValue) {
            // Allow if any known guard is authenticated or session indicates club/sekolah
            if (Auth::guard('web')->check() || (method_exists(Auth::class, 'guard') && Auth::guard('club')->check()) || (method_exists(Auth::class, 'guard') && Auth::guard('sekouniv')->check()) || session()->has('club_id') || session()->has('sekouniv_id')) {
                return $next($request);
            }

            // Not authenticated — redirect to login
            return redirect('/')->withErrors(['auth' => 'Anda harus login untuk mengakses halaman ini.']);
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
            $currentRoles[] = 'club';
        }

        // sekouniv guard
        if (method_exists(Auth::class, 'guard') && Auth::guard('sekouniv')->check()) {
            $currentRoles[] = 'sekolah';
        }

        // Fallback: session-based keys (backwards compatibility)
        if (session()->has('club_id')) {
            $currentRoles[] = 'club';
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
