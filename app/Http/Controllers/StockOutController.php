<?php

namespace App\Http\Controllers;

use App\Models\StockOut;
use App\Models\AlatLab;
use App\Models\BahanKimia;
use Illuminate\Http\Request;

class StockOutController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');
        $type = $request->input('type');

        $stocks = StockOut::when($query, function ($q) use ($query) {
                $q->where('item_name', 'like', "%{$query}%");
            })
            ->when($type, function ($q) use ($type) {
                $model = $type === 'alat' ? 'App\Models\AlatLab' : ($type === 'bahan' ? 'App\Models\BahanKimia' : null);
                if ($model) {
                    $q->where('itemable_type', $model);
                }
            })
            ->orderByDesc('date')
            ->paginate(10);

        if ($request->ajax()) {
            return response()->json([
                'html' => view('stock_out.partials.table_rows', compact('stocks'))->render(),
                'pagination' => view('stock_out.partials.pagination', compact('stocks'))->render()
            ]);
        }

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
            if (!$item || $item->quantity < $request->quantity) {
                return redirect()->back()->withErrors(['item_id' => 'Stok Alat tidak mencukupi atau tidak ditemukan.'])->withInput();
            }
            $itemableType = AlatLab::class;
            $itemName = $item->name;
        } elseif ($request->type === 'bahan') {
            $item = BahanKimia::find($itemableId);
            if (!$item || $item->quantity < $request->quantity) {
                return redirect()->back()->withErrors(['item_id' => 'Stok Bahan tidak mencukupi atau tidak ditemukan.'])->withInput();
            }
            $itemableType = BahanKimia::class;
            $itemName = $item->name;
        }

        StockOut::create([
            'itemable_id' => $itemableId,
            'itemable_type' => $itemableType,
            'item_name' => $itemName,
            'quantity' => $request->quantity,
            'date' => $request->date,
        ]);

        if ($item) {
            $item->quantity -= $request->quantity;
            $item->save();
        }

        return redirect()->route('stock-out.index')->with('success', 'Stock Out berhasil ditambahkan.');
    }

    public function destroy(StockOut $stockOut)
    {
        $itemToUpdate = null;

        if ($stockOut->itemable_type && class_exists($stockOut->itemable_type)) {
            $modelClass = $stockOut->itemable_type;
            $itemToUpdate = $modelClass::find($stockOut->itemable_id);
        }

        if ($itemToUpdate) {
            $itemToUpdate->quantity += $stockOut->quantity;
            if ($itemToUpdate->quantity < 0) {
                $itemToUpdate->quantity = 0;
            }
            $itemToUpdate->save();
        }

        $stockOut->delete();

        return redirect()->route('stock-out.index')->with('success', 'Stok Keluar successfully deleted.');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $type = $request->input('type');

        $stocks = StockOut::when($query, function ($q) use ($query) {
                $q->where('item_name', 'like', "%{$query}%");
            })
            ->when($type, function ($q) use ($type) {
                $model = $type === 'alat' ? 'App\Models\AlatLab' : ($type === 'bahan' ? 'App\Models\BahanKimia' : null);
                if ($model) {
                    $q->where('itemable_type', $model);
                }
            })
            ->orderByDesc('date')
            ->paginate(10);

        if ($request->ajax()) {
            return response()->json([
                'html' => view('stock_out.partials.table_rows', compact('stocks'))->render(),
                'pagination' => view('stock_out.partials.pagination', compact('stocks'))->render()
            ]);
        }

        return redirect()->route('stock-out.index');
    }    
}
