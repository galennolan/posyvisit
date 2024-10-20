<?php

namespace App\Http\Controllers;

use App\Models\KunjunganBayi;
use App\Models\AnggotaKeluarga;   
use Illuminate\Http\Request;

class KunjunganBayiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Filter pencarian berdasarkan tanggal kunjungan
        $query = KunjunganBayi::query();

        if ($request->has('search') && $request->search != '') {
            $query->where('tanggal_kunjungan', 'like', '%' . $request->search . '%');
        }

        // Paginate hasil pencarian
        $kunjungan_bayi = $query->paginate(10);

        return view('kunjungan-bayi.index', compact('kunjungan_bayi'));
    }

    /**
     * Show the form for creating a new resource.
     */

    public function create(Request $request)
    {
        $anggotaKeluarga = AnggotaKeluarga::find($request->anggota_keluarga_id);
        return view('kunjungan-bayi.create', compact('anggotaKeluarga'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input dari request
        $request->validate([
            'anggota_keluarga_id' => 'required|exists:anggota_keluargas,id',
            'tempat_lahir' => 'required|string',
            'tanggal_kunjungan' => 'required|date',
            'pemantauan_suhu_tubuh' => 'required|in:<37.5 C,>=36.5 C',
            'ada_buku_kia' => 'required|in:Ada,Tidak',
            'asi_eksklusif' => 'required|in:Ada,Tidak',
            'tanggal_terakhir_ditimbang' => 'nullable|date',
            'tempat_penimbangan' => 'nullable|string',
            'petugas_penimbangan' => 'nullable|string',
            'berat_badan' => 'nullable|numeric',
            'panjang_badan' => 'nullable|numeric',
            'lingkar_kepala' => 'nullable|numeric',
            'pelayanan_neonatal_essensial_0_6_jam' => 'nullable|date',
            'tempat_pelayanan_neonatal_0_6_jam' => 'nullable|string',
            'petugas_pelayanan_neonatal_0_6_jam' => 'nullable|string',
            'kn1_6_48_jam' => 'nullable|date',
            'tempat_kn1' => 'nullable|string',
            'petugas_kn1' => 'nullable|string',
            'kn2_3_7_hari' => 'nullable|date',
            'tempat_kn2' => 'nullable|string',
            'petugas_kn2' => 'nullable|string',
            'kn3_8_28_hari' => 'nullable|date',
            'tempat_kn3' => 'nullable|string',
            'petugas_kn3' => 'nullable|string',
            'hepatitis_b_0_bulan' => 'nullable|in:Ya,Tidak',
            'bcg_0_bulan' => 'nullable|in:Ya,Tidak',
            'polio_tetes_1_0_bulan' => 'nullable|in:Ya,Tidak',
            'bcg_1_bulan' => 'nullable|in:Ya,Tidak',
            'polio_tetes_1_1_bulan' => 'nullable|in:Ya,Tidak',
            'dpt_hb_hib_1_2_bulan' => 'nullable|in:Ya,Tidak',
            'polio_tetes_2_2_bulan' => 'nullable|in:Ya,Tidak',
            'pcv_1_2_bulan' => 'nullable|in:Ya,Tidak',
            'rv_1_2_bulan' => 'nullable|in:Ya,Tidak',
            'dpt_hb_hib_2_3_bulan' => 'nullable|in:Ya,Tidak',
            'polio_tetes_3_3_bulan' => 'nullable|in:Ya,Tidak',
            'pcv_2_3_bulan' => 'nullable|in:Ya,Tidak',
            'rv_2_3_bulan' => 'nullable|in:Ya,Tidak',
            'dpt_hb_hib_3_4_bulan' => 'nullable|in:Ya,Tidak',
            'polio_tetes_4_4_bulan' => 'nullable|in:Ya,Tidak',
            'polio_suntik_4_bulan' => 'nullable|in:Ya,Tidak',
            'rv_3_4_bulan' => 'nullable|in:Ya,Tidak',
            'napas' => 'required|in:Ya,Tidak',
            'aktifitas' => 'required|in:Ya,Tidak',
            'warna_kulit' => 'required|in:Ya,Tidak',
            'hisapan_bayi' => 'required|in:Ya,Tidak',
            'kejang' => 'required|in:Ya,Tidak',
            'suhu_tubuh_tanda_bahaya' => 'required|in:Ya,Tidak',
            'bab' => 'required|in:Ya,Tidak',
            'jumlah_warna_air_kencing' => 'required|in:Ya,Tidak',
            'tali_pusat' => 'required|in:Ya,Tidak',
            'mata' => 'required|in:Ya,Tidak',
            'kulit_tanda_bahaya' => 'required|in:Ya,Tidak',
            'imunisasi_tanda_bahaya' => 'required|in:Ya,Tidak',
            'mengingatkan_periksa_pustu' => 'required|in:Ya,Tidak',
            'melaporkan_ke_nakes' => 'nullable|date',
        ]);

        // Simpan data kunjungan bayi ke dalam database
        KunjunganBayi::create($request->all());

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('kunjungan-bayi.index')->with('success', 'Data kunjungan bayi berhasil disimpan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $kunjunganBayi  = KunjunganBayi::findOrFail($id);
        // Mengambil data anggota keluarga jika diperlukan
        $anggotaKeluarga = AnggotaKeluarga::find($kunjunganBayi->anggota_keluarga_id);
        return view('kunjungan-bayi.edit', compact('kunjunganBayi','anggotaKeluarga'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'anggota_keluarga_id' => 'required|exists:anggota_keluargas,id',
            'tempat_lahir' => 'required|string',
            'tanggal_kunjungan' => 'required|date',
            'pemantauan_suhu_tubuh' => 'required|in:<37.5 C,>=36.5 C',
            'ada_buku_kia' => 'required|in:Ada,Tidak',
            'asi_eksklusif' => 'required|in:Ada,Tidak',
            'tanggal_terakhir_ditimbang' => 'nullable|date',
            'tempat_penimbangan' => 'nullable|string',
            'petugas_penimbangan' => 'nullable|string',
            'berat_badan' => 'nullable|numeric',
            'panjang_badan' => 'nullable|numeric',
            'lingkar_kepala' => 'nullable|numeric',
            'pelayanan_neonatal_essensial_0_6_jam' => 'nullable|date',
            'tempat_pelayanan_neonatal_0_6_jam' => 'nullable|string',
            'petugas_pelayanan_neonatal_0_6_jam' => 'nullable|string',
            'kn1_6_48_jam' => 'nullable|date',
            'tempat_kn1' => 'nullable|string',
            'petugas_kn1' => 'nullable|string',
            'kn2_3_7_hari' => 'nullable|date',
            'tempat_kn2' => 'nullable|string',
            'petugas_kn2' => 'nullable|string',
            'kn3_8_28_hari' => 'nullable|date',
            'tempat_kn3' => 'nullable|string',
            'petugas_kn3' => 'nullable|string',
            'hepatitis_b_0_bulan' => 'nullable|in:Ya,Tidak',
            'bcg_0_bulan' => 'nullable|in:Ya,Tidak',
            'polio_tetes_1_0_bulan' => 'nullable|in:Ya,Tidak',
            'bcg_1_bulan' => 'nullable|in:Ya,Tidak',
            'polio_tetes_1_1_bulan' => 'nullable|in:Ya,Tidak',
            'dpt_hb_hib_1_2_bulan' => 'nullable|in:Ya,Tidak',
            'polio_tetes_2_2_bulan' => 'nullable|in:Ya,Tidak',
            'pcv_1_2_bulan' => 'nullable|in:Ya,Tidak',
            'rv_1_2_bulan' => 'nullable|in:Ya,Tidak',
            'dpt_hb_hib_2_3_bulan' => 'nullable|in:Ya,Tidak',
            'polio_tetes_3_3_bulan' => 'nullable|in:Ya,Tidak',
            'pcv_2_3_bulan' => 'nullable|in:Ya,Tidak',
            'rv_2_3_bulan' => 'nullable|in:Ya,Tidak',
            'dpt_hb_hib_3_4_bulan' => 'nullable|in:Ya,Tidak',
            'polio_tetes_4_4_bulan' => 'nullable|in:Ya,Tidak',
            'polio_suntik_4_bulan' => 'nullable|in:Ya,Tidak',
            'rv_3_4_bulan' => 'nullable|in:Ya,Tidak',
            'napas' => 'required|in:Ya,Tidak',
            'aktifitas' => 'required|in:Ya,Tidak',
            'warna_kulit' => 'required|in:Ya,Tidak',
            'hisapan_bayi' => 'required|in:Ya,Tidak',
            'kejang' => 'required|in:Ya,Tidak',
            'suhu_tubuh_tanda_bahaya' => 'required|in:Ya,Tidak',
            'bab' => 'required|in:Ya,Tidak',
            'jumlah_warna_air_kencing' => 'required|in:Ya,Tidak',
            'tali_pusat' => 'required|in:Ya,Tidak',
            'mata' => 'required|in:Ya,Tidak',
            'kulit_tanda_bahaya' => 'required|in:Ya,Tidak',
            'imunisasi_tanda_bahaya' => 'required|in:Ya,Tidak',
            'mengingatkan_periksa_pustu' => 'required|in:Ya,Tidak',
            'melaporkan_ke_nakes' => 'nullable|date'
        ]);

        // Cari data kunjungan bayi berdasarkan ID
        $kunjungan_bayi = KunjunganBayi::findOrFail($id);

        // Update data kunjungan bayi
        $kunjungan_bayi->update($request->all());

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('kunjungan-bayi.index')->with('success', 'Data kunjungan bayi berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $kunjungan_bayi = KunjunganBayi::findOrFail($id);
        $kunjungan_bayi->delete();

        return redirect()->route('kunjungan-bayi.index')->with('success', 'Data kunjungan bayi berhasil dihapus.');
    }
}
