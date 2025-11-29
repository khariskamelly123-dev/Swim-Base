<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class prestasiController extends Controller
{
    public function indexprestasi()
    {
        return view('prestasi');
    }
}
