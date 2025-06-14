<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
