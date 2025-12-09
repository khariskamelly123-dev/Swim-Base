<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class adminController extends Controller
{
    public function admin()
    {
        return view('auth.admin.admin_login');
    }

    public function admin_login_process(Request $request)
    {
        // Add your admin login logic here
        return redirect()->route('dashboard_user')->with('success', 'Admin login successful');
    }
}