<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KunjunganIbuHamil extends Model
{
    use HasFactory;

    protected $table = 'kunjungan_ibu_hamil';

    protected $fillable = [
        'anggota_keluarga_id',
        'umur',
        'kehamilan_ke',
        'jarak_kehamilan',
        'buku_kia',
        'waktu_kunjungan',
        'tanggal_kunjungan',
        'suhu_tubuh',
        'buku_kia_ditunjukkan',
        'k1',
        'k2',
        'k3',
        'k4',
        'k5',
        'k6',
        'isi_piringku',
        'ttd',
        'ttd_ditunjukkan',
        'ttd_dikonsumsi',
        'lila',
        'pmt_bumil_kek',
        'kelas_ibu_hamil',
        'skrining_jiwa',
        'edukasi',
        'paraf'
    ];

    protected $casts = [
        'k1' => 'array',
        'k2' => 'array',
        'k3' => 'array',
        'k4' => 'array',
        'k5' => 'array',
        'k6' => 'array',
        'kelas_ibu_hamil' => 'array',
        'skrining_jiwa' => 'array',
        'edukasi' => 'array',
    ];

    public function anggotaKeluarga()
    {
        return $this->belongsTo(AnggotaKeluarga::class, 'anggota_keluarga_id');
    }
}
