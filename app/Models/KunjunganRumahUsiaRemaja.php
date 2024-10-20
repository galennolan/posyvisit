<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KunjunganRumahUsiaRemaja extends Model
{
    use HasFactory;
    // Define the table name if it's not default ('kunjungan_rumah_usia_remaja')
    protected $table = 'kunjungan_rumah_usia_sekolah_remaja';

    // Add fillable fields to allow mass assignment
    protected $fillable = [
        'anggota_keluarga_id',
        'waktu_kunjungan',
        'tanggal_kunjungan',
        'suhu_tubuh',
        'tanggal_terakhir_menimbang_mengukur',
        'isi_piringku',
        'bb',
        'tb',
        'lp',
        'ada_ttd',
        'minum_ttd',
        'tanggal_pemeriksaan_1',
        'tempat_pemeriksaan_1',
        'hasil_pemeriksaan_1',
        'perilaku_merokok',
        'tanggal_pemeriksaan_gula',
        'tempat_pemeriksaan_gula',
        'hasil_pemeriksaan_gula',
        'tanggal_pemeriksaan_tekanan',
        'tempat_pemeriksaan_tekanan',
        'hasil_pemeriksaan_tekanan',
        'tanggal_skrining_jiwa',
        'tempat_skrining_jiwa',
        'hasil_skrining_jiwa',
        'pemberian_edukasi',
        'paraf_remaja',
    ];
    public function anggotaKeluarga()
    {
        return $this->belongsTo(AnggotaKeluarga::class, 'anggota_keluarga_id');
    }
}
