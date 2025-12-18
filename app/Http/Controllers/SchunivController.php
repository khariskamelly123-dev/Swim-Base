<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\sekouniv;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class SchunivController extends Controller
{
    // 1. Tampilkan Form Login (Mirip method club())
    public function schuniv()
    {
        return view('auth.schuniv.schuniv_login');
    }

    // 2. Tampilkan Form Register (Mirip method regis_club())
    public function regis_schuniv()
    {
        return view('auth.schuniv.regis_schuniv');
    }

    // 3. Proses Register (Mirip method club_register())
    public function schuniv_register(Request $request)
    {
        $validated = $request->validate([
            'nama_sekolah_universitas'   => 'required|string|max:255',
            'alamat_sekolah_universitas' => 'required|string',
            'kontak_seko_univ'           => 'required|string|max:20',
            'email_resmi_seko_univ'      => 'required|email|unique:seko_univ_data,email_resmi_seko_univ',
            'password'                   => 'required|string|min:6',
        ]);

        // Simpan data
        sekouniv::create([
            'nama_sekolah_universitas'   => $validated['nama_sekolah_universitas'],
            'alamat_sekolah_universitas' => $validated['alamat_sekolah_universitas'],
            'kontak_seko_univ'           => $validated['kontak_seko_univ'],
            'email_resmi_seko_univ'      => $validated['email_resmi_seko_univ'],
            'password'                   => Hash::make($validated['password']),
        ]);

        // Redirect ke halaman login sekolah
        // Pastikan nama route-nya nanti 'schuniv.login'
        return redirect()->route('schuniv.login')->with('success', 'Registrasi berhasil. Silakan login.');
    }

    // 4. Proses Login (Mirip method club_login_process())
    public function schuniv_login_process(Request $request)
    {
        $validated = $request->validate([
            'email_resmi_seko_univ' => 'required|email',
            'password'              => 'required|string',
        ]);

        $credentials = [
            'email_resmi_seko_univ' => $validated['email_resmi_seko_univ'],
            'password'              => $validated['password'],
        ];

        // KUNCI: Gunakan guard 'sekouniv'
        if (!Auth::guard('sekouniv')->attempt($credentials)) {
            return back()->withErrors([
                'email_resmi_seko_univ' => 'Email atau password salah.',
            ])->onlyInput('email_resmi_seko_univ');
        }

        // Login sukses, simpan session tambahan jika perlu
        $sekouniv = Auth::guard('sekouniv')->user();
        session(['sekouniv_id' => $sekouniv->id, 'sekouniv_name' => $sekouniv->nama_sekolah_universitas]);

        return redirect()->route('dashboard_schuniv')->with('success', 'Login berhasil');
    }

    // 5. Proses Logout (Mirip method club_logout())
    public function schuniv_logout(Request $request)
    {
        Auth::guard('sekouniv')->logout();
        
        session()->forget(['sekouniv_id', 'sekouniv_name']);
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('schuniv.login')->with('success', 'Logout berhasil');
    }

    // Method tambahan (bisa ditaruh di HomeController jika mau dipisah total)
    public function welcome_selection()
    {
        return view('welcome');
    }
}