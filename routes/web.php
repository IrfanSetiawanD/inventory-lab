<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AlatLabController;
use App\Http\Controllers\BahanKimiaController;
use App\Http\Controllers\StockInController;
use App\Http\Controllers\StockOutController;
use App\Http\Controllers\ReportController;
// Tambahkan ini
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome-inv');
});

// Route untuk halaman About baru
Route::get('/about', function () {
    return view('pages.about'); // Mengarahkan ke file about.blade.php yang baru dibuat
})->name('about');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('categories', CategoryController::class)->middleware(['auth']);
    Route::resource('alat', AlatLabController::class)->middleware(['auth']);
    Route::get('/alat-lab/search', [AlatLabController::class, 'search'])->name('alatlab.search');
    Route::resource('bahan', BahanKimiaController::class)->middleware(['auth']);
    Route::get('/bahan-kimia/search', [BahanKimiaController::class, 'search'])->name('bahankimia.search');
    Route::resource('stock-in', StockInController::class)->middleware(['auth']);
    Route::get('/stock_in/search', [StockInController::class, 'search'])->name('stock_in.search');
    Route::resource('stock-out', StockOutController::class)->middleware(['auth']);
    Route::get('/stock_out/search', [StockInController::class, 'search'])->name('stock_out.search');
    Route::get('/laporan', [ReportController::class, 'index'])->name('laporan')->middleware(['auth']);
    Route::get('/laporan/export-pdf', [ReportController::class, 'exportPdf'])->name('laporan.exportPdf');



    // Routes untuk profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
