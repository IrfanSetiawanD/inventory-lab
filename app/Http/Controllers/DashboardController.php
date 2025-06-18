<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\AlatLab;
use App\Models\BahanKimia;
use App\Models\Category;
use App\Models\StockIn;
use App\Models\StockOut;
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

        // Data chart Alat Lab per Kategori
        $alatLabStats = AlatLab::getCategoryStats();
        $alatCategoryNames = $alatLabStats->pluck('name');
        $alatCategoryCounts = $alatLabStats->pluck('total');

        // Data chart Bahan Kimia per Kategori
        $bahanKimiaStats = BahanKimia::getCategoryStats();
        $bahanCategoryNames = $bahanKimiaStats->pluck('name');
        $bahanCategoryCounts = $bahanKimiaStats->pluck('total');

        $stockIns = StockIn::thisMonthWithItem()->get();

        $categoryTotals = [];

        foreach ($stockIns as $stockIn) {
            if ($stockIn->itemable && $stockIn->itemable->category) {
                $categoryName = $stockIn->itemable->category->name;
                if (!isset($categoryTotals[$categoryName])) {
                    $categoryTotals[$categoryName] = 0;
                }
                $categoryTotals[$categoryName] += $stockIn->quantity;
            }
        }

        $stockInCategoryNames = array_keys($categoryTotals);
        $stockInCategoryTotals = array_values($categoryTotals);

        $stokMasukData = StockIn::stokMasukBulanIni(); // Ambil data dari model

        $stockOuts = StockOut::thisMonthWithItem()->get();

        $categoryOutTotals = [];

        foreach ($stockOuts as $stockOut) {
            if ($stockOut->itemable && $stockOut->itemable->category) {
                $categoryName = $stockOut->itemable->category->name;
                if (!isset($categoryOutTotals[$categoryName])) {
                    $categoryOutTotals[$categoryName] = 0;
                }
                $categoryOutTotals[$categoryName] += $stockOut->quantity;
            }
        }

        $stockOutCategoryNames = array_keys($categoryOutTotals);
        $stockOutCategoryTotals = array_values($categoryOutTotals);

        $stokKeluarData = StockOut::stokKeluarBulanIni(); // Ambil data dari model


        return view('dashboard', array_merge(
        compact(
            'totalStock',
            'totalStockInMonth',
            'totalStockOutMonth',
            'alatLabCount',
            'bahanKimiaCount',
            'categoriesCount',
            'stockOutTotalCount',
            'alatCategoryNames',
            'alatCategoryCounts',
            'bahanCategoryNames',
            'bahanCategoryCounts',
            'stockInCategoryNames',
            'stockInCategoryTotals',
            'stockOutCategoryNames',
            'stockOutCategoryTotals'
        ),
        [
            'stockInAlat' => $stokMasukData['alat'],
            'stockInBahan' => $stokMasukData['bahan'],
            'stockOutAlat' => $stokKeluarData['alat'],
            'stockOutBahan' => $stokKeluarData['bahan']
        ]
        ));
    }
}
