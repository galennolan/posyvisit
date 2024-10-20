<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KunjunganTBC extends Model
{
    use HasFactory;

    protected $table = 'kunjungan_tbc';

    protected $fillable = [
        'anggota_keluarga_id',
        'tanggal',
        'batuk_terus_menerus',
        'demam_lebih_dari_dua_minggu',
        'bb_tidak_naik_turun_dua_bulan',
        'kontak_erat_pasien_tbc',
        'terdiagnosa_tbc_tanggal',
        'terdiagnosa_tbc_tempat',
        'pemeriksaan_terakhir',
        'ada_obat_tbc',
        'sudah_minum_obat_hari_ini',
        'pengawas_minum_obat_pmo',
        'perilaku_merokok',
        'pemberian_edukasi',
        'mengingatkan_periksa_pustu_fasyankes',
        'melaporkan_ke_nakes',
        'paraf_terduga_pasien_tbc',
    ];

    protected $casts = [
        'terdiagnosa_tbc_tanggal' => 'date',
        'pemeriksaan_terakhir' => 'date',
    ];

    // Optional: Define accessors or mutators if needed
    // For example, to ensure dates are always in a specific format
    protected function terdiagnosaTbcTanggalAttribute($value)
    {
        return $value ? Carbon::parse($value) : null;
    }

    protected function pemeriksaanTerakhirAttribute($value)
    {
        return $value ? Carbon::parse($value) : null;
    }

    public function anggotaKeluarga()
    {
        return $this->belongsTo(AnggotaKeluarga::class, 'anggota_keluarga_id');
    }
}