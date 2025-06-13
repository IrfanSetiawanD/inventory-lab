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

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('categories', CategoryController::class)->middleware(['auth']);
    Route::resource('alat', AlatLabController::class)->middleware(['auth']);
    Route::resource('bahan', BahanKimiaController::class)->middleware(['auth']);
    Route::resource('stock-in', StockInController::class)->middleware(['auth']);
    Route::resource('stock-out', StockOutController::class)->middleware(['auth']);
    Route::get('/laporan', [ReportController::class, 'index'])->name('laporan')->middleware(['auth']);

    // Routes untuk profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
