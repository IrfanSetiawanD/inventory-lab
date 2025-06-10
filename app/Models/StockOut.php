<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// Tidak perlu lagi mengimpor AlatLab dan BahanKimia secara langsung di sini
// karena morphTo() akan menanganinya secara dinamis.

class StockOut extends Model
{
    // Jika Anda belum menambahkan HasFactory, tambahkan jika Anda menggunakannya untuk seeder/factory
    // use Illuminate\Database\Eloquent\Factories\HasFactory;
    // use HasFactory;

    // Pastikan fillable mencakup kolom polymorphic
    protected $fillable = [
        'itemable_id',   // Kolom ID dari item terkait
        'itemable_type', // Kolom tipe model (contoh: 'App\Models\AlatLab' atau 'App\Models\BahanKimia')
        'quantity',
        'date',
    ];

    /**
     * Dapatkan model itemable pemilik (BahanKimia atau AlatLab).
     * Ini adalah hubungan polymorphic.
     */
    public function itemable()
    {
        return $this->morphTo();
    }

    /**
     * Accessor untuk menampilkan nama item (alat atau bahan).
     * Sekarang menggunakan hubungan polymorphic yang sebenarnya.
     */
    public function getItemNameAttribute()
    {
        // Panggil hubungan itemable, lalu akses properti 'name' dari model terkait.
        // Jika itemable null (misal relasi tidak ada atau item sudah dihapus), kembalikan null.
        return $this->itemable?->name;
    }
}
