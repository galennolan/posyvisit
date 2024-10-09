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

        // Cek apakah user adalah admin
        if ($user->hasRole('admin')) {
            // Jika admin, ambil semua data keluarga beserta anggotanya
            $keluargas = Keluarga::with('anggotaKeluarga')->get();
            $jumlahKeluarga = $keluargas->count();
            $jumlahAnggotaKeluarga = $keluargas->sum(function($keluarga) {
                return $keluarga->anggotaKeluarga->count();
            });
            $persentaseKeluarga = 100; // Admin melihat 100%
            $persentaseAnggotaKeluarga = 100; // Admin melihat 100%
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
                $namaPosyandu = $posyandu ? $posyandu->nama : null; // Ambil nama posyandu
            }
        } else if ($user->hasRole('PetugasKesehatan')) {
            // Jika bukan admin, hanya ambil data keluarga sesuai dengan kelurahan user
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
            $kecamatan = $user->kecamatan; // Ambil nama kecamatan pengguna
        } else {
            // Jika tidak memiliki role yang tepat, tampilkan data kosong
            $keluargas = collect([]);
        }

        // Kirim data ke view
        return view('dashboard', compact('jumlahKeluarga', 'jumlahAnggotaKeluarga', 'persentaseKeluarga', 'persentaseAnggotaKeluarga', 'namaPosyandu', 'kecamatan'));
    }
}
