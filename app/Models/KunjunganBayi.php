<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KunjunganBayi extends Model
{
    use HasFactory;

    // Tentukan tabel yang akan digunakan oleh model ini
    protected $table = 'kunjungan_bayi';

    // Tentukan kolom yang dapat diisi secara massal
    protected $fillable = [
        'anggota_keluarga_id',
        'tanggal_kunjungan',
        'tempat_lahir',
        'pemantauan_suhu_tubuh',
        'ada_buku_kia',
        'asi_eksklusif',
        'tanggal_terakhir_ditimbang',
        'tempat_penimbangan',
        'petugas_penimbangan',
        'berat_badan',
        'panjang_badan',
        'lingkar_kepala',
        'pelayanan_neonatal_essensial_0_6_jam',
        'tempat_pelayanan_neonatal_0_6_jam',
        'petugas_pelayanan_neonatal_0_6_jam',
        'kn1_6_48_jam',
        'tempat_kn1',
        'petugas_kn1',
        'kn2_3_7_hari',
        'tempat_kn2',
        'petugas_kn2',
        'kn3_8_28_hari',
        'tempat_kn3',
        'petugas_kn3',
        'hepatitis_b_0_bulan',
        'bcg_0_bulan',
        'polio_tetes_1_0_bulan',
        'bcg_1_bulan',
        'polio_tetes_1_1_bulan',
        'dpt_hb_hib_1_2_bulan',
        'polio_tetes_2_2_bulan',
        'pcv_1_2_bulan',
        'rv_1_2_bulan',
        'dpt_hb_hib_2_3_bulan',
        'polio_tetes_3_3_bulan',
        'pcv_2_3_bulan',
        'rv_2_3_bulan',
        'dpt_hb_hib_3_4_bulan',
        'polio_tetes_4_4_bulan',
        'polio_suntik_4_bulan',
        'rv_3_4_bulan',
        'napas',
        'aktifitas',
        'warna_kulit',
        'hisapan_bayi',
        'kejang',
        'suhu_tubuh_tanda_bahaya',
        'bab',
        'jumlah_warna_air_kencing',
        'tali_pusat',
        'mata',
        'kulit_tanda_bahaya',
        'imunisasi_tanda_bahaya',
        'mengingatkan_periksa_pustu',
        'melaporkan_ke_nakes',
    ];

    // Relasi dengan model AnggotaKeluarga
    public function anggotaKeluarga()
    {
        return $this->belongsTo(AnggotaKeluarga::class, 'anggota_keluarga_id');
    }
}
