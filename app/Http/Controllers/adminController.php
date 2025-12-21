<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin; // Gunakan Model Admin (bukan User)
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Tampilkan Halaman Login Admin
     * Route: admin.login
     */
    public function showLoginForm()
    {
        return view('auth.admin.login'); // Pastikan file view sudah direname
    }

    /**
     * Proses Login Admin
     * Route: admin.login.process
     */
    public function loginProcess(Request $request)
    {
        // 1. Validasi
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        // 2. Coba Login pakai Guard 'admin'
        // Ini akan mengecek ke tabel 'admins'
        if (Auth::guard('admin')->attempt($credentials)) {
            
            $request->session()->regenerate();

            // Redirect ke Dashboard Admin
            return redirect()->route('admin.dashboard')
                             ->with('success', 'Welcome back, Admin!');
        }

        // 3. Gagal Login
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    /**
     * Tampilkan Halaman Register Admin
     * Route: regis_admin (Sebaiknya admin.register)
     * Catatan: Biasanya registrasi admin tidak dibuka untuk umum.
     */
    public function showRegisterForm()
    {
        return view('auth.admin.register');
    }

    /**
     * Proses Register Admin Baru
     * Route: admin.register.process
     */
    public function registerProcess(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255', // Dulu: nama_admin
            'email'    => 'required|email|unique:admins,email', // Cek unique di tabel admins
            'password' => 'required|string|min:6|confirmed',
            // 'type'  => 'required' (Opsional: jika tabel admins punya kolom 'type' atau 'jenis_admin')
        ]);

        // Simpan ke Tabel Admins
        Admin::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('admin.login')
                         ->with('success', 'Admin registration successful. Please login.');
    }

    /**
     * Logout Admin
     */
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}