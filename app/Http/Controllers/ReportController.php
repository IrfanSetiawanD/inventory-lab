<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StockIn;
use App\Models\StockOut;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function index()
    {
        return view('reports.index');
    }

    public function exportPdf(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        $stockIn = StockIn::whereBetween('date', [$request->start_date, $request->end_date])->get();
        $stockOut = StockOut::whereBetween('date', [$request->start_date, $request->end_date])->get();

        $pdf = Pdf::loadView('reports.pdf', compact('stockIn', 'stockOut'));
        return $pdf->download('laporan_inventory.pdf');
    }
}
