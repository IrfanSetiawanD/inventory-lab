<?php

namespace App\Http\Controllers;

use App\Models\AlatLab;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Pastikan ini di-import!

class AlatLabController extends Controller
{
    public function index()
    {
        $alats = AlatLab::with('category')->paginate(10);
        return view('alat.index', compact('alats'));
    }

    public function create()
    {
        $categories = Category::where('type', 'alat')->get();
        return view('alat.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'quantity' => 'required|integer|min:0',
            'unit' => 'required|string|max:50',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imagePath = null; // Default value if no image is uploaded
        if ($request->hasFile('image')) {
            // Store the image in 'alat_images' directory within the 'public' disk
            // This will return the relative path, e.g., 'alat_images/some_unique_name.jpg'
            $imagePath = $request->file('image')->store('alat_images', 'public');
        }

        // Use an array to create the model instance with all validated data
        AlatLab::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'quantity' => $request->quantity,
            'unit' => $request->unit,
            'description' => $request->description,
            'image' => $imagePath, // Store the path returned by Storage::putFile (or store())
        ]);

        return redirect()->route('alat.index')->with('success', 'Alat Laboratorium berhasil ditambahkan.');
    }

    public function edit(AlatLab $alat)
    {
        $categories = Category::where('type', 'alat')->get();
        return view('alat.edit', compact('alat', 'categories'));
    }

    public function update(Request $request, AlatLab $alat)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            // Tambahkan validasi untuk quantity, unit, description jika perlu di update
            'quantity' => 'required|integer|min:0',
            'unit' => 'required|string|max:50',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->except(['_token', '_method']); // Ambil semua data kecuali token dan method
        $data['image'] = $alat->image; // Pertahankan gambar lama jika tidak ada yang diunggah

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($alat->image) {
                Storage::disk('public')->delete($alat->image);
            }
            // Simpan gambar baru
            $data['image'] = $request->file('image')->store('alat_images', 'public');
        }

        $alat->update($data);

        return redirect()->route('alat.index')->with('success', 'Alat berhasil diperbarui');
    }

    public function destroy(AlatLab $alat)
    {
        // Hapus gambar dari storage sebelum menghapus record dari database
        if ($alat->image) {
            Storage::disk('public')->delete($alat->image);
        }

        $alat->delete();
        return redirect()->route('alat.index')->with('success', 'Alat berhasil dihapus');
    }
}
