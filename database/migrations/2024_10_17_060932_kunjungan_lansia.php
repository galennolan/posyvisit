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
        Schema::create('kunjungan_lansia', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('anggota_keluarga_id'); 
            $table->date('tanggal')->nullable();

            // Suhu Tubuh
           $table->string('suhu_tubuh')->nullable();

            // Pemeriksaan Tekanan Darah
            $table->date('pemeriksaan_tekanan_darah_tahun_terakhir')->nullable();
            $table->string('tempat_pemeriksaan_tekanan_darah_tahun_terakhir')->nullable();
            $table->string('hasil_pemeriksaan_tekanan_darah_tahun_terakhir')->nullable();
            $table->date('terdiagnosa_hipertensi_tahun_terakhir')->nullable();
            $table->date('pemeriksaan_tekanan_darah_bulan_terakhir')->nullable();
            $table->string('tempat_pemeriksaan_tekanan_darah_bulan_terakhir')->nullable();
            $table->string('hasil_pemeriksaan_tekanan_darah_bulan_terakhir')->nullable();
            $table->enum('ada_obat_hipertensi', ['Ada', 'Tidak'])->nullable();
            $table->enum('sudah_minum_obat_hipertensi', ['Ya', 'Tidak'])->nullable();

            // Pemeriksaan Kadar Gula Darah
            $table->date('pemeriksaan_gula_darah_tahun_terakhir')->nullable();
            $table->string('tempat_pemeriksaan_gula_darah_tahun_terakhir')->nullable();
            $table->string('hasil_pemeriksaan_gula_darah_tahun_terakhir')->nullable();
            $table->date('terdiagnosa_diabetes_melitus_tahun_terakhir')->nullable();
            $table->date('pemeriksaan_gula_darah_bulan_terakhir')->nullable();
            $table->string('tempat_pemeriksaan_gula_darah_bulan_terakhir')->nullable();
            $table->string('hasil_pemeriksaan_gula_darah_bulan_terakhir')->nullable();
            $table->enum('ada_obat_dm', ['Ada', 'Tidak'])->nullable();
            $table->enum('sudah_minum_obat_dm', ['Ya', 'Tidak'])->nullable();

            // Skiring/ Pemeriksaan Geriatri
            $table->date('aks_tanggal')->nullable();
            $table->string('aks_tempat')->nullable();
            $table->date('skilas_tanggal')->nullable();
            $table->string('skilas_tempat')->nullable();

            // Perilaku Merokok
            $table->enum('perilaku_merokok', ['Aktif', 'Pasif'])->nullable();

            // Skrining Kesehatan Jiwa
            $table->date('skrining_kesehatan_jiwa_tanggal')->nullable();
            $table->string('skrining_kesehatan_jiwa_tempat')->nullable();
            $table->string('skrining_kesehatan_jiwa_petugas')->nullable();

            // Pemberian Edukasi/Kunjungan Nakes
            $table->string('pemberian_edukasi')->nullable();

            // Paraf Lansia
            $table->string('paraf_lansia')->nullable();

            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kunjungan_rumah_lansia');
    }
};
