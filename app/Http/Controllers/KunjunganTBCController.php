<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KunjunganTBC;
use App\Models\AnggotaKeluarga;

class KunjunganTBCController extends Controller
{
    public function index(Request $request)
    {
        $query = KunjunganTBC::query();

        // Menambahkan logika pencarian jika ada parameter 'search'
        if ($request->has('search') && $request->search != '') {
            $query->where('kontak_erat_pasien_tbc', 'like', '%' . $request->search . '%');
        }

        // Paginate dengan 10 item per halaman
        $kunjunganTBC = $query->paginate(10);

        // Log hasil paginasi
        Log::info('Jumlah data yang dipaginasi: ' . $kunjunganTBC->total());
        Log::info('Halaman saat ini: ' . $kunjunganTBC->currentPage());

        // Mengarahkan ke view dengan data kunjungan yang difilter dan dipaginasi
        return view('kunjungan-tbc.index', compact('kunjunganTBC'));
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
        return view('kunjungan-tbc.create', compact('anggotaKeluarga'));
    }

    public function store(Request $request)
    {
        try {
            // Pengecekan apakah sudah ada data untuk anggota keluarga ini pada tanggal kunjungan yang sama
            $existingKunjungan = KunjunganTBC::where('anggota_keluarga_id', $request->anggota_keluarga_id)
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
                'batuk_terus_menerus' => 'nullable|in:Ya,Tidak',
                'demam_lebih_dari_dua_minggu' => 'nullable|in:Ya,Tidak',
                'bb_tidak_naik_turun_dua_bulan' => 'nullable|in:Ya,Tidak',
                'kontak_erat_pasien_tbc' => 'nullable|string',
                'terdiagnosa_tbc_tanggal' => 'nullable|date',
                'terdiagnosa_tbc_tempat' => 'nullable|string|max:255',
                'pemeriksaan_terakhir' => 'nullable|date',
                'ada_obat_tbc' => 'nullable|in:Ada,Tidak',
                'sudah_minum_obat_hari_ini' => 'nullable|in:Ya,Tidak',
                'pengawas_minum_obat_pmo' => 'nullable|string',
                'perilaku_merokok' => 'nullable|in:Aktif,Pasif',
                'skrining_kesehatan_jiwa_tanggal' => 'nullable|date',
                'skrining_kesehatan_jiwa_tempat' => 'nullable|string|max:255',
                'skrining_kesehatan_jiwa_petugas' => 'nullable|string|max:255',
                'pemberian_edukasi' => 'nullable|string|max:255',
                'mengingatkan_periksa_pustu_fasyankes' => 'nullable|string|max:255',
                'melaporkan_ke_nakes' => 'nullable|string|max:255',
                'paraf_terduga_pasien_tbc' => 'nullable|string|max:255',
            ]);

            // Log data yang divalidasi
            Log::info('Data yang divalidasi: ', $validatedData);

            // Simpan data ke database
            KunjunganTBC::create($validatedData);

            // Log setelah data disimpan
            Log::info('Data kunjungan berhasil disimpan: ', ['anggota_keluarga_id' => $validatedData['anggota_keluarga_id']]);

            // Redirect dengan pesan sukses dan notifikasi SweetAlert
            return redirect()->route('kunjungan-tbc.index')->with('success', 'Data kunjungan berhasil disimpan.');
        } catch (Exception $e) {
            // Log error
            Log::error('Terjadi kesalahan saat menyimpan data kunjungan: ', ['error' => $e->getMessage()]);

            // Redirect dengan pesan error
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi.');
        }
    }

    public function edit($id)
    {
        $kunjungan = KunjunganTBC::findOrFail($id);
        $anggotaKeluargas = AnggotaKeluarga::all();
        return view('kunjungan-tbc.edit', compact('kunjungan', 'anggotaKeluargas'));
    }

    public function update(Request $request, KunjunganTBC $kunjunganTBC)
    {
        try {
            // Validasi data
            $validated = $request->validate([
                'anggota_keluarga_id' => 'required|integer|exists:anggota_keluargas,id',
                'tanggal' => 'required|date',
                'batuk_terus_menerus' => 'nullable|in:Ya,Tidak',
                'demam_lebih_dari_dua_minggu' => 'nullable|in:Ya,Tidak',
                'bb_tidak_naik_turun_dua_bulan' => 'nullable|in:Ya,Tidak',
                'kontak_erat_pasien_tbc' => 'nullable|string',
                'terdiagnosa_tbc_tanggal' => 'nullable|date',
                'terdiagnosa_tbc_tempat' => 'nullable|string|max:255',
                'pemeriksaan_terakhir' => 'nullable|date',
                'ada_obat_tbc' => 'nullable|in:Ada,Tidak',
                'sudah_minum_obat_hari_ini' => 'nullable|in:Ya,Tidak',
                'pengawas_minum_obat_pmo' => 'nullable|string',
                'perilaku_merokok' => 'nullable|in:Aktif,Pasif',
                'skrining_kesehatan_jiwa_tanggal' => 'nullable|date',
                'skrining_kesehatan_jiwa_tempat' => 'nullable|string|max:255',
                'skrining_kesehatan_jiwa_petugas' => 'nullable|string|max:255',
                'pemberian_edukasi' => 'nullable|string|max:255',
                'mengingatkan_periksa_pustu_fasyankes' => 'nullable|string|max:255',
                'melaporkan_ke_nakes' => 'nullable|string|max:255',
                'paraf_terduga_pasien_tbc' => 'nullable|string|max:255',
            ]);

            // Log data yang divalidasi
            Log::info('Data yang divalidasi untuk update: ', $validated);

            // Perbarui data kunjungan
            $kunjunganTBC->update($validated);

            // Log setelah data diperbarui
            Log::info('Data kunjungan berhasil diperbarui: ', ['anggota_keluarga_id' => $validated['anggota_keluarga_id']]);

            // Redirect dengan pesan sukses dan notifikasi SweetAlert
            return redirect()->route('kunjungan-tbc.index')->with('success', 'Data kunjungan berhasil diperbarui.');
        } catch (Exception $e) {
            // Log error
            Log::error('Terjadi kesalahan saat memperbarui data kunjungan: ', ['error' => $e->getMessage()]);

            // Redirect dengan pesan error
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui data. Silakan coba lagi.');
        }
    }

    public function destroy(KunjunganTBC $kunjunganTBC)
    {
        try {
            $kunjunganTBC->delete();
            Log::info('Data kunjungan berhasil dihapus: ', ['anggota_keluarga_id' => $kunjunganTBC->anggota_keluarga_id]);
            return redirect()->route('kunjungan-tbc.index')->with('success', 'Data kunjungan berhasil dihapus.');
        } catch (Exception $e) {
            Log::error('Terjadi kesalahan saat menghapus data kunjungan: ', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus data. Silakan coba lagi.');
        }
    }
}
