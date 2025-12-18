<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Club;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ClubController extends Controller
{
    public function club()
    {
        return view('auth.club.club_login');
    }

    public function regis_club()
    {
        return view('auth.club.regis_club');
    }

    public function club_register(Request $request)
{
    $validated = $request->validate([
        'nama_klub'     => 'required|string|max:255',
        'alamat_detail' => 'required|string',
        'provinsi_nama' => 'required|string',
        'kota'          => 'required|string',
        'kontak_club'   => 'required|string|max:20',
        'email_resmi'   => 'required|email|unique:clubs,email_resmi',
        'password'      => 'required|string|min:6',
    ]);


    $dataToSave = [
        'nama_klub'   => $validated['nama_klub'],
        'provinsi'    => $validated['provinsi_nama'], 
        'kota'        => $validated['kota'],
        'alamat_klub' => $validated['alamat_detail'],
        
        'kontak_club' => $validated['kontak_club'],
        'email_resmi' => $validated['email_resmi'],
        'password'    => Hash::make($validated['password']),
    ];

    Club::create($dataToSave);

    return redirect()->route('club.login')->with('success', 'Registrasi klub berhasil. Silakan login.');
}

    public function club_login_process(Request $request)
    {
        $validated = $request->validate([
            'email_resmi' => 'required|email',
            'password' => 'required|string',
        ]);

        // Attempt to authenticate using the 'club' guard
        $credentials = [
            'email_resmi' => $validated['email_resmi'],
            'password' => $validated['password'],
        ];

        if (!Auth::guard('club')->attempt($credentials)) {
            return back()->withErrors([
                'email_resmi' => 'Email atau password salah.',
            ])->onlyInput('email_resmi');
        }

        // Authentication successful, optionally store friendly name in session
        $club = Auth::guard('club')->user();
        session(['club_id' => $club->id, 'club_name' => $club->nama_klub]);

        return redirect()->route('dashboard_klub')->with('success', 'Login berhasil');
    }

    public function club_logout()
    {
        // Logout from club guard and clear session
        Auth::guard('club')->logout();
        session()->forget(['club_id', 'club_name']);
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('club.login')->with('success', 'Logout berhasil');
    }
}
