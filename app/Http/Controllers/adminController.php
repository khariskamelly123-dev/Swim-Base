<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Club;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class adminController extends Controller
{
    public function admin()
    {
        return view('auth.admin.admin_login');
    }

    public function regis_admin()
    {
        return view('auth.admin.regis_admin');
    }

    public function admin_login_process(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (!Auth::attempt(['email' => $validated['email'], 'password' => $validated['password']])) {
            return back()->withErrors(['email' => 'Email atau password salah.'])->onlyInput('email');
        }

        $user = Auth::user();
        if (!isset($user->role) || $user->role !== 'admin') {
            Auth::logout();
            return back()->withErrors(['email' => 'Akses admin ditolak.']);
        }

        return redirect()->route('dashboard_admin')->with('success', 'Admin login successful');
    }

    public function admin_register_process(Request $request)
    {
        $validated = $request->validate([
            'nama_admin' => 'required|string|max:255',
            'jenis_admin' => 'required|string|max:255',
            'email_resmi' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);

        DB::beginTransaction();
        try {
            $user = User::create([
                'name' => $validated['nama_admin'],
                'email' => $validated['email_resmi'],
                'password' => Hash::make($validated['password']),
                'role' => 'admin',
            ]);

            Club::create([
                'user_id' => $user->id,
                'name' => $validated['nama_admin'],
                'jenis_admin' => $validated['jenis_admin'],
            ]);

            DB::commit();
            return redirect()->route('admin_login')->with('success', 'Registrasi admin berhasil. Silakan login.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->withErrors(['general' => 'Terjadi kesalahan saat membuat akun. Silakan coba lagi.']);
        }
    }
}