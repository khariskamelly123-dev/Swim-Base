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
        $atlet = Atlet::orderBy('nama')->get();
        return view('atlet.index', compact('atlet'));
    }

    public function create()
    {
        return view('atlet.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'nisn' => 'nullable|string',
            'tanggal_lahir' => 'nullable|date',
            'gender' => 'nullable|in:L,P',
            'cabang_olahraga' => 'nullable|string'
        ]);

        Atlet::create([
            'klub_id' => Auth::user()->id ?? null, // asumsi user mewakili klub
            'nama' => $request->nama,
            'nisn' => $request->nisn,
            'tanggal_lahir' => $request->tanggal_lahir,
            'gender' => $request->gender,
            'cabang_olahraga' => $request->cabang_olahraga
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
            'nisn' => 'nullable|string',
            'tanggal_lahir' => 'nullable|date',
            'gender' => 'nullable|in:L,P',
            'cabang_olahraga' => 'nullable|string'
        ]);

        $atlet->update($request->only(['nama','nisn','tanggal_lahir','gender','cabang_olahraga']));

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
