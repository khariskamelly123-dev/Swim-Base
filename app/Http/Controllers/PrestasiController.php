<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PrestasiController extends Controller
{
    public function indexprestasi()
    {
        return view('prestasi');
    }
}
