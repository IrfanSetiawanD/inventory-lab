<?php

namespace App\Http\Controllers;

use App\Models\StockIn;
use App\Models\AlatLab;
use App\Models\BahanKimia;
use Illuminate\Http\Request;

class StockInController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');
        $type = $request->input('type');
        $sort = $request->input('sort', 'date'); // default sort
        $direction = $request->input('direction', 'desc');

        $stocks = StockIn::when($query, function ($q) use ($query) {
                $q->where('item_name', 'like', "%{$query}%");
            })
            ->when($type, function ($q) use ($type) {
                $model = $type === 'alat' ? 'App\Models\AlatLab' : ($type === 'bahan' ? 'App\Models\BahanKimia' : null);
                if ($model) {
                    $q->where('itemable_type', $model);
                }
            })
            ->orderBy($sort, $direction)
            ->paginate(10);

        if ($request->ajax()) {
            return response()->json([
                'html' => view('stock_in.partials.table_rows', compact('stocks'))->render(),
                'pagination' => view('stock_in.partials.pagination', compact('stocks'))->render()
            ]);
        }

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

        activity()
    ->causedBy(auth()->user())
    ->performedOn($stockIn)
    ->log('Menambahkan stok masuk');

        return redirect()->route('stock-in.index')->with('success', 'Stock In successfully added.');
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

        activity()
    ->causedBy(auth()->user())
    ->performedOn($stockIn)
    ->log('Menghapus catatan stok masuk');

        return redirect()->route('stock-in.index')->with('success', 'Stok Masuk successfully deleted.');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $type = $request->input('type');
        $sort = $request->input('sort', 'date'); // default sort
        $direction = $request->input('direction', 'desc');

        $stocks = StockIn::when($query, function ($q) use ($query) {
                $q->where('item_name', 'like', "%{$query}%");
            })
            ->when($type, function ($q) use ($type) {
                $model = $type === 'alat' ? 'App\Models\AlatLab' : ($type === 'bahan' ? 'App\Models\BahanKimia' : null);
                if ($model) {
                    $q->where('itemable_type', $model);
                }
            })
            ->orderBy($sort, $direction)
            ->paginate(10);

        if ($request->ajax()) {
            return response()->json([
                'html' => view('stock_in.partials.table_rows', compact('stocks'))->render(),
                'pagination' => view('stock_in.partials.pagination', compact('stocks'))->render()
            ]);
        }

        return redirect()->route('stock-in.index');
    }
    
}
