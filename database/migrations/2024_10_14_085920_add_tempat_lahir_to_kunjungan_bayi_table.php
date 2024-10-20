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
        Schema::table('kunjungan_bayi', function (Blueprint $table) {
          // Menambahkan kolom tempat_lahir setelah kolom yang diinginkan (misalnya setelah anggota_keluarga_id)
          $table->string('tempat_lahir')->nullable()->after('anggota_keluarga_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kunjungan_bayi', function (Blueprint $table) {
            //
        });
    }
};
