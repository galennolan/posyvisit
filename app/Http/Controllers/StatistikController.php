<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Keluarga;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class StatistikController extends Controller
{
    public function index(Request $request)
    {
        // Ambil user yang sedang login
        $user = Auth::user();
        
        // Inisialisasi filter kecamatan, kelurahan, dan posyandu dari input request
        $kecamatan = $request->input('kecamatan', 'all');
        $kelurahan = $request->input('kelurahan', 'all');
        $posyandu = $request->input('posyandu', 'all');

        // Inisialisasi variabel untuk dropdown posyandu dan kecamatan
        $posyandus = [];
        $kecamatans = [];

        // Jika user adalah PetugasKesehatan, hanya tampilkan kecamatannya
        if ($user->hasRole('PetugasKesehatan')) {
            $kecamatans = [$user->kecamatan];
        } else {
            // Tampilkan semua kecamatan jika bukan PetugasKesehatan
            $kecamatans = ['Banjarsari', 'Jebres', 'Laweyan', 'Pasar Kliwon', 'Serengan'];
        }

        // Jika user adalah KetuaPosyandu, hanya tampilkan posyandunya
        if ($user->hasRole('KetuaPosyandu')) {
            $posyandus = [$user->nama_posyandu];
        } elseif ($user->hasRole('admin')) {
            // Untuk admin, tampilkan semua kecamatan
            $kecamatans = ['Banjarsari', 'Jebres', 'Laweyan', 'Pasar Kliwon', 'Serengan'];
        }else {
            // Ambil semua posyandu yang ada di tabel User jika bukan KetuaPosyandu
            $posyandus = User::select('nama_posyandu')->distinct()->pluck('nama_posyandu');
        }

        // Query untuk mengambil data Keluarga sesuai filter
        $query = Keluarga::with('anggotaKeluarga');

        // Filter data berdasarkan input user
        if ($kecamatan !== 'all') {
            $query->where('kecamatan', $kecamatan);
        }

        if ($kelurahan !== 'all') {
            $query->where('kelurahan', $kelurahan);
        }else {
            // Jika tidak ada kelurahan yang dipilih, ambil semua kelurahan di kecamatan yang dipilih
            if ($kecamatan !== 'all') {
                // Ambil hanya kelurahan yang sesuai dengan kecamatan yang dipilih
                $kelurahans = Keluarga::where('kecamatan', $kecamatan)
                    ->select('kelurahan')->distinct()->pluck('kelurahan');
        }}

        if ($posyandu !== 'all') {
            $query->where('pustu', $posyandu);
        }

        // Filter tambahan berdasarkan role user yang login
        if ($user->hasRole('Kader')) {
            $query->where('pustu', $user->nama_posyandu);
        } elseif ($user->hasRole('PetugasKesehatan')) {
            $query->where('kecamatan', $user->kecamatan);
        }

        // Ambil data Keluarga yang sudah difilter
        $keluargas = $query->get();

        // Hitung statistik
        $statistik = [
            'jumlahKeluarga' => $keluargas->count(),
            'jumlahAnggotaKeluarga' => $keluargas->sum(function ($keluarga) {
                return $keluarga->anggotaKeluarga->count();
            })
        ];

         // Fungsi untuk menghitung kategori berdasarkan kelompok_sasaran
         $calculateCategory = function ($keluargas, $kategori) {
            return $keluargas->sum(function($keluarga) use ($kategori) {
                return $keluarga->anggotaKeluarga->where('kelompok_sasaran', $kategori)->count();
            });
        };

        // Hitung kategori untuk masing-masing kelompok sasaran
        $jumlahIbuHamil = $calculateCategory($keluargas, 'Ibu Hamil');
        $jumlahIbuBersalinNifas = $calculateCategory($keluargas, 'Ibu Bersalin & Nifas');
        $jumlahBayiBalita = $calculateCategory($keluargas, 'Bayi - Balita (0-6 bulan)');
        $jumlahBayiApras = $calculateCategory($keluargas, 'Balita dan Apras (6 - 71 bulan)');
        $jumlahUsiaSekolahRemaja = $calculateCategory($keluargas, 'Usia Sekolah & Remaja');
        $jumlahUsiaDewasa = $calculateCategory($keluargas, 'Usia Dewasa (18-59 tahun)');
        $jumlahLansia = $calculateCategory($keluargas, 'Lansia (≥60 tahun)');

        // Tambahkan ke array statistik
        $statistik['jumlahIbuHamil'] = $jumlahIbuHamil;
        $statistik['jumlahIbuBersalinNifas'] = $jumlahIbuBersalinNifas;
        $statistik['jumlahBayiBalita'] = $jumlahBayiBalita;
        $statistik['jumlahBayiApras'] = $jumlahBayiApras;
        $statistik['jumlahUsiaSekolahRemaja'] = $jumlahUsiaSekolahRemaja;
        $statistik['jumlahUsiaDewasa'] = $jumlahUsiaDewasa;
        $statistik['jumlahLansia'] = $jumlahLansia;

        // Tampilkan view statistik dengan data yang sudah difilter
        return view('statistik', compact('statistik', 'kecamatans', 'posyandus', 'kecamatan', 'kelurahan', 'posyandu'));
    }

}
