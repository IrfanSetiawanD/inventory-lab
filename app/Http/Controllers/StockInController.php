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

        $model = $request->type === 'alat' ? AlatLab::class : BahanKimia::class;
        
        StockIn::create([
            'itemable_id' => $request->item_id,
            'itemable_type' => $model,
            'quantity' => $request->quantity,
            'date' => $request->date,
        ]);
        return redirect()->route('stock-in.index')->with('success', 'Stock In berhasil ditambahkan.');
    }

    public function edit(StockIn $stockIn)
    {
        $alat = AlatLab::all();
        $bahan = BahanKimia::all();
        return view('stock_in.edit', compact('stockIn', 'alat', 'bahan'));
    }

    public function update(Request $request, StockIn $stockIn)
    {
        $request->validate([
            'type' => 'required|in:alat,bahan',
            'item_id' => 'required',
            'quantity' => 'required|integer|min:1',
            'date' => 'required|date',
        ]);

        $model = $request->type === 'alat' ? AlatLab::class : BahanKimia::class;

        $stockIn->update([
            'itemable_id' => $request->item_id,
            'itemable_type' => $model,
            'quantity' => $request->quantity,
            'date' => $request->date,
        ]);
        return redirect()->route('stock-in.index')->with('success', 'Stock In berhasil diperbarui.');
    }

}
