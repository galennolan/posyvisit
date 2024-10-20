<?php

namespace App\Http\Controllers;

use App\Models\KunjunganRumahUsiaRemaja;
use App\Models\AnggotaKeluarga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class KunjunganRumahUsiaRemajaController extends Controller
{
    public function index(Request $request)
    {
        $query = KunjunganRumahUsiaRemaja::query(); // Ganti model ke KunjunganRumahUsiaRemaja
        
        // Menambahkan logika pencarian jika ada parameter 'search'
        if ($request->has('search') && $request->search != '') {
            $query->where('nama_remaja', 'like', '%' . $request->search . '%');
        }

        // Paginate dengan 10 item per halaman
        $kunjungan_remaja = $query->paginate(10);

        // Log hasil paginasi
        Log::info('Jumlah data yang dipaginasi: ' . $kunjungan_remaja->total());
        Log::info('Halaman saat ini: ' . $kunjungan_remaja->currentPage());
        
        // Mengarahkan ke view dengan data kunjungan yang difilter dan dipaginasi
        return view('kunjungan-rumah-usia-remaja.index', compact('kunjungan_remaja'));
    }

    public function create(Request $request)
    {
        // Mencari anggota keluarga berdasarkan ID yang diterima dari request
        $anggotaKeluarga = AnggotaKeluarga::find($request->anggota_keluarga_id);

        // Pastikan data anggota keluarga ditemukan
        if (!$anggotaKeluarga) {
            return redirect()->back()->with('error', 'Anggota keluarga tidak ditemukan.');
        }

        // Menampilkan halaman form create dengan data anggota keluarga yang bersangkutan
        return view('kunjungan-rumah-usia-remaja.create', compact('anggotaKeluarga'));
    }

    public function store(Request $request)
    {
        try {
            // Pengecekan apakah sudah ada data untuk anggota keluarga ini pada tanggal kunjungan yang sama
            $existingKunjungan = KunjunganRumahUsiaRemaja::where('anggota_keluarga_id', $request->anggota_keluarga_id)
                ->where('tanggal_kunjungan', $request->tanggal_kunjungan)
                ->first();
    
            if ($existingKunjungan) {
                // Jika data kunjungan sudah ada, redirect dengan pesan error
                return redirect()->back()->with('error', 'Kunjungan untuk anggota keluarga ini pada tanggal yang sama sudah ada. Silakan edit saja.');
            }
    
            // Validasi data
            $validated = $request->validate([
                'anggota_keluarga_id' => 'required|integer|exists:anggota_keluargas,id',
                'waktu_kunjungan' => 'nullable|date',
                'tanggal_kunjungan' => 'required|date',
                'suhu_tubuh' => 'nullable|string|max:255',
                'tanggal_terakhir_menimbang_mengukur' => 'nullable|date',
                'isi_piringku' => 'nullable|in:Sesuai,Tidak',
                'bb' => 'nullable|numeric',
                'tb' => 'nullable|numeric',
                'lp' => 'nullable|numeric',
                'ada_ttd' => 'nullable|boolean',
                'minum_ttd' => 'nullable|in:Ya,Tidak',
                'tanggal_pemeriksaan_1' => 'nullable|date',
                'tempat_pemeriksaan_1' => 'nullable|string|max:255',
                'hasil_pemeriksaan_1' => 'nullable|string|max:255',
                'perilaku_merokok' => 'nullable|in:Aktif,Pasif',
                'tanggal_pemeriksaan_gula' => 'nullable|date',
                'tempat_pemeriksaan_gula' => 'nullable|string|max:255',
                'hasil_pemeriksaan_gula' => 'nullable|string|max:255',
                'tanggal_pemeriksaan_tekanan' => 'nullable|date',
                'tempat_pemeriksaan_tekanan' => 'nullable|string|max:255',
                'hasil_pemeriksaan_tekanan' => 'nullable|string|max:255',
                'tanggal_skrining_jiwa' => 'nullable|date',
                'tempat_skrining_jiwa' => 'nullable|string|max:255',
                'hasil_skrining_jiwa' => 'nullable|string|max:255',
                'pemberian_edukasi' => 'nullable|string|max:255',
                'paraf_remaja' => 'nullable|string|max:255',
            ]);
    
            // Log data yang divalidasi
            Log::info('Data yang divalidasi: ', $validated);

    
            // Simpan data ke database
            KunjunganRumahUsiaRemaja::create($validated);
    
            // Log setelah data disimpan
            Log::info('Data kunjungan berhasil disimpan: ', ['anggota_keluarga_id' => $validated['anggota_keluarga_id']]);
    
            // Redirect dengan pesan sukses dan notifikasi SweetAlert
            return redirect()->route('kunjungan-rumah-usia-remaja.index')->with('success', 'Data kunjungan berhasil disimpan.');
        } catch (Exception $e) {
            // Log error
            Log::error('Terjadi kesalahan saat menyimpan data kunjungan: ', ['error' => $e->getMessage()]);
    
            // Redirect dengan pesan error
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi.');
        }
    }

    public function edit($id)
    {
        $kunjungan = KunjunganRumahUsiaRemaja::findOrFail($id);
        $anggotaKeluargas = AnggotaKeluarga::all();
        return view('kunjungan-rumah-usia-remaja.edit', compact('kunjungan', 'anggotaKeluargas'));
    }
    public function update(Request $request, KunjunganRumahUsiaRemaja $kunjungan_rumah_usia_remaja)
    {
        try {
            // Validasi data
            $validated = $request->validate([
                'anggota_keluarga_id' => 'required|integer|exists:anggota_keluargas,id',
                'waktu_kunjungan' => 'nullable|date',
                'tanggal_kunjungan' => 'required|date',
                'suhu_tubuh' => 'nullable|string|max:255',
                'tanggal_terakhir_menimbang_mengukur' => 'nullable|date',
                'isi_piringku' => 'nullable|in:Sesuai,Tidak',
                'bb' => 'nullable|numeric',
                'tb' => 'nullable|numeric',
                'lp' => 'nullable|numeric',
                'ada_ttd' => 'nullable|boolean',
                'minum_ttd' => 'nullable|in:Ya,Tidak',
                'tanggal_pemeriksaan_1' => 'nullable|date',
                'tempat_pemeriksaan_1' => 'nullable|string|max:255',
                'hasil_pemeriksaan_1' => 'nullable|string|max:255',
                'perilaku_merokok' => 'nullable|in:Aktif,Pasif',
                'tanggal_pemeriksaan_gula' => 'nullable|date',
                'tempat_pemeriksaan_gula' => 'nullable|string|max:255',
                'hasil_pemeriksaan_gula' => 'nullable|string|max:255',
                'tanggal_pemeriksaan_tekanan' => 'nullable|date',
                'tempat_pemeriksaan_tekanan' => 'nullable|string|max:255',
                'hasil_pemeriksaan_tekanan' => 'nullable|string|max:255',
                'tanggal_skrining_jiwa' => 'nullable|date',
                'tempat_skrining_jiwa' => 'nullable|string|max:255',
                'hasil_skrining_jiwa' => 'nullable|string|max:255',
                'pemberian_edukasi' => 'nullable|string|max:255',
                'paraf_remaja' => 'nullable|string|max:255',
            ]);

            // Log data yang divalidasi
            Log::info('Data yang divalidasi untuk update: ', $validated);

            // Perbarui data kunjungan
            $kunjungan_rumah_usia_remaja->update($validated);

            // Log setelah data diperbarui
            Log::info('Data kunjungan berhasil diperbarui: ', ['anggota_keluarga_id' => $validated['anggota_keluarga_id']]);

            // Redirect dengan pesan sukses dan notifikasi SweetAlert
            return redirect()->route('kunjungan-rumah-usia-remaja.index')->with('success', 'Data kunjungan berhasil diperbarui.');
        } catch (Exception $e) {
            // Log error
            Log::error('Terjadi kesalahan saat memperbarui data kunjungan: ', ['error' => $e->getMessage()]);

            // Redirect dengan pesan error
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui data. Silakan coba lagi.');
        }
    }
}
