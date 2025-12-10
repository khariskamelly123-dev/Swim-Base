<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prestasi;
use Illuminate\Support\Facades\Auth;

class PrestasiApiController extends Controller
{
    public function index()
    {
        return response()->json(Prestasi::with(['atlet','klub','event'])->orderBy('tanggal','desc')->get());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'atlet_id' => 'required|exists:atlets,id',
            'medal' => 'nullable|in:gold,silver,bronze,none',
            'posisi' => 'nullable|integer',
            'event_id' => 'nullable|exists:events,id',
        ]);

        $validated['created_by'] = Auth::id();
        $prestasi = Prestasi::create($validated + ['tanggal' => $request->input('tanggal')]);
        return response()->json($prestasi, 201);
    }

    public function show($id)
    {
        return response()->json(Prestasi::findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $prestasi = Prestasi::findOrFail($id);
        $validated = $request->validate([
            'medal' => 'nullable|in:gold,silver,bronze,none',
            'posisi' => 'nullable|integer',
        ]);
        $prestasi->update($validated);
        return response()->json($prestasi);
    }

    public function destroy($id)
    {
        Prestasi::findOrFail($id)->delete();
        return response()->json(['deleted' => true]);
    }
}
