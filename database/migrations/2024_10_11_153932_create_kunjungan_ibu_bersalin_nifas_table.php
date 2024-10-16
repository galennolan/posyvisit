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
        Schema::create('kunjungan_ibu_bersalin_nifas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('anggota_keluarga_id');
            $table->string('nama_ibu');
            $table->integer('umur_ibu');
            $table->date('tanggal_persalinan');
            $table->integer('usia_kehamilan_saat_persalinan')->comment('Usia kehamilan dalam minggu');
            $table->integer('kelahiran_anak_ke');
            $table->time('pukul_persalinan');
            $table->string('penolong_persalinan');
            $table->string('tempat_persalinan');
            $table->string('keadaan_ibu');
            $table->boolean('inisiasi_menyusu_dini')->comment('IMD: 1=Ya, 0=Tidak');
            $table->timestamps();

            // Foreign key
            $table->foreign('anggota_keluarga_id')->references('id')->on('anggota_keluargas')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kunjungan_ibu_bersalin_nifas');
    }
};
