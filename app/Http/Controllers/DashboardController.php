<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Keluarga;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil user yang sedang login
        $user = Auth::user();
        
        // Inisialisasi variabel jumlah dan persentase keluarga serta anggota
        $jumlahKeluarga = 0;
        $jumlahAnggotaKeluarga = 0;
        $persentaseKeluarga = 0;
        $persentaseAnggotaKeluarga = 0;

        // Hitung total keluarga dan anggota di seluruh sistem
        $totalKeluarga = Keluarga::count();
        $totalAnggotaKeluarga = Keluarga::with('anggotaKeluarga')->get()->sum(function($keluarga) {
            return $keluarga->anggotaKeluarga->count();
        });

        // Fungsi untuk menghitung kategori berdasarkan kelompok_sasaran
        $calculateCategory = function ($keluargas, $kategori) {
            return $keluargas->sum(function($keluarga) use ($kategori) {
                return $keluarga->anggotaKeluarga->where('kelompok_sasaran', $kategori)->count();
            });
        };

        // Jika user adalah 'admin', tampilkan seluruh data
        if ($user->hasRole('admin')) {
            $keluargas = Keluarga::with('anggotaKeluarga')
                        ->get();
            $jumlahKeluarga = $totalKeluarga;
            $jumlahAnggotaKeluarga = $totalAnggotaKeluarga;
            $persentaseKeluarga = 100;
            $persentaseAnggotaKeluarga = 100;
        }
        // Jika user adalah 'Kader', hanya tampilkan data yang terkait dengan id_user
        else if ($user->hasRole('Kader')) {
            $keluargas = Keluarga::with('anggotaKeluarga')
                        ->where('id_user', $user->id)
                        ->get();
            
            $jumlahKeluarga = $keluargas->count();
            $jumlahAnggotaKeluarga = $keluargas->sum(function($keluarga) {
                return $keluarga->anggotaKeluarga->count();
            });

            $persentaseKeluarga = ($totalKeluarga > 0) ? ($jumlahKeluarga / $totalKeluarga) * 100 : 0;
            $persentaseAnggotaKeluarga = ($totalAnggotaKeluarga > 0) ? ($jumlahAnggotaKeluarga / $totalAnggotaKeluarga) * 100 : 0;
        }
        // Jika user adalah 'Kader', hanya tampilkan data yang terkait dengan id_user
        else if ($user->hasRole('KetuaPosyandu')) {
            $keluargas = Keluarga::with('anggotaKeluarga')
                        ->where('pustu', $user->nama_posyandu)
                        ->get();
            
            $jumlahKeluarga = $keluargas->count();
            $jumlahAnggotaKeluarga = $keluargas->sum(function($keluarga) {
                return $keluarga->anggotaKeluarga->count();
            });

            $persentaseKeluarga = ($totalKeluarga > 0) ? ($jumlahKeluarga / $totalKeluarga) * 100 : 0;
            $persentaseAnggotaKeluarga = ($totalAnggotaKeluarga > 0) ? ($jumlahAnggotaKeluarga / $totalAnggotaKeluarga) * 100 : 0;
        }
        // Jika user adalah 'PetugasKesehatan', hanya tampilkan data berdasarkan kecamatan dan kelurahan
        else if ($user->hasRole('PetugasKesehatan')) {
            $keluargas = Keluarga::with('anggotaKeluarga')
                        ->where('kecamatan', $user->kecamatan)
                        ->get();
            
            $jumlahKeluarga = $keluargas->count();
            $jumlahAnggotaKeluarga = $keluargas->sum(function($keluarga) {
                return $keluarga->anggotaKeluarga->count();
            });

            $persentaseKeluarga = ($totalKeluarga > 0) ? ($jumlahKeluarga / $totalKeluarga) * 100 : 0;
            $persentaseAnggotaKeluarga = ($totalAnggotaKeluarga > 0) ? ($jumlahAnggotaKeluarga / $totalAnggotaKeluarga) * 100 : 0;
        }

        // Hitung kategori untuk masing-masing kelompok sasaran
        $jumlahIbuHamil = $calculateCategory($keluargas, 'Ibu Hamil');
        $jumlahIbuBersalinNifas = $calculateCategory($keluargas, 'Ibu Bersalin & Nifas');
        $jumlahBayiBalita = $calculateCategory($keluargas, 'Bayi - Balita (0-6 bulan)');
        $jumlahBayiApras = $calculateCategory($keluargas, 'Balita dan Apras (6 - 71 bulan)');
        $jumlahUsiaSekolahRemaja = $calculateCategory($keluargas, 'Usia Sekolah & Remaja');
        $jumlahUsiaDewasa = $calculateCategory($keluargas, 'Usia Dewasa (18-59 tahun)');
        $jumlahLansia = $calculateCategory($keluargas, 'Lansia (≥60 tahun)');

        // Hitung persentase untuk masing-masing kategori
        $persentaseIbuHamil = ($jumlahAnggotaKeluarga > 0) ? ($jumlahIbuHamil / $jumlahAnggotaKeluarga) * 100 : 0;
        $persentaseIbuBersalinNifas = ($jumlahAnggotaKeluarga > 0) ? ($jumlahIbuBersalinNifas / $jumlahAnggotaKeluarga) * 100 : 0;
        $persentaseBayiBalita = ($jumlahAnggotaKeluarga > 0) ? ($jumlahBayiBalita / $jumlahAnggotaKeluarga) * 100 : 0;
        $persentaseBayiApras = ($jumlahAnggotaKeluarga > 0) ? ($jumlahBayiApras / $jumlahAnggotaKeluarga) * 100 : 0;
        $persentaseUsiaSekolahRemaja = ($jumlahAnggotaKeluarga > 0) ? ($jumlahUsiaSekolahRemaja / $jumlahAnggotaKeluarga) * 100 : 0;
        $persentaseUsiaDewasa = ($jumlahAnggotaKeluarga > 0) ? ($jumlahUsiaDewasa / $jumlahAnggotaKeluarga) * 100 : 0;
        $persentaseLansia = ($jumlahAnggotaKeluarga > 0) ? ($jumlahLansia / $jumlahAnggotaKeluarga) * 100 : 0;

        // Kirim data ke view
        return view('dashboard', compact(
            'jumlahKeluarga', 'jumlahAnggotaKeluarga', 'persentaseKeluarga', 'persentaseAnggotaKeluarga',
            'jumlahIbuHamil', 'persentaseIbuHamil', 'jumlahIbuBersalinNifas', 'persentaseIbuBersalinNifas',
            'jumlahBayiBalita', 'persentaseBayiBalita', 'jumlahBayiApras', 'persentaseBayiApras',
            'jumlahUsiaSekolahRemaja', 'persentaseUsiaSekolahRemaja', 'jumlahUsiaDewasa', 'persentaseUsiaDewasa',
            'jumlahLansia', 'persentaseLansia'
        ));
    }
}
