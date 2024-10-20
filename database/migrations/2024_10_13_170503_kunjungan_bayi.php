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
        Schema::create('kunjungan_bayi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('anggota_keluarga_id')->constrained('anggota_keluargas')->onDelete('cascade');
            
            // Tanggal kunjungan
            $table->date('tanggal_kunjungan');  // Tanggal kunjungan

            // Pemantauan suhu tubuh
            $table->enum('pemantauan_suhu_tubuh', ['<37.5 C', '>=36.5 C']);  // Pilih suhu tubuh
            
            // Ada Buku KIA
            $table->enum('ada_buku_kia', ['Ada', 'Tidak']);  // Ada Buku KIA
            
            // ASI Eksklusif
            $table->enum('asi_eksklusif', ['Ada', 'Tidak']);  // ASI Eksklusif

            // Tanggal Terakhir ditimbang dan diukur
            $table->date('tanggal_terakhir_ditimbang')->nullable();  // Tanggal terakhir ditimbang
            $table->string('tempat_penimbangan')->nullable();  // Tempat penimbangan
            $table->string('petugas_penimbangan')->nullable();  // Petugas penimbangan
            
            // Hasil Penimbangan dan Pengukuran
            $table->float('berat_badan')->nullable();  // Berat Badan
            $table->float('panjang_badan')->nullable();  // Panjang Badan
            $table->float('lingkar_kepala')->nullable();  // Lingkar Kepala

            // Kunjungan pemeriksaan bayi setelah lahir (0-28 hari)
            $table->date('pelayanan_neonatal_essensial_0_6_jam')->nullable();  // Tanggal pelayanan esensial 0-6 jam
            $table->string('tempat_pelayanan_neonatal_0_6_jam')->nullable();  // Tempat pelayanan
            $table->string('petugas_pelayanan_neonatal_0_6_jam')->nullable();  // Petugas pelayanan

            $table->date('kn1_6_48_jam')->nullable();  // KN 1 (6-48 jam)
            $table->string('tempat_kn1')->nullable();  // Tempat KN 1
            $table->string('petugas_kn1')->nullable();  // Petugas KN 1

            $table->date('kn2_3_7_hari')->nullable();  // KN 2 (3-7 hari)
            $table->string('tempat_kn2')->nullable();  // Tempat KN 2
            $table->string('petugas_kn2')->nullable();  // Petugas KN 2

            $table->date('kn3_8_28_hari')->nullable();  // KN 3 (8-28 hari)
            $table->string('tempat_kn3')->nullable();  // Tempat KN 3
            $table->string('petugas_kn3')->nullable();  // Petugas KN 3

            // Imunisasi
            $table->enum('hepatitis_b_0_bulan', ['Ya', 'Tidak'])->nullable();  // Imunisasi Hepatitis B (Usia 0 Bulan)
            $table->enum('bcg_0_bulan', ['Ya', 'Tidak'])->nullable();  // Imunisasi BCG (Usia 0 Bulan)
            $table->enum('polio_tetes_1_0_bulan', ['Ya', 'Tidak'])->nullable();  // Polio Tetes 1 (Usia 0 Bulan)

            $table->enum('bcg_1_bulan', ['Ya', 'Tidak'])->nullable();  // Imunisasi BCG (Usia 1 Bulan)
            $table->enum('polio_tetes_1_1_bulan', ['Ya', 'Tidak'])->nullable();  // Polio Tetes 1 (Usia 1 Bulan)

            $table->enum('dpt_hb_hib_1_2_bulan', ['Ya', 'Tidak'])->nullable();  // DPT-HB-Hib 1 (Usia 2 Bulan)
            $table->enum('polio_tetes_2_2_bulan', ['Ya', 'Tidak'])->nullable();  // Polio Tetes 2 (Usia 2 Bulan)
            $table->enum('pcv_1_2_bulan', ['Ya', 'Tidak'])->nullable();  // PCV 1 (Usia 2 Bulan)
            $table->enum('rv_1_2_bulan', ['Ya', 'Tidak'])->nullable();  // RV 1 (Usia 2 Bulan)

            $table->enum('dpt_hb_hib_2_3_bulan', ['Ya', 'Tidak'])->nullable();  // DPT-HB-Hib 2 (Usia 3 Bulan)
            $table->enum('polio_tetes_3_3_bulan', ['Ya', 'Tidak'])->nullable();  // Polio Tetes 3 (Usia 3 Bulan)
            $table->enum('pcv_2_3_bulan', ['Ya', 'Tidak'])->nullable();  // PCV 2 (Usia 3 Bulan)
            $table->enum('rv_2_3_bulan', ['Ya', 'Tidak'])->nullable();  // RV 2 (Usia 3 Bulan)

            $table->enum('dpt_hb_hib_3_4_bulan', ['Ya', 'Tidak'])->nullable();  // DPT-HB-Hib 3 (Usia 4 Bulan)
            $table->enum('polio_tetes_4_4_bulan', ['Ya', 'Tidak'])->nullable();  // Polio Tetes 4 (Usia 4 Bulan)
            $table->enum('polio_suntik_4_bulan', ['Ya', 'Tidak'])->nullable();  // Polio Suntik (IPV) 1 (Usia 4 Bulan)
            $table->enum('rv_3_4_bulan', ['Ya', 'Tidak'])->nullable();  // RV 3 (Usia 4 Bulan)

            // Tanda bahaya pada bayi 0-2 Bulan
            $table->date('tanggal_laporan_tanda_bahaya')->nullable();  // Tanggal laporan tanda bahaya
            $table->enum('napas', ['Ya', 'Tidak']);  // Napas bayi
            $table->enum('aktifitas', ['Ya', 'Tidak']);  // Aktivitas bayi
            $table->enum('warna_kulit', ['Ya', 'Tidak']);  // Warna kulit bayi
            $table->enum('hisapan_bayi', ['Ya', 'Tidak']);  // Hisapan bayi
            $table->enum('kejang', ['Ya', 'Tidak']);  // Kejang
            $table->enum('suhu_tubuh_tanda_bahaya', ['Ya', 'Tidak']);  // Suhu tubuh bayi (tanda bahaya)
            $table->enum('bab', ['Ya', 'Tidak']);  // Buang Air Besar (BAB)
            $table->enum('jumlah_warna_air_kencing', ['Ya', 'Tidak']);  // Jumlah dan warna air kencing
            $table->enum('tali_pusat', ['Ya', 'Tidak']);  // Tali pusat bayi
            $table->enum('mata', ['Ya', 'Tidak']);  // Mata bayi
            $table->enum('kulit_tanda_bahaya', ['Ya', 'Tidak']);  // Kulit bayi (tanda bahaya)
            $table->enum('imunisasi_tanda_bahaya', ['Ya', 'Tidak']);  // Imunisasi (tanda bahaya)
            $table->enum('mengingatkan_periksa_pustu', ['Ya', 'Tidak']);  // Mengingatkan periksa ke Pustu/Fasyankes
            $table->date('melaporkan_ke_nakes')->nullable();  // Tanggal laporan ke Nakes

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('kunjungan_bayi');
    }
};
