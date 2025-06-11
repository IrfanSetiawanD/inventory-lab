<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'id' => 1, // Jika Anda ingin id spesifik, jika tidak biarkan auto-increment
            'name' => 'Gelasware',
            'type' => 'Alat',
            'hazard_level' => null,
        ]);

        Category::create([
            'id' => 2,
            'name' => 'Asam Kuat',
            'type' => 'Bahan Kimia',
            'hazard_level' => 'Korosif, Iritan',
        ]);

        Category::create([
            'id' => 3, // Kategori baru untuk Mikroskop
            'name' => 'Optik',
            'type' => 'Alat',
            'hazard_level' => null,
        ]);

        Category::create([
            'id' => 4, // Kategori baru untuk Etanol
            'name' => 'Pelarut Organik',
            'type' => 'Bahan Kimia',
            'hazard_level' => 'Mudah Terbakar',
        ]);
    }
}
