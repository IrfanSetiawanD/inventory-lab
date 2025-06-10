<?php

namespace App\Http\Controllers;

use App\Models\StockOut;
use App\Models\AlatLab;
use App\Models\BahanKimia;
use Illuminate\Http\Request;

class StockOutController extends Controller
{
    public function index()
    {
        $stocks = StockOut::all();
        return view('stock_out.index', compact('stocks'));
    }

    public function create()
    {
        $alat = AlatLab::all();
        $bahan = BahanKimia::all();
        return view('stock_out.create', compact('alat', 'bahan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:alat,bahan',
            'item_id' => 'required|integer',
            'quantity' => 'required|integer|min:1',
            'date' => 'required|date',
        ]);

        StockOut::create($request->all());

        if ($request->type === 'alat') {
            $item = AlatLab::findOrFail($request->item_id);
        } else {
            $item = BahanKimia::findOrFail($request->item_id);
        }

        $item->decrement('stock', $request->quantity);

        return redirect()->route('stock-out.index')->with('success', 'Stok keluar berhasil ditambahkan');
    }
}
