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
            $table->foreignId('anggota_keluarga_id')->constrained('anggota_keluargas')->onDelete('cascade');
            // Kolom untuk Kunjungan
            $table->date('waktu_kunjungan'); // Waktu kunjungan kader ke rumah usia sekolah / remaja
            $table->date('tanggal_kunjungan'); // Tanggal kunjungan
            $table->enum('suhu_tubuh', ['<37,5°C', '≥37,5°C'])->nullable(); // Pemantauan suhu tubuh
            $table->date('tanggal_terakhir_menimbang_mengukur')->nullable(); // Tanggal terakhir menimbang dan mengukur
            $table->enum('isi_piringku', ['Sesuai', 'Tidak'])->nullable(); // Isi Piringku Usia Sekolah / Remaja
            $table->decimal('bb', 5, 2)->nullable(); // Berat badan (BB)
            $table->decimal('tb', 5, 2)->nullable(); // Tinggi badan (PB/TB)

            // Kolom untuk Remaja Putri
            $table->boolean('ada_ttd')->default(false); // Apakah ada TTD
            $table->enum('minum_ttd', ['Ya', 'Tidak'])->nullable(); // Minum TTD hari ini / dalam 7 hari terakhir
            $table->date('tanggal_pemeriksaan_anemia')->nullable(); // Tanggal pemeriksaan anemia
            $table->string('tempat_pemeriksaan_anemia')->nullable(); // Tempat pemeriksaan anemia
            $table->string('hasil_pemeriksaan_anemia')->nullable(); // Hasil pemeriksaan anemia

            // Perilaku Merokok
            $table->enum('perilaku_merokok', ['Aktif', 'Pasif', 'Tidak'])->default('Tidak'); // Kebiasaan merokok

            // Pemeriksaan Remaja ≥ 15 tahun
            $table->date('tanggal_pemeriksaan_tekanan_darah')->nullable(); // Tanggal pemeriksaan tekanan darah
            $table->string('tempat_pemeriksaan_tekanan_darah')->nullable(); // Tempat pemeriksaan tekanan darah
            $table->string('hasil_pemeriksaan_tekanan_darah')->nullable(); // Hasil pemeriksaan tekanan darah
            $table->date('tanggal_pemeriksaan_gula_darah')->nullable(); // Tanggal pemeriksaan gula darah
            $table->string('tempat_pemeriksaan_gula_darah')->nullable(); // Tempat pemeriksaan gula darah
            $table->string('hasil_pemeriksaan_gula_darah')->nullable(); // Hasil pemeriksaan gula darah

            // Skrining kesehatan jiwa
            $table->date('tanggal_skrining_kesehatan_jiwa')->nullable(); // Tanggal skrining kesehatan jiwa
            $table->string('tempat_skrining_kesehatan_jiwa')->nullable(); // Tempat skrining kesehatan jiwa
            $table->string('nama_petugas_skrining')->nullable(); // Nama petugas yang melakukan skrining kesehatan jiwa

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
