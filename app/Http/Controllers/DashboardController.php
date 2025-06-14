<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\AlatLab;
use App\Models\BahanKimia;
use App\Models\Category;
use App\Models\StockIn;
use App\Models\StockOut;

class DashboardController extends Controller
{
    /**
     * Display the dashboard view with summary statistics.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $alatLabCount = AlatLab::count();
        $bahanKimiaCount = BahanKimia::count();
        $categories = Category::count();
        $stockOutCount = StockOut::count();
        $stockOutMonth = StockOut::whereMonth('date', now()->month)->count();

        // Data chart Bahan Kimia per Kategori
        $alatLabStats = alatLab::select('categories.name', DB::raw('count(*) as total'))
            ->join('categories', 'alat_labs.category_id', '=', 'categories.id')
            ->groupBy('categories.name')
            ->get();

        $alatCategoryNames = $alatLabStats->pluck('name');
        $alatCategoryCounts = $alatLabStats->pluck('total');

        // Data chart Bahan Kimia per Kategori
        $bahanKimiaStats = BahanKimia::select('categories.name', DB::raw('count(*) as total'))
            ->join('categories', 'bahan_kimias.category_id', '=', 'categories.id')
            ->groupBy('categories.name')
            ->get();

        $bahanCategoryNames = $bahanKimiaStats->pluck('name');
        $bahanCategoryCounts = $bahanKimiaStats->pluck('total');

        return view('dashboard', [
            'alatLabCount' => $alatLabCount,
            'bahanKimiaCount' => $bahanKimiaCount,
            'categories' => $categories,
            'stockOutCount' => $stockOutCount,
            'stockOutMonth' => $stockOutMonth,
            'categoryNames' => $categoryNames,
            'alatPerKategori' => $alatPerKategori,
            'bahanCategoryNames' => $bahanCategoryNames,
            'bahanCategoryCounts' => $bahanCategoryCounts,
            'alatCategoryNames' => $alatCategoryNames,
            'alatCategoryCounts' => $alatCategoryCounts
        ]);
    }
}
