<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;

class AlatLab extends Model
{
  use HasFactory;

  protected $fillable = [
    'name',
    'category_id',
    'quantity',
    'unit',
    'description',
    'image',
  ];

  /**
   * Relasi ke kategori.
   */
  public function category()
  {
    return $this->belongsTo(Category::class);
  }

  /**
   * Dapatkan semua catatan stok masuk (StockIn) untuk alat lab ini.
   * Ini adalah hubungan polymorphic.
   */
  public function stockIns()
  {
    return $this->morphMany(StockIn::class, 'itemable');
  }

  /**
   * Dapatkan semua catatan stok keluar (StockOut) untuk alat lab ini.
   * Ini adalah hubungan polymorphic.
   */
  public function stockOuts()
  {
    return $this->morphMany(StockOut::class, 'itemable');
  }

  public static function getCategoryStats()
  {
    return self::select('categories.name', DB::raw('count(*) as total'))
        ->join('categories', 'alat_labs.category_id', '=', 'categories.id')
        ->groupBy('categories.name')
        ->get();
  }
}
