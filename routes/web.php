<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AlatLabController;
use App\Http\Controllers\BahanKimiaController;
use App\Http\Controllers\StockInController;
use App\Http\Controllers\StockOutController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ActivityLogController;
use Spatie\Activitylog\Models\Activity;
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

    Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/upload-photo', [ProfileController::class, 'uploadPhoto'])->name('profile.upload-photo');
    Route::put('/profile/update-password', [ProfileController::class, 'updatePassword'])->name('profile.update-password');
    Route::put('/profile/update-email', [ProfileController::class, 'updateEmail'])->name('profile.update-email');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile/change-email', [ProfileController::class, 'changeEmailForm'])->name('email.change.form');
    Route::get('/profile/change-password', [ProfileController::class, 'changePasswordForm'])->name('password.change.form');
});

    Route::get('/activity-logs', [ActivityLogController::class, 'index'])->name('activity.logs')->middleware(['auth']);
    Route::get('/logs', function () {
    $logs = Activity::with('causer')->latest()->paginate(10);
    return view('log.index', compact('logs'));
})->middleware('auth');


});

require __DIR__ . '/auth.php';
