<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\AlatLab; // Import model AlatLab
use App\Models\BahanKimia; // Import model BahanKimia

class Category extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'type',
        'description', // Dipertahankan karena ada di fillable Anda
        'hazard_level',
    ];

    /**
     * Define a one-to-many relationship with AlatLab.
     * A category can have many AlatLabs.
     */
    public function alatLabs()
    {
        return $this->hasMany(AlatLab::class, 'category_id');
    }

    /**
     * Define a one-to-many relationship with BahanKimia.
     * A category can have many BahanKimia.
     */
    public function bahanKimias()
    {
        return $this->hasMany(BahanKimia::class, 'category_id');
    }
}
