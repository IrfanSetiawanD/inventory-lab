<?php

namespace App\Http\Controllers;

use App\Models\AlatLab;
use App\Models\BahanKimia;
use App\Models\StockIn;
use App\Models\StockOut;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;


class ReportController extends Controller
{
    /**
     * Display a listing of the reports.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // 1. Data Alat Lab
        // Mengambil semua alat lab beserta kategori yang terkait
        $alatLabs = AlatLab::with('category')->get();

        // 2. Data Bahan Kimia
        // Mengambil semua bahan kimia beserta kategori yang terkait
        $bahanKimias = BahanKimia::with('category')->get();

        // 3. Data Stok Masuk
        // Mengambil semua stok masuk. Relasi 'item' digunakan di StockIn model untuk mendapatkan polymorphic relation.
        // Meskipun di destroy() kita menggunakan manual find, di sini 'with('item')' masih relevan untuk data asli.
        $stockIns = StockIn::all();

        // 4. Data Stok Keluar
        // Mengambil semua stok keluar. Asumsi StockOut juga memiliki item_name, itemable_type, itemable_id.
        $stockOuts = StockOut::all();

        return view('laporan.index', compact(
            'alatLabs',
            'bahanKimias',
            'stockIns',
            'stockOuts'
        ));
    }

    public function exportPdf()
    {
        $alatLabs = AlatLab::with('category')->get();
        $bahanKimias = BahanKimia::with('category')->get();
        $stockIns = StockIn::all();
        $stockOuts = StockOut::all();

        $pdf = Pdf::loadView('laporan.pdf', compact(
            'alatLabs',
            'bahanKimias',
            'stockIns',
            'stockOuts'
        ))->setPaper('a4', 'portrait');

        return $pdf->stream('laporan-inventaris.pdf'); // atau ->download() jika mau langsung unduh
    }
}
