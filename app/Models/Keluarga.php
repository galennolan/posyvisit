<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keluarga extends Model
{
     
    use HasFactory;
    protected $fillable = [
        'tanggal_pengumpulan_data', // tambahkan field ini
        'alamat',
        'no_handphone',
        'kecamatan',
        'kelurahan',
        'puskesmas',
        'pustu',
        'provinsi',
        'id_user', // Pastikan ini ada
    ];
    public function anggotaKeluarga()
    {
        return $this->hasMany(AnggotaKeluarga::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
