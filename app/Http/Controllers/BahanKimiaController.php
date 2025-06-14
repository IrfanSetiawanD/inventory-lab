<?php

namespace App\Http\Controllers;

use App\Models\BahanKimia;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule; // Pastikan ini di-import

class BahanKimiaController extends Controller
{
    public function index()
    {
        // Pastikan variabel yang dikirim ke view adalah 'bahans' untuk konsistensi
        $bahans = BahanKimia::with('category')->latest()->paginate(10);
        return view('bahan.index', compact('bahans'));
    }

    public function create()
    {
        $categories = Category::where('type', 'Bahan Kimia')->get();
        // Danger levels untuk dropdown
        $dangerLevels = ['Tinggi', 'Sedang', 'Rendah'];
        return view('bahan.create', compact('categories', 'dangerLevels'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'quantity' => 'required|integer|min:0',
            'unit' => 'required|string|max:50',
            // Perbarui validasi danger_level untuk dropdown
            'danger_level' => ['required', 'string', Rule::in(['Tinggi', 'Sedang', 'Rendah'])],
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('bahan_images', 'public');
        }

        BahanKimia::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'quantity' => $request->quantity,
            'unit' => $request->unit,
            'danger_level' => $request->danger_level, // Nilai dari dropdown
            'description' => $request->description,
            'image' => $imagePath,
        ]);

        return redirect()->route('bahan.index')->with('success', 'Bahan Kimia berhasil ditambahkan.');
    }

    public function edit(BahanKimia $bahan)
    {
        $categories = Category::where('type', 'Bahan Kimia')->get();
        // Danger levels untuk dropdown
        $dangerLevels = ['Tinggi', 'Sedang', 'Rendah'];
        return view('bahan.edit', compact('bahan', 'categories', 'dangerLevels'));
    }

    public function update(Request $request, BahanKimia $bahan)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'quantity' => 'required|integer|min:0',
            'unit' => 'required|string|max:50',
            // Perbarui validasi danger_level untuk dropdown
            'danger_level' => ['required', 'string', Rule::in(['Tinggi', 'Sedang', 'Rendah'])],
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->except(['_token', '_method']);
        $data['image'] = $bahan->image;

        if ($request->hasFile('image')) {
            if ($bahan->image) {
                Storage::disk('public')->delete($bahan->image);
            }
            $data['image'] = $request->file('image')->store('bahan_images', 'public');
        }

        $bahan->update($data);

        return redirect()->route('bahan.index')->with('success', 'Bahan Kimia berhasil diperbarui.');
    }

    public function destroy(BahanKimia $bahan)
    {
        if ($bahan->image) {
            Storage::disk('public')->delete($bahan->image);
        }
        $bahan->delete();
        return redirect()->route('bahan.index')->with('success', 'Bahan Kimia berhasil dihapus.');
    }
}
