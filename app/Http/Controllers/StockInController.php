<?php

namespace App\Http\Controllers;

use App\Models\StockIn;
use App\Models\AlatLab;
use App\Models\BahanKimia;
use Illuminate\Http\Request;

class StockInController extends Controller
{
    public function index()
    {
        $stocks = StockIn::with('item')->get();
        return view('stock_in.index', compact('stocks'));
    }

    public function create()
    {
        $alat = AlatLab::all();
        $bahan = BahanKimia::all();
        return view('stock_in.create', compact('alat', 'bahan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:alat,bahan',
            'item_id' => 'required',
            'quantity' => 'required|integer|min:1',
            'date' => 'required|date',
        ]);

        $stockIn = StockIn::create($request->all());

        // Tambahkan ke stok sesuai jenis
        if ($request->type === 'alat') {
            $item = AlatLab::findOrFail($request->item_id);
        } else {
            $item = BahanKimia::findOrFail($request->item_id);
        }

        $item->increment('stock', $request->quantity);

        return redirect()->route('stock-in.index')->with('success', 'Stok masuk berhasil ditambahkan');
    }
}
