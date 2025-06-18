<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

class StockOut extends Model
{
    use HasFactory;

    protected $fillable = [
        'itemable_id',       // Menyimpan ID dari model terkait (alat atau bahan)
        'itemable_type',     // Menyimpan tipe model (contoh: 'App\Models\AlatLab')
        'item_name',         // Nama barang atau bahan
        'quantity',          // Jumlah yang dikeluarkan
        'date',              // Tanggal stok keluar
        // tambahkan kolom lain yang diperlukan
    ];

    /**
     * Relasi polimorfik ke model item terkait (bisa AlatLab atau BahanKimia).
     */
    public function item()
    {
        return $this->morphTo();
    }

    public function itemable(): MorphTo
    {
        return $this->morphTo();
    }

    public static function thisMonthWithItem(): Builder
    {
        return self::with(['itemable.category'])
            ->whereMonth('date', Carbon::now()->month)
            ->whereYear('date', Carbon::now()->year);
    }

    public static function stokKeluarBulanIni()
    {
        $bulan = Carbon::now()->month;
        $tahun = Carbon::now()->year;

        $stockOutAlat = self::where('itemable_type', AlatLab::class)
            ->whereMonth('date', $bulan)
            ->whereYear('date', $tahun)
            ->sum('quantity');

        $stockOutBahan = self::where('itemable_type', BahanKimia::class)
            ->whereMonth('date', $bulan)
            ->whereYear('date', $tahun)
            ->sum('quantity');

        return [
            'alat' => $stockOutAlat,
            'bahan' => $stockOutBahan,
        ];
    }
}
