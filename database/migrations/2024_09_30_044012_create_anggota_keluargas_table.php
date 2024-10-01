<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('anggota_keluargas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('keluarga_id')->constrained()->onDelete('cascade'); // Relasi ke kepala keluarga
            $table->string('nama_lengkap');
            $table->string('nik')->unique();
            $table->date('tanggal_lahir');
            $table->string('jenis_kelamin');
            $table->string('hubungan_kk'); // Hubungan dengan kepala keluarga
            $table->string('status_perkawinan');
            $table->string('pendidikan_terakhir');
            $table->string('pekerjaan');
            $table->string('kelompok_sasaran')->nullable();
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anggota_keluargas');
    }
};
