<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BahanKimia;

class BahanKimiaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BahanKimia::create([
            'id' => 201, // Jika Anda ingin id spesifik
            'name' => 'Asam Klorida (HCl) 37%',
            'category_id' => 2, // ID dari kategori Asam Kuat
            'quantity' => 500,
            'unit' => 'ml',
            'description' => 'Larutan Asam Klorida pekat, sangat korosif, untuk berbagai reaksi kimia.',
        ]);

        BahanKimia::create([
            'id' => 202,
            'name' => 'Etanol (C2H5OH) 96%',
            'category_id' => 4, // ID dari kategori Pelarut Organik
            'quantity' => 1000,
            'unit' => 'ml',
            'description' => 'Alkohol etil, pelarut umum di laboratorium, mudah terbakar.',
        ]);
    }
}
