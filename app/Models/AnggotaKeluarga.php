<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnggotaKeluarga extends Model
{
    use HasFactory;

    
    // Field yang bisa diisi secara massal
    protected $fillable = [
        'keluarga_id',
        'nama_lengkap',
        'nik',
        'tanggal_lahir',
        'jenis_kelamin',
        'hubungan_kk', // Menambahkan hubungan KK
        'status_perkawinan', // Menambahkan status perkawinan
        'pendidikan_terakhir', // Menambahkan pendidikan terakhir
        'pekerjaan', // Menambahkan pekerjaan
        'kelompok_sasaran', // Menambahkan kelompok sasaran
    ];

    // Relasi ke model Keluarga
    public function keluarga()
    {
        return $this->belongsTo(Keluarga::class, 'keluarga_id');
    }
    // Di dalam model AnggotaKeluarga
    public function kunjunganIbuHamil()
    {
        return $this->hasOne(KunjunganIbuHamil::class, 'anggota_keluarga_id');
    }

    public function KunjunganIbuBersalinNifas()
    {
        return $this->hasOne(KunjunganIbuBersalinNifas::class, 'anggota_keluarga_id');
    }
    public function kunjunganBayi()
    {
        return $this->hasOne(KunjunganBayi::class,'anggota_keluarga_id');
    }
    public function KunjunganRumahBalitaApras()
    {
        return $this->hasOne(KunjunganRumahBalitaApras::class,'anggota_keluarga_id');
    }
    public function kunjunganRemaja()
    {
        return $this->hasOne(KunjunganRumahUsiaRemaja::class,'anggota_keluarga_id');
    }
    public function kunjunganLansia()
    {
        return $this->hasOne(KunjunganLansia::class,'anggota_keluarga_id');
    }
    public function KunjunganUsiaDewasa()
    {
        return $this->hasOne(KunjunganUsiaDewasa::class,'anggota_keluarga_id');
    }
    public function KunjunganTBC()
    {
        return $this->hasOne(KunjunganTBC::class,'anggota_keluarga_id');
    }
}
