<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PengajuanController extends Controller
{
    public function index()
    {
        return "Ini halaman index pengajuan";
    }

    public function formEdit($id)
    {
        return "Form edit pengajuan untuk ID: " . $id;
    }

    public function pengajuanEdit(Request $request, $id)
    {
        return "Proses pengajuan edit untuk ID: " . $id;
    }

    public function formHapus($id)
    {
        return "Form hapus pengajuan untuk ID: " . $id;
    }

    public function pengajuanHapus(Request $request, $id)
    {
        return "Proses pengajuan hapus untuk ID: " . $id;
    }

    public function approve($id)
    {
        return "Approve pengajuan ID: " . $id;
    }

    public function reject($id)
    {
        return "Reject pengajuan ID: " . $id;
    }
}
