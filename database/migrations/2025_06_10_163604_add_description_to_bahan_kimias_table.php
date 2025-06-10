<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDescriptionToBahanKimiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bahan_kimias', function (Blueprint $table) {
            // Tambahkan kolom 'description' sebagai string dan bisa null (opsional)
            // Jika Anda ingin description wajib diisi, hilangkan nullable()
            $table->text('description')->nullable()->after('danger_level');
            // Anda bisa menyesuaikan posisi 'after()' sesuai kebutuhan, misalnya setelah 'unit'
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bahan_kimias', function (Blueprint $table) {
            $table->dropColumn('description');
        });
    }
}
