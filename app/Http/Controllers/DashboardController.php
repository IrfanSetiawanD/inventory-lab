<?php

namespace App\Http\Controllers;

use App\Models\AlatLab;
use App\Models\BahanKimia;
use App\Models\Category;
use App\Models\StockIn;
use App\Models\StockOut;
use Illuminate\Http\Request;
use Carbon\Carbon; // Import Carbon untuk manipulasi tanggal dan bulan

class DashboardController extends Controller
{
    /**
     * Display the dashboard view with summary statistics.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Hitung Total Stok: total quantity dari Alat Lab dan Bahan Kimia
        $totalAlatLabStock = AlatLab::sum('quantity');
        $totalBahanKimiaStock = BahanKimia::sum('quantity');
        $totalStock = $totalAlatLabStock + $totalBahanKimiaStock;

        // Hitung Total Stok Masuk Bulan Ini
        // Menggunakan Carbon untuk mendapatkan bulan dan tahun saat ini
        $totalStockInMonth = StockIn::whereMonth('date', Carbon::now()->month)
            ->whereYear('date', Carbon::now()->year)
            ->sum('quantity');

        // Hitung Total Stok Keluar Bulan Ini
        // Menggunakan Carbon untuk mendapatkan bulan dan tahun saat ini
        $totalStockOutMonth = StockOut::whereMonth('date', Carbon::now()->month)
            ->whereYear('date', Carbon::now()->year)
            ->sum('quantity');

        // Data statistik lain yang mungkin masih ingin Anda tampilkan (opsional)
        $alatLabCount = AlatLab::count(); // Jumlah jenis alat lab (bukan total quantity)
        $bahanKimiaCount = BahanKimia::count(); // Jumlah jenis bahan kimia (bukan total quantity)
        $categoriesCount = Category::count(); // Jumlah kategori
        $stockOutTotalCount = StockOut::sum('quantity'); // Total quantity stok keluar secara keseluruhan

        return view('dashboard', compact(
            'totalStock',
            'totalStockInMonth',
            'totalStockOutMonth',
            'alatLabCount',
            'bahanKimiaCount',
            'categoriesCount',
            'stockOutTotalCount'
        ));
    }
}
