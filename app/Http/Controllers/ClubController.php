<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Club;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ClubController extends Controller
{
    /**
     * Menampilkan Form Login Club
     * Route: club.login
     */
    public function showLoginForm()
    {
        return view('auth.club.login');
    }

    /**
     * Proses Login Club
     * Route: club.login.process
     */
    public function loginProcess(Request $request)
    {
        // 1. Validasi Input (Pastikan di form HTML name="email" dan name="password")
        $credentials = $request->validate([
            'email'    => 'required|email', // Dulu: email_resmi
            'password' => 'required|string',
        ]);

        // 2. Coba Login menggunakan Guard 'club'
        // Laravel otomatis mencocokkan field 'email' & 'password' ke database
        if (Auth::guard('club')->attempt($credentials)) {
            
            // Regenerate session untuk keamanan
            $request->session()->regenerate();

            // Simpan info tambahan ke session jika perlu (Opsional)
            // Sekarang pakai kolom 'name', bukan 'nama_klub'
            $club = Auth::guard('club')->user();
            // session(['club_name' => $club->name]); 

            return redirect()->route('dashboard.club')->with('success', 'Login successful! Welcome back.');
        }

        // 3. Jika Gagal
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    /**
     * Menampilkan Form Register Club
     * Route: club.register
     */
    public function showRegisterForm()
    {
        return view('auth.club.register');
    }

    /**
     * Proses Register Club Baru
     * Route: club.register.process
     */
    public function registerProcess(Request $request)
    {
        // 1. Validasi Input (Sesuaikan dengan name di form HTML baru)
        $validated = $request->validate([
            'name'     => 'required|string|max:255', // Dulu: nama_klub
            'address'  => 'required|string',         // Dulu: alamat_detail
            'province' => 'required|string',         // Dulu: provinsi_nama
            'city'     => 'required|string',         // Dulu: kota
            'phone'    => 'required|string|max:20',  // Dulu: kontak_club
            'email'    => 'required|email|unique:clubs,email', // Dulu: email_resmi
            'password' => 'required|string|min:6|confirmed', // Tambahkan 'confirmed' jika ada field password_confirmation
        ]);

        // 2. Simpan ke Database menggunakan Model Club Baru
        Club::create([
            'name'     => $validated['name'],
            'address'  => $validated['address'],
            'province' => $validated['province'],
            'city'     => $validated['city'],
            'phone'    => $validated['phone'],
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        // 3. Redirect ke halaman Login
        return redirect()->route('club.login')->with('success', 'Registration successful. Please login.');
    }

    /**
     * Menampilkan Profil Club
     * Route: club.profile
     */
    public function profile()
    {
        // Ambil data user yang sedang login
        $club = Auth::guard('club')->user();
        return view('club.profile', compact('club'));
    }

    /**
     * Proses Logout
     * Route: logout (Post)
     */
    public function logout(Request $request)
    {
        Auth::guard('club')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('club.login')->with('success', 'You have been logged out.');
    }
}