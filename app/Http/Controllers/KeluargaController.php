<?php
namespace App\Http\Controllers;

use App\Models\Keluarga;
use App\Models\AnggotaKeluarga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; // Import Log facade
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule; // Tambahkan baris ini
use Illuminate\Validation\ValidationException;

class KeluargaController extends Controller
{


    public function index()
    {
        // Ambil user yang sedang login
        $user = Auth::user();

        // Cek apakah user adalah admin
        if ($user->hasRole('admin')) {
            // Jika admin, ambil semua data keluarga beserta anggotanya
            $keluargas = Keluarga::with('anggotaKeluarga')->get();
        } else if ($user->hasRole('user')) {
            // Jika bukan admin, hanya ambil data keluarga sesuai dengan kelurahan user
            $keluargas = Keluarga::with('anggotaKeluarga')
            ->where('id_user', $user->id) // Memfilter berdasarkan id_user
            ->get();
        } else {
            // Jika tidak memiliki role yang tepat, tampilkan data kosong atau redirect
            $keluargas = collect([]);
        }

        // Kirim data ke view
        return view('keluarga.index', compact('keluargas'));
    }

    public function indexWithFilter(Request $request)
    {
        // Ambil user yang sedang login
        $user = Auth::user();

        // Ambil parameter tanggal mulai dan tanggal akhir dari request
        $tanggalMulai = $request->input('tanggal_mulai', null);
        $tanggalAkhir = $request->input('tanggal_akhir', null);

        // Logika untuk memfilter data
        if ($user->hasRole('admin')) {
            $query = Keluarga::with('anggotaKeluarga');
        } else if ($user->hasRole('user')) {
            $query = Keluarga::with('anggotaKeluarga')->where('id_user', $user->id);
        } else {
            $query = collect([]);
        }

        // Tambahkan filter berdasarkan tanggal jika ada
        if ($tanggalMulai && $tanggalAkhir) {
            $query->whereBetween('tanggal_pengumpulan_data', [$tanggalMulai, $tanggalAkhir]);
        }

        // Ambil hasil query
        $keluargas = $query->get();

         // Kirim data ke view
          return view('keluarga.index', compact('keluargas', 'tanggalMulai', 'tanggalAkhir'));
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
        Log::info('Data keluarga diterima sebelum validasi:', ['request' => $request->all()]);

        try {
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

            $validatedKeluarga['id_user'] = auth()->user()->id; // Menambahkan id_user dari autentikasi

            Log::info('Validasi keluarga berhasil.', ['validatedKeluarga' => $validatedKeluarga]);

            // Simpan data keluarga
            $keluarga = Keluarga::create($validatedKeluarga);
            Log::info('Data keluarga berhasil disimpan.', ['keluarga' => $keluarga]);

            // Validasi semua data anggota keluarga sekaligus
            if ($request->has('anggota') && !empty($request->input('anggota'))) {
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
                ], [
                    'anggota.*.nik.unique' => 'NIK sudah terdaftar. Silakan masukkan NIK yang lain.',
                ]);
                Log::info('Validasi anggota keluarga berhasil.', ['validatedAnggota' => $validatedAnggota]);
            }

            // Loop untuk menyimpan setiap anggota keluarga
            if (isset($validatedAnggota)) {
                foreach ($validatedAnggota['anggota'] as $anggotaData) {
                    $keluarga->anggotaKeluarga()->create($anggotaData);
                }
                Log::info('Data anggota keluarga berhasil disimpan.');
            }

