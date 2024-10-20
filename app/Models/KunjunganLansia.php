<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KunjunganLansia extends Model
{
    use HasFactory;

    protected $table = 'kunjungan_lansia';

    protected $fillable = [
        'anggota_keluarga_id',
        'tanggal',
        'suhu_tubuh',
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
        'aks_tanggal',
        'aks_tempat',
        'skilas_tanggal',
        'skilas_tempat',
        'perilaku_merokok',
        'skrining_kesehatan_jiwa_tanggal',
        'skrining_kesehatan_jiwa_tempat',
        'skrining_kesehatan_jiwa_petugas',
        'pemberian_edukasi',
        'paraf_lansia',
    ];

    protected $casts = [
        'ada_obat_hipertensi' => 'string',
        'sudah_minum_obat_hipertensi' => 'string',
        'ada_obat_dm' => 'string',
        'sudah_minum_obat_dm' => 'string',
        'perilaku_merokok' => 'string',
    ];
    public function anggotaKeluarga()
    {
        return $this->belongsTo(AnggotaKeluarga::class, 'anggota_keluarga_id');
    }
}
