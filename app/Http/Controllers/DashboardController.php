<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

        return view('dashboard', [
            'alatLabCount' => $alatLabCount,
            'bahanKimiaCount' => $bahanKimiaCount,
            'categories' => $categories,
            'stockOutCount' => $stockOutCount,
            'stockOutMonth' => $stockOutMonth,
        ]);
    }
}
