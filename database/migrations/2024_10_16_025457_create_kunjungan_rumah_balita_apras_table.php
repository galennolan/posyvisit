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
        Schema::create('kunjungan_rumah_balita_apras', function (Blueprint $table) {
            $table->id();
            $table->foreignId('anggota_keluarga_id')->constrained('anggota_keluargas')->onDelete('cascade');
            $table->date('waktu_kunjungan'); // Kolom 1: Waktu Kunjungan
            $table->date('tanggal'); // Kolom 2: Tanggal Kunjungan
            $table->decimal('suhu_tubuh', 5, 2); // Kolom 3: Pemantauan Suhu Tubuh
            $table->boolean('ada_buku_kia'); // Kolom 4: Ada Buku KIA
            $table->date('tanggal_terakhir_menimbang_mengukur')->nullable(); // Kolom 5: Tanggal terakhir menimbang dan mengukur
            $table->string('hasil_penimbangan', 255)->nullable(); // Kolom 6: Hasil penimbangan dan pengukuran
            $table->decimal('bb', 5, 2)->nullable(); // Kolom 6: BB (Berat Badan)
            $table->decimal('pb_tb', 5, 2)->nullable(); // Kolom 6: PB/TB (Tinggi Badan)
            $table->decimal('lk', 5, 2)->nullable(); // Kolom 6: LK (Lingkar Kepala)
            $table->json('imunisasi')->nullable(); // Kolom JSON untuk menyimpan data imunisasi
            $table->boolean('makanan_pokok')->nullable(); // Kolom 16: Makanan Pokok
            $table->boolean('makanan_protein_hewani')->nullable(); // Kolom 17: Makanan Protein Hewani
            $table->boolean('makanan_protein_nabati')->nullable(); // Kolom 18: Makanan Protein Nabati
            $table->boolean('sumber_lemak')->nullable(); // Kolom 19: Sumber Lemak
            $table->boolean('buah_sayur')->nullable(); // Kolom 20: Buah dan Sayur
            $table->boolean('ada_obat_cacing')->nullable(); // Kolom 21: Ada obat cacing
            $table->date('waktu_minum_obat_cacing')->nullable(); // Kolom 22: Waktu minum obat cacing
            $table->boolean('usia_6_11_bulan_kapsul_biru')->nullable(); // Kolom 23: Usia 6-11 bulan (kapsul biru)
            $table->boolean('usia_lebih_11_bulan_kapsul_merah')->nullable(); // Kolom 24: Usia >11 bulan (kapsul merah)
            $table->boolean('ada_mt_pangan_lokal')->nullable(); // Kolom 25: Ada MT Pangan Lokal
            $table->boolean('kepatuhan_mt_pangan_lokal')->nullable(); // Kolom 26: Kepatuhan konsumsi MT Pangan Lokal
            $table->string('pemberian_edukasi', 255)->nullable(); // Kolom 27: Pemberian Edukasi
            $table->string('paraf_ibu_balita', 255)->nullable(); // Kolom 28: Paraf Ibu Balita/Apras
            $table->date('waktu_kunjungan_tanda_bahaya')->nullable(); // Kolom 29: Waktu Kunjungan Tanda Bahaya
            $table->boolean('napas_sesak')->nullable(); // Kolom 30: Napas Sesak
            $table->boolean('batuk')->nullable(); // Kolom 31: Batuk
            $table->boolean('demam')->nullable(); // Kolom 32: Demam
            $table->boolean('diare')->nullable(); // Kolom 33: Diare
            $table->string('warna_kencing', 255)->nullable(); // Kolom 34: Warna Kencing
            $table->string('warna_kulit', 255)->nullable(); // Kolom 35: Warna Kulit
            $table->string('aktifitas', 255)->nullable(); // Kolom 36: Aktifitas
            $table->string('hisapan_bayi', 255)->nullable(); // Kolom 37: Hisapan Bayi
            $table->string('pemberian_makanan', 255)->nullable(); // Kolom 38: Pemberian Makanan
            $table->string('mengingatkan_periksa', 255)->nullable(); // Kolom 39: Mengingatkan Periksa
            $table->date('melaporkan_ke_nakes')->nullable(); // Kolom 40: Melaporkan ke Nakes

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kunjungan_rumah_balita_apras');
    }
};
