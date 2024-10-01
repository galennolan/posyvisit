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
}
