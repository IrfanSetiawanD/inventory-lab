<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule; // Tambahkan ini

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->get();
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name', // Menambahkan unique
            'type' => 'required|in:Alat,Bahan Kimia',
            'hazard_level' => 'nullable|string',
        ]);

        Category::create($validatedData); // Gunakan $validatedData setelah validasi

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $validatedData = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('categories')->ignore($category->id), // Unique kecuali untuk diri sendiri
            ],
            'type' => 'required|in:Alat,Bahan Kimia',
            'hazard_level' => 'nullable|string',
        ]);

        $category->update($validatedData); // Gunakan $validatedData setelah validasi

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Kategori berhasil dihapus.');
    }
}
