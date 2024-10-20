<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KunjunganRumahUsiaRemaja extends Model
{
    use HasFactory;
    // Define the table name if it's not default ('kunjungan_rumah_usia_remaja')
    protected $table = 'kunjungan_rumah_usia_remaja';

    // Add fillable fields to allow mass assignment
    protected $fillable = [
        'nama',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'waktu_kunjungan',
        'tanggal_kunjungan',
        'suhu_tubuh',
        'tanggal_terakhir_menimbang_mengukur',
        'isi_piringku',
        'bb',
        'tb',
        'ada_ttd',
        'minum_ttd',
        'tanggal_pemeriksaan_anemia',
        'perilaku_merokok',
        'tekanan_darah_tanggal',
        'gula_darah_tanggal',
        'skring_kesehatan_jiwa_tanggal',
        'pemberian_edukasi',
        'paraf_remaja',
    ];
    public function anggotaKeluarga()
    {
        return $this->belongsTo(AnggotaKeluarga::class, 'anggota_keluarga_id');
    }
}
