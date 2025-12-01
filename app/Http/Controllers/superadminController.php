<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class superadminController extends Controller
{
    public function superadmin()
    {
        return view('auth.superadmin_login');
    }
}