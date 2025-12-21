<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category; // Model Baru

class CategoryController extends Controller
{
    /**
     * Menampilkan semua kategori
     */
    public function index()
    {
        // Mengembalikan JSON (Cocok untuk API atau Select2)
        return response()->json(Category::orderBy('name')->get());
    }

    /**
     * Menyimpan kategori baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            // Pastikan nama tabel di database adalah 'categories'
            'slug'        => 'required|string|unique:categories,slug', 
            'description' => 'nullable|string'
        ]);

        $category = Category::create($validated);
        
        return response()->json($category, 201);
    }

    /**
     * Menampilkan detail kategori
     */
    public function show($id)
    {
        return response()->json(Category::findOrFail($id));
    }

    /**
     * Update kategori
     */
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $validated = $request->validate([
            'name'        => 'sometimes|required|string|max:255',
            // Validasi unique ignore ID saat ini agar tidak error saat update diri sendiri
            'slug'        => "sometimes|required|string|unique:categories,slug,$id",
            'description' => 'nullable|string'
        ]);

        $category->update($validated);

        return response()->json($category);
    }

    /**
     * Hapus kategori
     */
    public function destroy($id)
    {
        Category::findOrFail($id)->delete();
        
        return response()->json(['deleted' => true, 'message' => 'Category deleted successfully']);
    }
}