            return redirect()->route('keluarga')->with('success', 'Data keluarga dan anggota berhasil disimpan.');
        } catch (ValidationException $e) {
            Log::error('Validasi gagal', ['errors' => $e->errors()]);

            // Periksa apakah kesalahan terkait NIK yang sudah terdaftar
            $errors = $e->errors();
            $nikErrors = array_filter($errors, function ($key) {
                return strpos($key, 'anggota.') !== false && strpos($key, 'nik') !== false;
            }, ARRAY_FILTER_USE_KEY);

            if ($nikErrors) {
                Log::error('Validasi gagal: NIK sudah terdaftar.', ['nik_errors' => $nikErrors]);
                return redirect()->back()->with('error', 'Validasi Gagal: NIK sudah terdaftar.')->withErrors($errors)->withInput();
            }

            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            Log::error('Terjadi kesalahan saat menyimpan data keluarga.', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data keluarga.')->withInput();
        }
    }

    
    // Fungsi Hapus untuk menghapus data keluarga
    public function destroy($id)
    {
        // Ambil data keluarga berdasarkan ID
        $keluarga = Keluarga::findOrFail($id);

        // Hapus data keluarga beserta anggota keluarganya
        $keluarga->anggotaKeluarga()->delete();
        $keluarga->delete();

        // Redirect ke halaman keluarga setelah berhasil dihapus
        return redirect()->route('keluarga')->with('success', 'Data keluarga dan anggota berhasil dihapus.');
    }
    public function edit($id)
    {
        $keluarga = Keluarga::with('anggotaKeluarga')->findOrFail($id);
        // Get Kecamatan for options (Assuming you have a method to get them)
        $kecamatanOptions = ['Banjarsari', 'Jebres', 'Laweyan', 'Pasar Kliwon', 'Serengan'];

        return view('keluarga.edit', compact('keluarga', 'kecamatanOptions'));
    }

    public function update(Request $request, $id)
{
    try {
        // Validasi data keluarga
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

        $validatedKeluarga['id_user'] = auth()->user()->id;

        // Validasi data anggota keluarga baru jika ada
        if ($request->has('anggota') && !empty($request->input('anggota'))) {
            $validatedAnggota = $request->validate([
                'anggota.*.nama_lengkap' => 'required|string|max:255',
                'anggota.*.nik' => [
                    'required',
                    'digits:16',
                    Rule::unique('anggota_keluargas', 'nik')->whereNot('keluarga_id', $id),
                ],
                'anggota.*.tanggal_lahir' => 'required|date|before:today',
                'anggota.*.jenis_kelamin' => 'required|in:Laki-Laki,Perempuan',
                'anggota.*.hubungan_kk' => 'required|in:1,2,3,4,5,6,7,8,9',
                'anggota.*.status_perkawinan' => 'required|in:1,2,3,4',
                'anggota.*.pendidikan_terakhir' => 'required|in:1,2,3,4,5,6',
                'anggota.*.pekerjaan' => 'required|in:1,2,3,4,5,6,7',
                'anggota.*.kelompok_sasaran' => 'required|in:Ibu Hamil,Ibu Bersalin & Nifas,Bayi - Balita (0-6 tahun),Usia Sekolah & Remaja (≥6 - <18 tahun),Usia Dewasa (≥18-59 tahun),Lansia (≥60 tahun)',
            ], [
                'anggota.*.nik.unique' => 'NIK sudah terdaftar. Silakan masukkan NIK yang lain.',
            ]);
        }

        // Update data keluarga
        $keluarga = Keluarga::findOrFail($id);
        $keluarga->update($validatedKeluarga);

        // Hapus anggota lama jika validasi berhasil
        $keluarga->anggotaKeluarga()->delete();

        // Simpan anggota baru
        if (isset($validatedAnggota)) {
            foreach ($validatedAnggota['anggota'] as $anggotaData) {
                $keluarga->anggotaKeluarga()->create($anggotaData);
            }
        }

        // Kirim pesan sukses ke view menggunakan session
        return redirect()->route('keluarga')->with('success', 'Data keluarga berhasil diperbarui.');
    } catch (ValidationException $e) {
        // Log validasi error
        Log::error('Validasi gagal dengan pesan:', ['errors' => $e->errors()]);

        // Cek apakah kesalahan validasi terkait NIK yang sudah terdaftar
        $errors = $e->errors();
        
        // Debug log untuk melihat error detail
        Log::debug('Debugging error untuk validasi:', ['request_data' => $request->all(), 'errors' => $errors]);

        // Cek apakah ada kesalahan terkait NIK yang sudah terdaftar
        $nikErrors = array_filter($errors, function($key) {
            return strpos($key, 'anggota.') !== false && strpos($key, 'nik') !== false;
        }, ARRAY_FILTER_USE_KEY);

        if ($nikErrors) {
            Log::error('Validasi NIK sudah terdaftar.', ['nik_errors' => $nikErrors]);
            return redirect()->back()->with('error', 'Validasi Gagal: NIK sudah terdaftar.')->withErrors($errors)->withInput();
        }

        return redirect()->back()->withErrors($e->errors())->withInput();
    } catch (\Exception $e) {
        Log::error('Terjadi kesalahan umum saat memperbarui data keluarga.', ['error' => $e->getMessage()]);
        return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui data keluarga.')->withInput();
    }
}
    





}

