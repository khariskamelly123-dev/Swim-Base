<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\sekouniv;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function seko_univ()
    {
        return view('auth.schuniv.schuniv_login');
    }

    public function regis_seko_univ()
    {
        return view('auth.schuniv.regis_schuniv');
    }

    public function sekouniv_register(Request $request)
    {
        $validated = $request->validate([
            'nama_sekolah_universitas' => 'required|string|max:255',
            'alamat_sekolah_universitas' => 'required|string',
            'kontak_seko_univ' => 'required|string|max:20',
            'email_resmi_seko_univ' => 'required|email|unique:seko_univ_data,email_resmi_seko_univ',
            'password' => 'required|string|min:6',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        sekouniv::create($validated);

        return Redirect()->route('login')->with('success', 'Registrasi sekolah berhasil. Silakan login.');
    }

    public function sekouniv_login_process(Request $request)
    {
        $validated = $request->validate([
            'email_resmi_seko_univ' => 'required|email',
            'password' => 'required|string',
        ]);

        $credentials = [
            'email_resmi_seko_univ' => $validated['email_resmi_seko_univ'],
            'password' => $validated['password'],
        ];

        if (!Auth::guard('sekouniv')->attempt($credentials)) {
            return back()->withErrors([
                'email_resmi_seko_univ' => 'Email atau password salah.',
            ])->onlyInput('email_resmi_seko_univ');
        }

        $sekouniv = Auth::guard('sekouniv')->user();
        session(['sekouniv_id' => $sekouniv->id, 'sekouniv_name' => $sekouniv->nama_sekolah_universitas]);

        return redirect()->route('dashboard_afterlogin')->with('success', 'Login berhasil');
    }

    public function sekouniv_logout()
    {
        Auth::guard('sekouniv')->logout();
        session()->forget(['sekouniv_id', 'sekouniv_name']);
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route('login')->with('success', 'Logout berhasil');
    }

    public function logout(Request $request)
    {
        // Remove any custom session keys used for non-Auth logins
        session()->forget(['sekouniv_id', 'sekouniv_name', 'club_id', 'club_name']);

        // Logout from all guards: sekouniv, club, and default web
        try {
            Auth::guard('sekouniv')->logout();
        } catch (\Exception $e) {
            // ignore if guard not configured
        }

        try {
            Auth::guard('club')->logout();
        } catch (\Exception $e) {
            // ignore if guard not configured
        }

        // Default logout
        Auth::logout();

        // Invalidate session and regenerate CSRF token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Logout berhasil');
    }

    public function welcome_selection()
    {
        return view('welcome');
    }
}
