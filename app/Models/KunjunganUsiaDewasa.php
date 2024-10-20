<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class KunjunganUsiaDewasa extends Model
{
    use HasFactory;
    protected $table = 'kunjungan_usia_dewasa';

    protected $fillable = [
        'anggota_keluarga_id',
        'riwayat_penyakit_keluarga',
        'tanggal_kunjungan',
        'suhu_tubuh',
        'isi_piringku',
        'pemeriksaan_tekanan_darah_tahun_terakhir',
        'tempat_pemeriksaan_tekanan_darah_tahun_terakhir',
        'hasil_pemeriksaan_tekanan_darah_tahun_terakhir',
        'terdiagnosa_hipertensi_tahun_terakhir',
        'pemeriksaan_tekanan_darah_bulan_terakhir',
        'tempat_pemeriksaan_tekanan_darah_bulan_terakhir',
        'hasil_pemeriksaan_tekanan_darah_bulan_terakhir',
        'ada_obat_hipertensi',
        'sudah_minum_obat_hipertensi',
        'pemeriksaan_gula_darah_tahun_terakhir',
        'tempat_pemeriksaan_gula_darah_tahun_terakhir',
        'hasil_pemeriksaan_gula_darah_tahun_terakhir',
        'terdiagnosa_diabetes_melitus_tahun_terakhir',
        'pemeriksaan_gula_darah_bulan_terakhir',
        'tempat_pemeriksaan_gula_darah_bulan_terakhir',
        'hasil_pemeriksaan_gula_darah_bulan_terakhir',
        'ada_obat_dm',
        'sudah_minum_obat_dm',
        'perilaku_merokok',
        'kontrasepsi',
        'skrining_kesehatan_jiwa',
        'tempat_skrining_kesehatan_jiwa',
        'petugas_skrining_kesehatan_jiwa',
        'pemberian_edukasi',
        'paraf_usia_dewasa',
    ];

    protected $casts = [
        'riwayat_penyakit_keluarga' => 'array',
        'kontrasepsi' => 'array',
    ];

    public function anggotaKeluarga()
    {
        return $this->belongsTo(AnggotaKeluarga::class, 'anggota_keluarga_id');
    }

}
