<?php

namespace App\Http\Controllers;

use App\Models\KunjunganLansia;
use App\Models\AnggotaKeluarga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class KunjunganLansiaController extends Controller
{
    public function index(Request $request)
    {
        $query = KunjunganLansia::query();

        // Menambahkan logika pencarian jika ada parameter 'search'
        if ($request->has('search') && $request->search != '') {
            $query->where('anggota_keluarga_id', 'like', '%' . $request->search . '%');
        }

        // Paginate dengan 10 item per halaman
        $kunjunganLansia = $query->paginate(10);

        // Log hasil paginasi
        Log::info('Jumlah data yang dipaginasi: ' . $kunjunganLansia->total());
        Log::info('Halaman saat ini: ' . $kunjunganLansia->currentPage());

        // Mengarahkan ke view dengan data kunjungan yang difilter dan dipaginasi
        return view('kunjungan-lansia.index', compact('kunjunganLansia'));
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
        return view('kunjungan-lansia.create', compact('anggotaKeluarga'));
    }

    public function store(Request $request)
    {
        try {
            // Pengecekan apakah sudah ada data untuk anggota keluarga ini pada tanggal kunjungan yang sama
            $existingKunjungan = KunjunganLansia::where('anggota_keluarga_id', $request->anggota_keluarga_id)
                ->where('tanggal', $request->tanggal)
                ->first();

            if ($existingKunjungan) {
                // Jika data kunjungan sudah ada, redirect dengan pesan error
                return redirect()->back()->with('error', 'Kunjungan untuk anggota keluarga ini pada tanggal yang sama sudah ada. Silakan edit saja.');
            }

            // Validasi data
            $validatedData = $request->validate([
                'anggota_keluarga_id' => 'required|integer|exists:anggota_keluargas,id',
                'tanggal' => 'required|date',
                'suhu_tubuh' => 'nullable|string',
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
                'skrining_kesehatan_jiwa_tanggal' => 'nullable|date',
                'skrining_kesehatan_jiwa_tempat' => 'nullable|string|max:255',
                'skrining_kesehatan_jiwa_petugas' => 'nullable|string|max:255',
                'pemberian_edukasi' => 'nullable|string|max:255',
                'mengingatkan_periksa_pustu_fasyankes' => 'nullable|string|max:255',
                'melaporkan_ke_nakes' => 'nullable|string|max:255',
                'paraf_lansia' => 'nullable|string|max:255',
            ]);

            // Log data yang divalidasi
            Log::info('Data yang divalidasi: ', $validatedData);

            // Simpan data ke database
            KunjunganLansia::create($validatedData);

            // Log setelah data disimpan
            Log::info('Data kunjungan berhasil disimpan: ', ['anggota_keluarga_id' => $validatedData['anggota_keluarga_id']]);

            // Redirect dengan pesan sukses dan notifikasi SweetAlert
            return redirect()->route('kunjungan-lansia.index')->with('success', 'Data kunjungan berhasil disimpan.');
        } catch (Exception $e) {
            // Log error
            Log::error('Terjadi kesalahan saat menyimpan data kunjungan: ', ['error' => $e->getMessage()]);

            // Redirect dengan pesan error
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi.');
        }
    }

    public function edit($id)
    {
        $kunjungan = KunjunganLansia::findOrFail($id);
        $anggotaKeluargas = AnggotaKeluarga::all();
        return view('kunjungan-lansia.edit', compact('kunjungan', 'anggotaKeluargas'));
    }

    public function update(Request $request, KunjunganLansia $kunjunganLansia)
    {
        try {
            // Validasi data
            $validated = $request->validate([
                'anggota_keluarga_id' => 'required|integer|exists:anggota_keluargas,id',
                'tanggal' => 'required|date',
                'suhu_tubuh' => 'nullable|string',
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
                'skrining_kesehatan_jiwa_tanggal' => 'nullable|date',
                'skrining_kesehatan_jiwa_tempat' => 'nullable|string|max:255',
                'skrining_kesehatan_jiwa_petugas' => 'nullable|string|max:255',
                'pemberian_edukasi' => 'nullable|string|max:255',
                'mengingatkan_periksa_pustu_fasyankes' => 'nullable|string|max:255',
                'melaporkan_ke_nakes' => 'nullable|string|max:255',
                'paraf_lansia' => 'nullable|string|max:255',
            ]);

            // Log data yang divalidasi
            Log::info('Data yang divalidasi untuk update: ', $validated);

            // Perbarui data kunjungan
            $kunjunganLansia->update($validated);

            // Log setelah data diperbarui
            Log::info('Data kunjungan berhasil diperbarui: ', ['anggota_keluarga_id' => $validated['anggota_keluarga_id']]);

            // Redirect dengan pesan sukses dan notifikasi SweetAlert
            return redirect()->route('kunjungan-lansia.index')->with('success', 'Data kunjungan berhasil diperbarui.');
        } catch (Exception $e) {
            // Log error
            Log::error('Terjadi kesalahan saat memperbarui data kunjungan: ', ['error' => $e->getMessage()]);

            // Redirect dengan pesan error
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui data. Silakan coba lagi.');
        }
    }

    public function destroy(KunjunganLansia $kunjunganLansia)
    {
        try {
            $kunjunganLansia->delete();
            Log::info('Data kunjungan berhasil dihapus: ', ['anggota_keluarga_id' => $kunjunganLansia->anggota_keluarga_id]);
            return redirect()->route('kunjungan-lansia.index')->with('success', 'Data kunjungan berhasil dihapus.');
        } catch (Exception $e) {
            Log::error('Terjadi kesalahan saat menghapus data kunjungan: ', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus data. Silakan coba lagi.');
        }
    }
    public function show($id)
    {
        $kunjungan = KunjunganRumahBalitaApras::findOrFail($id);
        
        return view('kunjungan-rumah-balita-apras.show', compact('kunjungan'));
    }
    // Menghapus kunjungan rumah balita dan apras
  
}
