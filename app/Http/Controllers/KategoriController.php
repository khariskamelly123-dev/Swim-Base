<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;

class KategoriController extends Controller
{
    public function index()
    {
        return response()->json(Kategori::orderBy('name')->get());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'slug' => 'required|string|unique:kategoris,slug',
        ]);

        $kategori = Kategori::create($validated + ['description' => $request->input('description')]);
        return response()->json($kategori, 201);
    }

    public function show($id)
    {
        return response()->json(Kategori::findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $kategori = Kategori::findOrFail($id);
        $validated = $request->validate([
            'name' => 'sometimes|required|string',
            'slug' => "sometimes|required|string|unique:kategoris,slug,$id",
        ]);
        $kategori->update($validated);
        return response()->json($kategori);
    }

    public function destroy($id)
    {
        Kategori::findOrFail($id)->delete();
        return response()->json(['deleted' => true]);
    }
}
