<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // ini dashboard superadmin
        return view('dashboard.index');
    }
    public function dashboard()
    {
        return view('dashboard.dashboard_user');
    }

    public function dashboard_afterlogin()
    {
        return view('dashboard.dashboard_afterlogin');
    }
    //dashboard admin
    public function admin()
{
    return view('dashboard.admin');
}

}
