<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\sekouniv;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

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

        $sekouniv = sekouniv::where('email_resmi_seko_univ', $validated['email_resmi_seko_univ'])->first();

        if (!$sekouniv || !Hash::check($validated['password'], $sekouniv->password)) {
            return back()->withErrors([
                'email_resmi_seko_univ' => 'Email atau password salah.',
            ])->onlyInput('email_resmi_seko_univ');
        }

        session(['sekouniv_id' => $sekouniv->id, 'sekouniv_name' => $sekouniv->nama_sekolah_universitas]);

        return redirect()->route('dashboard_afterlogin')->with('success', 'Login berhasil');
    }

    public function sekouniv_logout()
    {
        session()->forget(['sekouniv_id', 'sekouniv_name']);
        return redirect()->route('login')->with('success', 'Logout berhasil');
    }

    public function welcome_selection()
    {
        return view('welcome');
    }
}
