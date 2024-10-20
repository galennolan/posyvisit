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
        Schema::create('kunjungan_tbc', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('anggota_keluarga_id'); 
            $table->date('tanggal')->nullable();

            // Skrining TBC
            $table->enum('batuk_terus_menerus', ['Ya', 'Tidak'])->nullable();
            $table->enum('demam_lebih_dari_dua_minggu', ['Ya', 'Tidak'])->nullable();
            $table->enum('bb_tidak_naik_turun_dua_bulan', ['Ya', 'Tidak'])->nullable();
            $table->string('kontak_erat_pasien_tbc')->nullable();
            $table->date('terdiagnosa_tbc_tanggal')->nullable();
            $table->string('terdiagnosa_tbc_tempat')->nullable();
            $table->date('pemeriksaan_terakhir')->nullable();

            // Obat TBC
            $table->enum('ada_obat_tbc', ['Ada', 'Tidak'])->nullable();
            $table->enum('sudah_minum_obat_hari_ini', ['Ya', 'Tidak'])->nullable();
            $table->string('pengawas_minum_obat_pmo')->nullable();

            // Perilaku Merokok
            $table->enum('perilaku_merokok', ['Aktif', 'Pasif'])->nullable();

            // Pemberian Edukasi/Kunjungan Nakes
            $table->string('pemberian_edukasi')->nullable();

            // Mengingatkan Periksa ke Pustu/Fasyankes
            $table->string('mengingatkan_periksa_pustu_fasyankes')->nullable();

            // Melaporkan ke Nakes
            $table->string('melaporkan_ke_nakes')->nullable();

            // Paraf Terduga/Pasien TBC
            $table->string('paraf_terduga_pasien_tbc')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
