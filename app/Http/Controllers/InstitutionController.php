<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Institution; // Model Baru
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class InstitutionController extends Controller
{
    /**
     * Tampilkan Form Login Sekolah/Univ
     * Route: institution.login
     */
    public function showLoginForm()
    {
        // Pastikan folder view sudah di-rename jadi 'institution'
        return view('auth.institution.login'); 
    }

    /**
     * Proses Login
     * Route: institution.login.process
     */
    public function loginProcess(Request $request)
    {
        // 1. Validasi
        $credentials = $request->validate([
            'email'    => 'required|email',   // Dulu: email_resmi_seko_univ
            'password' => 'required|string',
        ]);

        // 2. Attempt Login menggunakan Guard 'institution'
        // PENTING: Pastikan kamu sudah update config/auth.php (lihat catatan di bawah)
        if (Auth::guard('institution')->attempt($credentials)) {
            
            $request->session()->regenerate();

            return redirect()->route('institution.dashboard')
                             ->with('success', 'Login successful (Login Berhasil).');
        }

        // 3. Jika Gagal
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    /**
     * Tampilkan Form Register
     * Route: institution.register
     */
    public function showRegisterForm()
    {
        return view('auth.institution.register');
    }

    /**
     * Proses Register Baru
     * Route: institution.register.process
     */
    public function registerProcess(Request $request)
    {
        // 1. Validasi
        $validated = $request->validate([
            'name'     => 'required|string|max:255', // Dulu: nama_sekolah_universitas
            'type'     => 'required|in:school,university',
            'address'  => 'required|string',         // Dulu: alamat_sekolah_universitas
            'phone'    => 'required|string|max:20',  // Dulu: kontak_seko_univ
            
            // Cek unique di tabel 'institutions'
            'email'    => 'required|email|unique:institutions,email', 
            
            'password' => 'required|string|min:6|confirmed', // Gunakan 'confirmed' untuk validasi password_confirmation
        ]);

        // 2. Simpan ke Database
        Institution::create([
            'name'     => $validated['name'],
            'type'     => $validated['type'],
            'address'  => $validated['address'],
            'phone'    => $validated['phone'],
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        // 3. Redirect ke Login
        return redirect()->route('institution.login')
                         ->with('success', 'Registration successful. Please login.');
    }

    /**
     * Proses Logout
     * Route: logout (via Post di dalam group institution)
     */
    public function logout(Request $request)
    {
        Auth::guard('institution')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('institution.login')
                         ->with('success', 'You have been logged out.');
    }
}