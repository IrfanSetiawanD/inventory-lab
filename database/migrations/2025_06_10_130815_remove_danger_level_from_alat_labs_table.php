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
            // Hapus kolom danger_level jika ada
            if (Schema::hasColumn('alat_labs', 'danger_level')) {
                $table->dropColumn('danger_level');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('alat_labs', function (Blueprint $table) {
            // Tambahkan kembali kolom danger_level jika dibutuhkan saat rollback
            $table->string('danger_level')->nullable(); // Atau sesuaikan dengan tipe aslinya jika tidak nullable
        });
    }
};
