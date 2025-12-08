<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class superadminController extends Controller
{
    public function superadmin()
    {
        return view('auth.superadmin_login');
    }

    public function superadmin_login_process(Request $request)
    {
        // Add your superadmin login logic here
        return redirect()->route('dashboard_user')->with('success', 'Superadmin login successful');
    }
}