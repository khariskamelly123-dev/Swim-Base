<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function welcome_selection()
    {
        return view('welcome');
    }

    public function logout(Request $request)
{
    // List semua guard yang Anda miliki
    $guards = ['web', 'admin', 'super_admin', 'club', 'institution'];

    foreach ($guards as $guard) {
        if (Auth::guard($guard)->check()) {
            Auth::guard($guard)->logout();
        }
    }

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('home')->with('success', 'Anda telah berhasil keluar.');
}
}