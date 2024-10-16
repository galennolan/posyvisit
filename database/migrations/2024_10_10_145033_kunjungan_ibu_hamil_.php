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
        Schema::create('kunjungan_ibu_hamil', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('anggota_keluarga_id'); // Foreign key ke anggota_keluargas
            $table->integer('umur')->nullable(); // Umur ibu hamil
            $table->integer('kehamilan_ke')->nullable(); // Kehamilan anak keberapa
            $table->string('jarak_kehamilan', 50)->nullable(); // Jarak kehamilan dalam tahun/bulan
            $table->enum('buku_kia', ['Ya', 'Tidak'])->default('Tidak'); // Buku KIA
            $table->date('waktu_kunjungan')->nullable(); // Waktu kunjungan
            $table->date('tanggal_kunjungan')->nullable(); // Tanggal kunjungan
            $table->float('suhu_tubuh', 4, 2)->nullable(); // Pemantauan suhu tubuh
            $table->enum('buku_kia_ditunjukkan', ['Ya', 'Tidak'])->default('Tidak'); // Apakah buku KIA ditunjukkan

            // Kunjungan K1 - K6
            $table->json('k1')->nullable(); // Data kunjungan K1 (tanggal, tempat, petugas)
            $table->json('k2')->nullable(); // Data kunjungan K2 (tanggal, tempat, petugas)
            $table->json('k3')->nullable(); // Data kunjungan K3 (tanggal, tempat, petugas)
            $table->json('k4')->nullable(); // Data kunjungan K4 (tanggal, tempat, petugas)
            $table->json('k5')->nullable(); // Data kunjungan K5 (tanggal, tempat, petugas)
            $table->json('k6')->nullable(); // Data kunjungan K6 (tanggal, tempat, petugas)

            $table->enum('isi_piringku', ['Ya', 'Tidak'])->default('Tidak'); // Informasi Isi Piringku
            $table->enum('ttd', ['Ya', 'Tidak'])->default('Tidak'); // Pemberian Tablet Tambah Darah (TTD)
            $table->enum('ttd_ditunjukkan', ['Ya', 'Tidak'])->default('Tidak'); // Apakah TTD ditunjukkan
            $table->enum('ttd_dikonsumsi', ['Ya', 'Tidak'])->default('Tidak'); // Apakah TTD dikonsumsi dalam 24 jam terakhir
            $table->float('lila', 5, 2)->nullable(); // Lingkar lengan atas (LiLA) dalam cm
            $table->enum('pmt_bumil_kek', ['Ya', 'Tidak'])->default('Tidak'); // Pemberian PMT untuk ibu hamil KEK
            $table->json('kelas_ibu_hamil')->nullable(); // Informasi kelas ibu hamil
            $table->json('skrining_jiwa')->nullable(); // Skrining kesehatan jiwa
            $table->json('edukasi')->nullable(); // Informasi edukasi yang diberikan
            $table->enum('paraf', ['Ya', 'Tidak'])->default('Tidak'); // Paraf ibu hamil setelah wawancara

            $table->timestamps();

            // Foreign key constraint
            $table->foreign('anggota_keluarga_id')->references('id')->on('anggota_keluargas')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kunjungan_ibu_hamil');
    }

};
