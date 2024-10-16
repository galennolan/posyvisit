<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KunjunganIbuBersalinNifas extends Model
{
    use HasFactory;
    protected $table = 'kunjungan_ibu_bersalin_nifas';

    protected $fillable = [
        'anggota_keluarga_id',
        'nama_ibu',
        'umur_ibu',
        'tanggal_persalinan',
        'usia_kehamilan_saat_persalinan',
        'kelahiran_anak_ke',
        'pukul_persalinan',
        'penolong_persalinan',
        'tempat_persalinan',
        'keadaan_ibu',
        'inisiasi_menyusu_dini',
    ];

    public function anggotaKeluarga()
    {
        return $this->belongsTo(AnggotaKeluarga::class, 'anggota_keluarga_id');
    }

}
