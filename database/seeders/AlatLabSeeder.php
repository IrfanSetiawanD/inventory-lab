<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AlatLab;

class AlatLabSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AlatLab::create([
            'name' => 'Beaker Gelas 250ml',
            'category_id' => 1, // ID dari kategori Gelasware
            'quantity' => 15,
            'unit' => 'buah',
            'description' => 'Beaker kaca borosilikat, tahan panas, untuk mencampur dan mengukur cairan.',
        ]);

        AlatLab::create([
            'name' => 'Mikroskop Cahaya Binokuler',
            'category_id' => 3, // ID dari kategori Optik
            'quantity' => 3,
            'unit' => 'unit',
            'description' => 'Mikroskop binokuler dengan perbesaran hingga 1000x, dilengkapi lampu LED.',
        ]);
    }
}
