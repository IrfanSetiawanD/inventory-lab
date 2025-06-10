<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
