<?php

// database/migrations/<timestamp>_add_item_name_to_stock_ins_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('stock_ins', function (Blueprint $table) {
            $table->string('item_name')->nullable()->after('itemable_type'); // Tambahkan kolom ini
        });
    }

    public function down(): void
    {
        Schema::table('stock_ins', function (Blueprint $table) {
            $table->dropColumn('item_name');
        });
    }
};
