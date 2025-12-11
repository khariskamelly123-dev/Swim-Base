<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, ...$roles) // <--- Tambahkan ...$roles di sini
    {
        // 1. $roles otomatis berisi array dari web.php
        // Contoh: ['klub', 'sekolah', 'admin']
        $allowed = $roles; 

        if (empty($allowed)) {
            return abort(403, 'Access denied (no role specified in route)');
        }

        // --- Logika Cek User (Sama seperti sebelumnya) ---
        $currentRoles = [];

        // Cek Web Guard
        if (Auth::guard('web')->check()) {
            $user = Auth::guard('web')->user();
            if (isset($user->role)) {
                $currentRoles[] = $user->role;
            }
        }

        // Cek Club Guard
        if (method_exists(Auth::class, 'guard') && Auth::guard('club')->check()) {
            $currentRoles[] = 'klub';
        }

        // Cek Sekolah Guard
        if (method_exists(Auth::class, 'guard') && Auth::guard('sekouniv')->check()) {
            $currentRoles[] = 'sekolah';
        }

        // Fallback Session
        if (session()->has('club_id')) $currentRoles[] = 'klub';
        if (session()->has('sekouniv_id')) $currentRoles[] = 'sekolah';

        // Jika user belum login / tidak ada role terdeteksi
        if (empty($currentRoles)) {
            return redirect('/')->withErrors(['auth' => 'Anda harus login untuk mengakses halaman ini.']);
        }

        // Cek apakah salah satu role user ada di daftar allowed
        foreach ($currentRoles as $r) {
            if (in_array($r, $allowed)) {
                return $next($request);
            }
        }

        return abort(403, 'Access denied');
    }
}
