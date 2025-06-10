<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('alat_labs', function (Blueprint $table) {
            // Tambahkan kolom 'description' setelah kolom 'unit' (opsional, bisa di mana saja)
            $table->text('description')->nullable()->after('unit'); // Menggunakan 'text' untuk deskripsi panjang
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('alat_labs', function (Blueprint $table) {
            // Hapus kolom 'description' jika migrasi di-rollback
            $table->dropColumn('description');
        });
    }
};
