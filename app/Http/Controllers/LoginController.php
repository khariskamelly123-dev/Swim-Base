<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function welcome_selection()
    {
        return view('welcome');
    }
}