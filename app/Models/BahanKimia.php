<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BahanKimia extends Model
{
  use HasFactory;

  protected $fillable = [
    'name',
    'category_id',
    'quantity',
    'unit',
    'danger_level', // Pastikan ini ada di $fillable
    'description',
    'image',
  ];

  public function category()
  {
    return $this->belongsTo(Category::class);
  }

  // Tambahkan relasi polymorphic jika belum ada
  public function stockIns()
  {
    return $this->morphMany(StockIn::class, 'itemable');
  }

  public function stockOuts()
  {
    return $this->morphMany(StockOut::class, 'itemable');
  }

  public static function getCategoryStats()
  {
    return self::select('categories.name', DB::raw('count(*) as total'))
        ->join('categories', 'bahan_kimias.category_id', '=', 'categories.id')
        ->groupBy('categories.name')
        ->get();
  }
}
