<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

class StockIn extends Model
{
    use HasFactory;

    protected $fillable = [
        'itemable_id', // Ini menyimpan ID item (alat atau bahan)
        'itemable_type', // Ini menyimpan kelas model (misal: 'App\Models\AlatLab')
        'item_name', // Ini menyimpan nama item
        'quantity',
        'date',
        // tambahkan kolom lain yang relevan jika ada
    ];

    /**
     * Get the parent item (AlatLab or BahanKimia) that owns the stock in.
     * Definisi relasi polimorfik untuk 'item'.
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

    public static function stokMasukBulanIni()
    {
        $bulan = Carbon::now()->month;
        $tahun = Carbon::now()->year;

        $stockInAlat = self::where('itemable_type', AlatLab::class)
            ->whereMonth('date', $bulan)
            ->whereYear('date', $tahun)
            ->sum('quantity');

        $stockInBahan = self::where('itemable_type', BahanKimia::class)
            ->whereMonth('date', $bulan)
            ->whereYear('date', $tahun)
            ->sum('quantity');

        return [
            'alat' => $stockInAlat,
            'bahan' => $stockInBahan,
        ];
    }
}
