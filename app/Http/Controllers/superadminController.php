<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuperAdminController extends Controller
{
    /**
     * Tampilkan Halaman Login Super Admin
     * Route: superadmin.login
     */
    public function showLoginForm()
    {
        // Pastikan view sudah direname jadi 'login.blade.php' 
        // di dalam folder resources/views/auth/superadmin/
        return view('auth.superadmin.login');
    }

    /**
     * Proses Login
     * Route: superadmin.login.process
     */
    public function loginProcess(Request $request)
    {
        // 1. Validasi Input
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        // 2. Coba Login pakai Guard 'superadmin'
        // Ini akan mengecek kredensial ke tabel 'superadmins'
        if (Auth::guard('super_admin')->attempt($credentials)) {
            
            $request->session()->regenerate();

            // Redirect ke Dashboard Super Admin
            return redirect()->route('super.dashboard')
                             ->with('success', 'Welcome, Super Admin!');
        }

        // 3. Gagal Login
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    /**
     * Logout Super Admin
     */
    public function logout(Request $request)
    {
        Auth::guard('superadmin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('superadmin.login');
    }
}