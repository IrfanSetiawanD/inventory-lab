<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Ambil kategori untuk Alat Lab
        $alatCategories = Category::where('type', 'Alat')->paginate(10, ['*'], 'alat_page'); // Paginate untuk Alat Lab

        // Ambil kategori untuk Bahan Kimia
        $bahanKimiaCategories = Category::where('type', 'Bahan Kimia')->paginate(10, ['*'], 'bahan_kimia_page'); // Paginate untuk Bahan Kimia

        return view('categories.index', compact('alatCategories', 'bahanKimiaCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'type' => 'required|in:Alat,Bahan Kimia',
            'hazard_level' => 'nullable|string|max:255',
        ]);

        Category::create($request->all());

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
            'type' => 'required|in:Alat,Bahan Kimia',
            'hazard_level' => 'nullable|string|max:255',
        ]);

        $category->update($request->all());

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        // Cek apakah ada alat lab yang terkait dengan kategori ini
        if ($category->alatLabs()->exists()) {
            return redirect()->route('categories.index')->with('error', 'Tidak dapat menghapus kategori karena ada Alat Lab yang terkait.');
        }

        // Cek apakah ada bahan kimia yang terkait dengan kategori ini
        if ($category->bahanKimias()->exists()) {
            return redirect()->route('categories.index')->with('error', 'Tidak dapat menghapus kategori karena ada Bahan Kimia yang terkait.');
        }

        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Kategori berhasil dihapus.');
    }
}
