<?php

namespace App\Http\Controllers;

use App\Models\KunjunganUsiaDewasa;
use App\Models\AnggotaKeluarga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class KunjunganUsiaDewasaController extends Controller
{
    public function index(Request $request)
    {
        $query = KunjunganUsiaDewasa::query();

        // Menambahkan logika pencarian jika ada parameter 'search'
        if ($request->has('search') && $request->search != '') {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }

        // Paginate dengan 10 item per halaman
        $kunjunganUsiaDewasa = $query->paginate(10);

        // Log hasil paginasi
        Log::info('Jumlah data yang dipaginasi: ' . $kunjunganUsiaDewasa->total());
        Log::info('Halaman saat ini: ' . $kunjunganUsiaDewasa->currentPage());

        // Mengarahkan ke view dengan data kunjungan yang difilter dan dipaginasi
        return view('kunjungan-usia-dewasa.index', compact('kunjunganUsiaDewasa'));
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
        return view('kunjungan-usia-dewasa.create', compact('anggotaKeluarga'));
    }

    public function store(Request $request)
    {
        try {
            
            // Pengecekan apakah sudah ada data untuk anggota keluarga ini pada tanggal kunjungan yang sama
            $existingKunjungan = KunjunganUsiaDewasa::where('anggota_keluarga_id', $request->anggota_keluarga_id)
                ->where('tanggal_kunjungan', $request->tanggal_kunjungan)
                ->first();

            if ($existingKunjungan) {
                // Jika data kunjungan sudah ada, redirect dengan pesan error
                return redirect()->back()->with('error', 'Kunjungan untuk anggota keluarga ini pada tanggal yang sama sudah ada. Silakan edit saja.');
            }

                 // Log incoming request data
        Log::debug('Incoming Request Data: ', $request->all());
            // Validasi data
            $validatedData = $request->validate([
                'anggota_keluarga_id' => 'required|integer|exists:anggota_keluargas,id',
                'riwayat_penyakit_keluarga' => 'nullable|array',
                'tanggal_kunjungan' => 'nullable|date',
                'suhu_tubuh' => 'nullable|string|max:255',
                'isi_piringku' => 'nullable|in:Sesuai,Tidak',
                'pemeriksaan_tekanan_darah_tahun_terakhir' => 'nullable|date',
                'tempat_pemeriksaan_tekanan_darah_tahun_terakhir' => 'nullable|string|max:255',
                'hasil_pemeriksaan_tekanan_darah_tahun_terakhir' => 'nullable|string|max:255',
                'terdiagnosa_hipertensi_tahun_terakhir' => 'nullable|date',
                'pemeriksaan_tekanan_darah_bulan_terakhir' => 'nullable|date',
                'tempat_pemeriksaan_tekanan_darah_bulan_terakhir' => 'nullable|string|max:255',
                'hasil_pemeriksaan_tekanan_darah_bulan_terakhir' => 'nullable|string|max:255',
                'ada_obat_hipertensi' => 'nullable|in:Ada,Tidak',
                'sudah_minum_obat_hipertensi' => 'nullable|in:Ya,Tidak',
                'pemeriksaan_gula_darah_tahun_terakhir' => 'nullable|date',
                'tempat_pemeriksaan_gula_darah_tahun_terakhir' => 'nullable|string|max:255',
                'hasil_pemeriksaan_gula_darah_tahun_terakhir' => 'nullable|string|max:255',
                'terdiagnosa_diabetes_melitus_tahun_terakhir' => 'nullable|date',
                'pemeriksaan_gula_darah_bulan_terakhir' => 'nullable|date',
                'tempat_pemeriksaan_gula_darah_bulan_terakhir' => 'nullable|string|max:255',
                'hasil_pemeriksaan_gula_darah_bulan_terakhir' => 'nullable|string|max:255',
                'ada_obat_dm' => 'nullable|in:Ada,Tidak',
                'sudah_minum_obat_dm' => 'nullable|in:Ya,Tidak',
                'perilaku_merokok' => 'nullable|in:Aktif,Pasif',
                'kontrasepsi' => 'nullable|array',
                'skrining_kesehatan_jiwa' => 'nullable|date',
                'tempat_skrining_kesehatan_jiwa' => 'nullable|string|max:255',
                'petugas_skrining_kesehatan_jiwa' => 'nullable|string|max:255',
                'pemberian_edukasi' => 'nullable|string|max:255',
                'paraf_usia_dewasa' => 'nullable|string|max:255',
            ]);

            // Log data yang divalidasi
            Log::info('Data yang divalidasi: ', $validatedData);
             // Dump the validated data for immediate inspection
      

            // Simpan data ke database
            KunjunganUsiaDewasa::create($validatedData);

            // Log setelah data disimpan
            Log::info('Data kunjungan berhasil disimpan: ', ['anggota_keluarga_id' => $validatedData['anggota_keluarga_id']]);

            // Redirect dengan pesan sukses dan notifikasi SweetAlert
            return redirect()->route('kunjungan-usia-dewasa.index')->with('success', 'Data kunjungan berhasil disimpan.');
        } catch (Exception $e) {
            // Log error
            Log::error('Terjadi kesalahan saat menyimpan data kunjungan: ', ['error' => $e->getMessage()]);

            // Redirect dengan pesan error
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi.');
        }
    }
    public function edit($id)
    {
        $kunjungan = KunjunganUsiaDewasa::findOrFail($id);
        $anggotaKeluargas = AnggotaKeluarga::all();
        return view('kunjungan-usia-dewasa.edit', compact('kunjungan', 'anggotaKeluargas'));
    }

    public function update(Request $request, KunjunganUsiaDewasa $kunjunganUsiaDewasa)
    {
        try {
            // Validasi data
            $validated = $request->validate([
                'anggota_keluarga_id' => 'required|integer|exists:anggota_keluargas,id',
                'tanggal' => 'nullable|date',
                'suhu_tubuh' => 'nullable|string|max:255', 
                'isi_piringku' => 'nullable|in:Sesuai,Tidak',
                'pemeriksaan_tekanan_darah_tahun_terakhir' => 'nullable|date',
                'tempat_pemeriksaan_tekanan_darah_tahun_terakhir' => 'nullable|string|max:255',
                'hasil_pemeriksaan_tekanan_darah_tahun_terakhir' => 'nullable|string|max:255',
                'terdiagnosa_hipertensi_tahun_terakhir' => 'nullable|date',
                'pemeriksaan_tekanan_darah_bulan_terakhir' => 'nullable|date',
                'tempat_pemeriksaan_tekanan_darah_bulan_terakhir' => 'nullable|string|max:255',
                'hasil_pemeriksaan_tekanan_darah_bulan_terakhir' => 'nullable|string|max:255',
                'ada_obat_hipertensi' => 'nullable|in:Ada,Tidak',
                'sudah_minum_obat_hipertensi' => 'nullable|in:Ya,Tidak',
                'pemeriksaan_gula_darah_tahun_terakhir' => 'nullable|date',
                'tempat_pemeriksaan_gula_darah_tahun_terakhir' => 'nullable|string|max:255',
                'hasil_pemeriksaan_gula_darah_tahun_terakhir' => 'nullable|string|max:255',
                'terdiagnosa_diabetes_melitus_tahun_terakhir' => 'nullable|date',
                'pemeriksaan_gula_darah_bulan_terakhir' => 'nullable|date',
                'tempat_pemeriksaan_gula_darah_bulan_terakhir' => 'nullable|string|max:255',
                'hasil_pemeriksaan_gula_darah_bulan_terakhir' => 'nullable|string|max:255',
                'ada_obat_dm' => 'nullable|in:Ada,Tidak',
                'sudah_minum_obat_dm' => 'nullable|in:Ya,Tidak',
                'perilaku_merokok' => 'nullable|in:Aktif,Pasif',
                'kontrasepsi' => 'nullable|array',
                'skrining_kesehatan_jiwa' => 'nullable|date',
                'tempat_skrining_kesehatan_jiwa' => 'nullable|string|max:255',
                'petugas_skrining_kesehatan_jiwa' => 'nullable|string|max:255',
                'pemberian_edukasi' => 'nullable|string|max:255',
                'paraf_usia_dewasa' => 'nullable|string|max:255',
            ]);

            // Log data yang divalidasi
            Log::info('Data yang divalidasi untuk update: ', $validated);

            // Perbarui data kunjungan
            $kunjunganUsiaDewasa->update($validated);

            // Log setelah data diperbarui
            Log::info('Data kunjungan berhasil diperbarui: ', ['anggota_keluarga_id' => $validated['anggota_keluarga_id']]);

            // Redirect dengan pesan sukses dan notifikasi SweetAlert
            return redirect()->route('kunjungan-usia-dewasa.index')->with('success', 'Data kunjungan berhasil diperbarui.');
        } catch (Exception $e) {
            // Log error
            Log::error('Terjadi kesalahan saat memperbarui data kunjungan: ', ['error' => $e->getMessage()]);

            // Redirect dengan pesan error
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui data. Silakan coba lagi.');
        }
    }

    public function destroy(KunjunganUsiaDewasa $kunjunganUsiaDewasa)
    {
        try {
            $kunjunganUsiaDewasa->delete();
            Log::info('Data kunjungan berhasil dihapus: ', ['anggota_keluarga_id' => $kunjunganUsiaDewasa->anggota_keluarga_id]);
            return redirect()->route('kunjungan-usia-dewasa.index')->with('success', 'Data kunjungan berhasil dihapus.');
        } catch (Exception $e) {
            Log::error('Terjadi kesalahan saat menghapus data kunjungan: ', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus data. Silakan coba lagi.');
        }
    }

}
