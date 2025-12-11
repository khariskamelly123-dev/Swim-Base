<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class superadminController extends Controller
{
    public function superadmin()
    {
        return view('auth.superadmin.superadmin_login');
    }

    public function superadmin_login_process(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (!Auth::attempt(['email' => $validated['email'], 'password' => $validated['password']])) {
            return back()->withErrors(['email' => 'Email atau password salah.'])->onlyInput('email');
        }

        $user = Auth::user();
        if (!isset($user->role) || $user->role !== 'superadmin') {
            Auth::logout();
            return back()->withErrors(['email' => 'Akses superadmin ditolak.']);
        }

        return redirect()->route('dashboard')->with('success', 'Superadmin login successful');
    }
}