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
        Schema::create('kunjungan_rumah_usia_sekolah_remaja', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('anggota_keluarga_id'); // Foreign key ke tabel anggota keluarga
            $table->date('waktu_kunjungan')->nullable();
            $table->date('tanggal_kunjungan');
            $table->string('suhu_tubuh')->nullable();
            $table->date('tanggal_terakhir_menimbang_mengukur')->nullable();
            $table->enum('isi_piringku', ['Sesuai', 'Tidak']);
            $table->float('bb')->nullable(); // Berat Badan
            $table->float('tb')->nullable(); // Tinggi Badan
            $table->float('lp')->nullable(); // Lingkar Pinggang
            $table->boolean('ada_ttd')->nullable(); // Ada TTD
            $table->enum('minum_ttd', ['Ya', 'Tidak'])->nullable();
            $table->date('tanggal_pemeriksaan_1')->nullable();
            $table->string('tempat_pemeriksaan_1')->nullable();
            $table->string('hasil_pemeriksaan_1')->nullable();
            $table->enum('perilaku_merokok', ['Aktif', 'Pasif'])->nullable();
            $table->date('tanggal_pemeriksaan_gula')->nullable();
            $table->string('tempat_pemeriksaan_gula')->nullable();
            $table->string('hasil_pemeriksaan_gula')->nullable();
            $table->date('tanggal_pemeriksaan_tekanan')->nullable();
            $table->string('tempat_pemeriksaan_tekanan')->nullable();
            $table->string('hasil_pemeriksaan_tekanan')->nullable();
            $table->date('tanggal_skrining_jiwa')->nullable();
            $table->string('tempat_skrining_jiwa')->nullable();
            $table->string('hasil_skrining_jiwa')->nullable();
            // Edukasi dan Paraf
            $table->string('pemberian_edukasi')->nullable(); // Edukasi / Kunjungan Nakes
            $table->string('paraf_remaja')->nullable(); // Paraf remaja setelah wawancara

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kunjungan_rumah_usia_sekolah_remaja');
    }
};
