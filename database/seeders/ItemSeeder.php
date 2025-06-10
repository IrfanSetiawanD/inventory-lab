<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Item;

class ItemSeeder extends Seeder
{
    public function run(): void
    {
        Item::create(['category_id' => 1, 'name' => 'Kertas A4', 'stock' => 50, 'unit' => 'pcs']);
        Item::create(['category_id' => 1, 'name' => 'Kertas F4', 'stock' => 9, 'unit' => 'pcs']);
        Item::create(['category_id' => 2, 'name' => 'Printer Epson L310', 'stock' => 9, 'unit' => 'pcs']);
    }
}
