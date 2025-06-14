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
        $stocks = StockIn::paginate(10);
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

        $itemableId = $request->item_id;
        $itemableType = null;
        $itemName = null;
        $item = null;

        if ($request->type === 'alat') {
            $item = AlatLab::find($itemableId);
            if (!$item) {
                return redirect()->back()->withErrors(['item_id' => 'Alat Lab not found.'])->withInput();
            }
            $itemableType = AlatLab::class;
            $itemName = $item->name;
        } elseif ($request->type === 'bahan') {
            $item = BahanKimia::find($itemableId);
            if (!$item) {
                return redirect()->back()->withErrors(['item_id' => 'Bahan Kimia not found.'])->withInput();
            }
            $itemableType = BahanKimia::class;
            $itemName = $item->name;
        }

        StockIn::create([
            'itemable_id' => $itemableId,
            'itemable_type' => $itemableType,
            'item_name' => $itemName,
            'quantity' => $request->quantity,
            'date' => $request->date,
        ]);

        if ($item) {
            $item->quantity += $request->quantity;
            $item->save();
        }

        return redirect()->route('stock-in.index')->with('success', 'Stock In successfully added.');
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

        $itemableId = $request->item_id;
        $itemableType = null;
        $itemName = null;
        $item = null;
        $oldQuantity = $stockIn->quantity;

        if ($request->type === 'alat') {
            $item = AlatLab::find($itemableId);
            if (!$item) {
                return redirect()->back()->withErrors(['item_id' => 'Alat Lab not found.'])->withInput();
            }
            $itemableType = AlatLab::class;
            $itemName = $item->name;
        } elseif ($request->type === 'bahan') {
            $item = BahanKimia::find($itemableId);
            if (!$item) {
                return redirect()->back()->withErrors(['item_id' => 'Bahan Kimia not found.'])->withInput();
            }
            $itemableType = BahanKimia::class;
            $itemName = $item->name;
        }

        $stockIn->update([
            'itemable_id' => $itemableId,
            'itemable_type' => $itemableType,
            'item_name' => $itemName,
            'quantity' => $request->quantity,
            'date' => $request->date,
        ]);

        if ($item) {
            $changeInQuantity = $request->quantity - $oldQuantity;
            $item->quantity += $changeInQuantity;
            $item->save();
        }

        return redirect()->route('stock-in.index')->with('success', 'Stock In successfully updated.');
    }

    public function destroy(StockIn $stockIn)
    {
        $itemToUpdate = null;

        if ($stockIn->itemable_type && class_exists($stockIn->itemable_type)) {
            $modelClass = $stockIn->itemable_type;
            $itemToUpdate = $modelClass::find($stockIn->itemable_id);
        }

        if ($itemToUpdate) {
            $itemToUpdate->quantity -= $stockIn->quantity;
            if ($itemToUpdate->quantity < 0) {
                $itemToUpdate->quantity = 0;
            }
            $itemToUpdate->save();
        }

        $stockIn->delete();
        return redirect()->route('stock-in.index')->with('success', 'Stok Masuk successfully deleted.');
    }
}
