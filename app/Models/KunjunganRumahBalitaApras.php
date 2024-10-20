<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KunjunganRumahBalitaApras extends Model
{
    use HasFactory;

    protected $table = 'kunjungan_rumah_balita_apras';

    // Kolom yang dapat diisi
    protected $fillable = [
        'anggota_keluarga_id',
        'waktu_kunjungan',
        'tanggal',
        'suhu_tubuh',
        'ada_buku_kia',
        'tanggal_terakhir_menimbang_mengukur',
        'hasil_penimbangan',
        'bb',
        'pb_tb',
        'lk',
        'imunisasi',
        'makanan_pokok',
        'makanan_protein_hewani',
        'makanan_protein_nabati',
        'sumber_lemak',
        'buah_sayur',
        'ada_obat_cacing',
        'waktu_minum_obat_cacing',
        'usia_6_11_bulan_kapsul_biru',
        'usia_lebih_11_bulan_kapsul_merah',
        'ada_mt_pangan_lokal',
        'kepatuhan_mt_pangan_lokal',
        'pemberian_edukasi',
        'paraf_ibu_balita',
        'waktu_kunjungan_tanda_bahaya',
        'napas_sesak',
        'batuk',
        'demam',
        'diare',
        'warna_kencing',
        'warna_kulit',
        'aktifitas',
        'hisapan_bayi',
        'pemberian_makanan',
        'mengingatkan_periksa',
        'melaporkan_ke_nakes',
    ];
    // Casting kolom 'imunisasi' ke bentuk array
    protected $casts = [
        'imunisasi' => 'array',
    ];
    public function anggotaKeluarga()
    {
        return $this->belongsTo(AnggotaKeluarga::class, 'anggota_keluarga_id');
    }
}
