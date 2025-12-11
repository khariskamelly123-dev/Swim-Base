<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Atlet;
use App\Models\Pengajuan;
use Illuminate\Support\Facades\Auth;

class AtletController extends Controller
{
    public function index()
{
    $total_atlet = Atlet::count();
    $total_club = 0;
    $atlet = Atlet::orderBy('nama')->get(); 

    return view('atlet.index', compact('total_atlet', 'total_club', 'atlet'));
}

    public function create()
    {
        return view('atlet.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'tanggal_lahir' => 'nullable|date',
            'kategori_renang' => 'nullable|string'
        ]);

        Atlet::create([
            'klub_id' => Auth::user()->id ?? null, // asumsi user mewakili klub
            'nama' => $request->nama,
            'tanggal_lahir' => $request->tanggal_lahir,
            'kategori_renang' => $request->kategori_renang
        ]);

        return redirect()->route('atlet.index')->with('success', 'Atlet berhasil ditambahkan');
    }

    // SuperAdmin only edit (direct)
    public function edit($id)
    {
        $atlet = Atlet::findOrFail($id);
        return view('atlet.edit', compact('atlet'));
    }

    public function update(Request $request, $id)
    {
        $atlet = Atlet::findOrFail($id);

        $request->validate([
            'nama' => 'required|string',
            'tanggal_lahir' => 'nullable|date',
            'kategori_renang' => 'nullable|string'
        ]);

<<<<<<<<< Temporary merge branch 1
        $atlet->update($request->only(['nama','tanggal_lahir','kategori_renang']));
=========
        $atlet->update($request->only(['nama','tanggal_lahir','gender','cabang_olahraga']));
>>>>>>>>> Temporary merge branch 2

        return redirect()->route('atlet.index')->with('success', 'Atlet diperbarui');
    }

    // SuperAdmin only destroy (direct)
    public function destroy($id)
    {
        Atlet::findOrFail($id)->delete();
        return redirect()->route('atlet.index')->with('success', 'Atlet dihapus');
    }

    // Optional show
    public function show($id)
    {
        $atlet = Atlet::findOrFail($id);
        return view('atlet.show', compact('atlet'));
    }
}
