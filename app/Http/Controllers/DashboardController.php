<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        return view('dashboard.dashboard_user');
    }

    public function dashboard_afterlogin()
    {
        return view('dashboard.dashboard_afterlogin');
    }
}