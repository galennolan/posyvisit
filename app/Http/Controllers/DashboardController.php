<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Keluarga; // Pastikan untuk mengimpor model Keluarga
use App\Models\Posyandu; // Pastikan untuk mengimpor model Posyandu

class DashboardController extends Controller
{
   public function index()
{
    // Ambil user yang sedang login
    $user = Auth::user();

    // Inisialisasi jumlah keluarga, jumlah anggota, nama posyandu, dan kecamatan
    $jumlahKeluarga = 0;
    $jumlahAnggotaKeluarga = 0;
    $persentaseKeluarga = 0;
    $persentaseAnggotaKeluarga = 0;
    $namaPosyandu = null; // Variabel untuk menyimpan nama posyandu
    $kecamatan = null; // Variabel untuk menyimpan nama kecamatan

    // Ambil total jumlah keluarga dan anggota
    $totalKeluarga = Keluarga::count();
    $totalAnggotaKeluarga = Keluarga::with('anggotaKeluarga')->get()->sum(function($keluarga) {
        return $keluarga->anggotaKeluarga->count();
    });

    // Hitung jumlah berdasarkan kategori
    $jumlahIbuHamil = Keluarga::with('anggotaKeluarga')->whereHas('anggotaKeluarga', function ($query) {
        $query->where('kelompok_sasaran', 'Ibu Hamil');
    })->count();

    $jumlahIbuBersalinNifas = Keluarga::with('anggotaKeluarga')->whereHas('anggotaKeluarga', function ($query) {
        $query->where('kelompok_sasaran', 'Ibu Bersalin & Nifas');
    })->count();

    $jumlahBayiBalita = Keluarga::with('anggotaKeluarga')->whereHas('anggotaKeluarga', function ($query) {
        $query->where('kelompok_sasaran', 'Bayi - Balita (0-6 bulan)');
    })->count();

    $jumlahUsiaSekolahRemaja = Keluarga::with('anggotaKeluarga')->whereHas('anggotaKeluarga', function ($query) {
        $query->where('kelompok_sasaran', 'Usia Sekolah & Remaja (≥6 - <18 tahun)');
    })->count();

    $jumlahUsiaDewasa = Keluarga::with('anggotaKeluarga')->whereHas('anggotaKeluarga', function ($query) {
        $query->where('kelompok_sasaran', 'Usia Dewasa (≥18-59 tahun)');
    })->count();

    $jumlahLansia = Keluarga::with('anggotaKeluarga')->whereHas('anggotaKeluarga', function ($query) {
        $query->where('kelompok_sasaran', 'Lansia (≥60 tahun)');
    })->count();

    // Hitung persentase masing-masing kategori
    $persentaseIbuHamil = ($totalAnggotaKeluarga > 0) ? ($jumlahIbuHamil / $totalAnggotaKeluarga) * 100 : 0;
    $persentaseIbuBersalinNifas = ($totalAnggotaKeluarga > 0) ? ($jumlahIbuBersalinNifas / $totalAnggotaKeluarga) * 100 : 0;
    $persentaseBayiBalita = ($totalAnggotaKeluarga > 0) ? ($jumlahBayiBalita / $totalAnggotaKeluarga) * 100 : 0;
    $persentaseUsiaSekolahRemaja = ($totalAnggotaKeluarga > 0) ? ($jumlahUsiaSekolahRemaja / $totalAnggotaKeluarga) * 100 : 0;
    $persentaseUsiaDewasa = ($totalAnggotaKeluarga > 0) ? ($jumlahUsiaDewasa / $totalAnggotaKeluarga) * 100 : 0;
    $persentaseLansia = ($totalAnggotaKeluarga > 0) ? ($jumlahLansia / $totalAnggotaKeluarga) * 100 : 0;

    // Cek apakah user adalah admin
    if ($user->hasRole('admin')) {
        $jumlahKeluarga = $totalKeluarga;
        $jumlahAnggotaKeluarga = $totalAnggotaKeluarga;
        $persentaseKeluarga = 100;
        $persentaseAnggotaKeluarga = 100;
    } else if ($user->hasRole('Kader')) {
        // Ambil data keluarga berdasarkan kecamatan dan kelurahan pengguna
        $keluargas = Keluarga::with('anggotaKeluarga')
            ->whereHas('user', function ($query) use ($user) {
                $query->where('kecamatan', '=', $user->kecamatan)
                    ->where('kelurahan', '=', $user->kelurahan);
            })->get();
        $jumlahKeluarga = $keluargas->count();
        $jumlahAnggotaKeluarga = $keluargas->sum(function($keluarga) {
            return $keluarga->anggotaKeluarga->count();
        });
        $persentaseKeluarga = ($totalKeluarga > 0) ? ($jumlahKeluarga / $totalKeluarga) * 100 : 0;
        $persentaseAnggotaKeluarga = ($totalAnggotaKeluarga > 0) ? ($jumlahAnggotaKeluarga / $totalAnggotaKeluarga) * 100 : 0;

        // Ambil nama posyandu berdasarkan user
        if ($user->posyandu_id) {
            $posyandu = Posyandu::find($user->posyandu_id);
            $namaPosyandu = $posyandu ? $posyandu->nama : null;
        }
    } else if ($user->hasRole('PetugasKesehatan')) {
        $keluargas = Keluarga::with('anggotaKeluarga')
            ->whereHas('user', function ($query) use ($user) {
                $query->where('kecamatan', $user->kecamatan)
                      ->where('kelurahan', $user->kelurahan);
            })->get();
        $jumlahKeluarga = $keluargas->count();
        $jumlahAnggotaKeluarga = $keluargas->sum(function($keluarga) {
            return $keluarga->anggotaKeluarga->count();
        });
        $persentaseKeluarga = ($totalKeluarga > 0) ? ($jumlahKeluarga / $totalKeluarga) * 100 : 0;
        $persentaseAnggotaKeluarga = ($totalAnggotaKeluarga > 0) ? ($jumlahAnggotaKeluarga / $totalAnggotaKeluarga) * 100 : 0;

        // Ambil nama kecamatan
        $kecamatan = $user->kecamatan;
    }

    // Kirim data ke view
    return view('dashboard', compact(
        'jumlahKeluarga', 'jumlahAnggotaKeluarga', 'persentaseKeluarga', 'persentaseAnggotaKeluarga', 'namaPosyandu', 'kecamatan',
        'jumlahIbuHamil', 'persentaseIbuHamil', 'jumlahIbuBersalinNifas', 'persentaseIbuBersalinNifas',
        'jumlahBayiBalita', 'persentaseBayiBalita', 'jumlahUsiaSekolahRemaja', 'persentaseUsiaSekolahRemaja',
        'jumlahUsiaDewasa', 'persentaseUsiaDewasa', 'jumlahLansia', 'persentaseLansia'
    ));
}

}
