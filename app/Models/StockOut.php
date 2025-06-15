<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
