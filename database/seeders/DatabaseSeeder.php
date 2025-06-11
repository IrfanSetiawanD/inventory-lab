<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User; // Pastikan model User diimpor jika Anda menggunakannya

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        // Panggil seeder untuk kategori terlebih dahulu karena alat dan bahan kimia bergantung padanya
        $this->call([
            CategorySeeder::class,
        ]);

        // Panggil seeder untuk data alat lab dan bahan kimia
        $this->call([
            AlatLabSeeder::class,
            BahanKimiaSeeder::class,
        ]);

        // Buat satu user spesifik untuk login (jika diperlukan)
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
