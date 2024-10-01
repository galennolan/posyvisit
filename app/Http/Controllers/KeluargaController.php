<?php
namespace App\Http\Controllers;

use App\Models\Keluarga;
use App\Models\AnggotaKeluarga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; // Import Log facade

class KeluargaController extends Controller
{
    public function index()
    {
        // Ambil semua data keluarga beserta anggota keluarganya
        $keluargas = Keluarga::with('anggotaKeluarga')->get();

        // Kirim data ke view
        return view('keluarga.index', compact('keluargas'));
    }

    public function create()
    {
        // Menampilkan view form input keluarga
        return view('keluarga.create');
    }

    public function show($id)
    {
        // Ambil data keluarga berdasarkan ID beserta anggota keluarganya
        $keluarga = Keluarga::with('anggotaKeluarga')->findOrFail($id);

        // Kembalikan tampilan partial view dengan detail keluarga untuk modal
        return view('keluarga.detail', compact('keluarga'));
    }

    public function store(Request $request)
    {
         // Log sebelum validasi
    Log::info('Data keluarga diterima sebelum validasi:', ['request' => $request->all()]);
        // Validasi data keluarga secara umum terlebih dahulu
        $validatedKeluarga = $request->validate([
            'tanggal_pengumpulan_data' => 'required|date',
            'alamat' => 'required|string|max:255',
            'no_handphone' => 'required|digits_between:10,15',
            'kabupaten' => 'required|string|max:100',
            'kecamatan' => 'required|string|max:100',
            'kelurahan' => 'required|string|max:100',
            'puskesmas' => 'nullable|string|max:100',
            'pustu' => 'nullable|string|max:100',
            'provinsi' => 'required|string|max:100',
        ]);
        // Log setelah validasi keluarga
    Log::info('Data keluarga yang sudah divalidasi:', ['validatedKeluarga' => $validatedKeluarga]);

        // Simpan data keluarga
        $keluarga = Keluarga::create($validatedKeluarga);
    
        // Log sebelum validasi anggota keluarga
      Log::info('Data anggota keluarga diterima sebelum validasi:', ['request' => $request->all()]);

        // Validasi semua data anggota keluarga sekaligus
        $validatedAnggota = $request->validate([
            'anggota.*.nama_lengkap' => 'required|string|max:255',
            'anggota.*.nik' => 'required|digits:16|unique:anggota_keluargas,nik',
            'anggota.*.tanggal_lahir' => 'required|date|before:today',
            'anggota.*.jenis_kelamin' => 'required|in:Laki-Laki,Perempuan',
            'anggota.*.hubungan_kk' => 'required|in:1,2,3,4,5,6,7,8,9',
            'anggota.*.status_perkawinan' => 'required|in:1,2,3,4',
            'anggota.*.pendidikan_terakhir' => 'required|in:1,2,3,4,5,6',
            'anggota.*.pekerjaan' => 'required|in:1,2,3,4,5,6,7',
            'anggota.*.kelompok_sasaran' => 'required|in:Ibu Hamil,Ibu Bersalin & Nifas,Bayi - Balita (0-6 tahun),Usia Sekolah & Remaja (≥6 - <18 tahun),Usia Dewasa (≥18-59 tahun),Lansia (≥60 tahun)',
        ]);
    // Log setelah validasi anggota keluarga
    Log::info('Data anggota keluarga yang sudah divalidasi:', ['validatedAnggota' => $validatedAnggota]);

        // Loop untuk menyimpan setiap anggota keluarga
        foreach ($validatedAnggota['anggota'] as $anggotaData) {
            $keluarga->anggotaKeluarga()->create($anggotaData);
        }
      // Log data yang berhasil disimpan
      Log::info('Data keluarga dan anggota keluarga berhasil disimpan:', ['keluarga' => $keluarga]);

        // Redirect atau tindakan lain setelah sukses
        return redirect()->route('keluarga')->with('success', 'Data keluarga dan anggota berhasil disimpan.');
    }
    
    

}

