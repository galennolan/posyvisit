<?php

namespace App\Http\Controllers;

use App\Models\KunjunganRumahBalitaApras;
use App\Models\AnggotaKeluarga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class KunjunganRumahBalitaAprasController extends Controller
{
    // Menampilkan daftar kunjungan rumah balita dan apras
    public function index(Request $request)
    {
        $query = KunjunganRumahBalitaApras::query();
        
        // Menambahkan logika pencarian jika ada parameter 'search'
        if ($request->has('search') && $request->search != '') {
            $query->where('nama_anak', 'like', '%' . $request->search . '%');
        }

        // Paginate dengan 10 item per halaman
        $kunjungan_rumah_balita_apras = $query->paginate(10);

         // Log hasil paginasi
        Log::info('Jumlah data yang dipaginasi: ' . $kunjungan_rumah_balita_apras->total());
        Log::info('Halaman saat ini: ' . $kunjungan_rumah_balita_apras->currentPage());
        

        // Mengarahkan ke view dengan data kunjungan yang difilter dan dipaginasi
        return view('kunjungan-rumah-balita-apras.index', compact('kunjungan_rumah_balita_apras'));
    }

    public function create(Request $request)
    {
        $anggotaKeluarga = AnggotaKeluarga::find($request->anggota_keluarga_id);
        return view('kunjungan-rumah-balita-apras.create', compact('anggotaKeluarga'));
    }


    public function store(Request $request)
    {
        try {
            // Pengecekan apakah sudah ada data untuk anggota keluarga ini pada tanggal kunjungan yang sama
            $existingKunjungan = KunjunganRumahBalitaApras::where('anggota_keluarga_id', $request->anggota_keluarga_id)
                                ->first();

            if ($existingKunjungan) {
                // Jika data kunjungan sudah ada, redirect dengan pesan error
                return redirect()->back()->with('error', 'Kunjungan untuk anggota keluarga ini tersebut sudah ada. Edit saja ');
            }

            // Validasi data
            $validatedData = $request->validate([
                'anggota_keluarga_id' => 'required|exists:anggota_keluargas,id',
                'waktu_kunjungan' => 'required|date',
                'tanggal' => 'required|date',
                'suhu_tubuh' => 'required|numeric',
                'ada_buku_kia' => 'required|boolean',
                'tanggal_terakhir_menimbang_mengukur' => 'nullable|date',
                'hasil_penimbangan' => 'nullable|string',
                'bb' => 'nullable|numeric',
                'pb_tb' => 'nullable|numeric',
                'lk' => 'nullable|numeric',
                'makanan_pokok' => 'nullable|boolean',
                'makanan_protein_hewani' => 'nullable|boolean',
                'makanan_protein_nabati' => 'nullable|boolean',
                'sumber_lemak' => 'nullable|boolean',
                'buah_sayur' => 'nullable|boolean',
                'ada_obat_cacing' => 'nullable|boolean',
                'waktu_minum_obat_cacing' => 'nullable|date',
                'ada_mt_pangan_lokal' => 'nullable|boolean',
                'kepatuhan_mt_pangan_lokal' => 'nullable|boolean',
                'pemberian_edukasi' => 'nullable|string|max:255',
                'paraf_ibu_balita' => 'nullable|string|max:255',
                'waktu_kunjungan_tanda_bahaya' => 'nullable|date',
                'napas_sesak' => 'nullable|boolean',
                'batuk' => 'nullable|boolean',
                'demam' => 'nullable|boolean',
                'diare' => 'nullable|boolean',
                'warna_kencing' => 'nullable|string|max:255',
                'warna_kulit' => 'nullable|string|max:255',
                'aktifitas' => 'nullable|string|max:255',
                'hisapan_bayi' => 'nullable|string|max:255',
                'pemberian_makanan' => 'nullable|string|max:255',
                'mengingatkan_periksa' => 'nullable|string|max:255',
                'melaporkan_ke_nakes' => 'nullable|date',
            ]);

            // Log data yang divalidasi
            Log::info('Data yang divalidasi: ', $validatedData);

            // Ambil data imunisasi dalam bentuk array multidimensional sesuai usia dan jenis imunisasi
            $imunisasi = [
                'usia_0_bulan' => [
                    'hepatitis_b' => $request->input('imunisasi.usia_0_bulan.hepatitis_b', false),
                    'bcg' => $request->input('imunisasi.usia_0_bulan.bcg', false),
                    'polio_tetes_1' => $request->input('imunisasi.usia_0_bulan.polio_tetes_1', false),
                ],
                'usia_2_bulan' => [
                    'dpt_hb_hib_1' => $request->input('imunisasi.usia_2_bulan.dpt_hb_hib_1', false),
                    'polio_tetes_2' => $request->input('imunisasi.usia_2_bulan.polio_tetes_2', false),
                    'pcv_1' => $request->input('imunisasi.usia_2_bulan.pcv_1', false),
                    'rv_1' => $request->input('imunisasi.usia_2_bulan.rv_1', false),
                ],
                'usia_3_bulan' => [
                    'dpt_hb_hib_2' => $request->input('imunisasi.usia_3_bulan.dpt_hb_hib_2', false),
                    'polio_tetes_3' => $request->input('imunisasi.usia_3_bulan.polio_tetes_3', false),
                    'pcv_2' => $request->input('imunisasi.usia_3_bulan.pcv_2', false),
                    'rv_2' => $request->input('imunisasi.usia_3_bulan.rv_2', false),
                ],
                'usia_4_bulan' => [
                    'dpt_hb_hib_3' => $request->input('imunisasi.usia_4_bulan.dpt_hb_hib_3', false),
                    'polio_tetes_4' => $request->input('imunisasi.usia_4_bulan.polio_tetes_4', false),
                    'polio_suntik_1' => $request->input('imunisasi.usia_4_bulan.polio_suntik_1', false),
                    'rv_3' => $request->input('imunisasi.usia_4_bulan.rv_3', false),
                ],
                'usia_9_bulan' => [
                    'campak_rubella' => $request->input('imunisasi.usia_9_bulan.campak_rubella', false),
                    'polio_suntik_2' => $request->input('imunisasi.usia_9_bulan.polio_suntik_2', false),
                ],
                'usia_10_bulan' => [
                    'je' => $request->input('imunisasi.usia_10_bulan.je', false),
                ],
                'usia_12_bulan' => [
                    'pcv_3' => $request->input('imunisasi.usia_12_bulan.pcv_3', false),
                ],
                'usia_18_bulan' => [
                    'dpt_hb_hib_lanjutan' => $request->input('imunisasi.usia_18_bulan.dpt_hb_hib_lanjutan', false),
                    'campak_rubella_lanjutan' => $request->input('imunisasi.usia_18_bulan.campak_rubella_lanjutan', false),
                ]
            ];

            // Log data imunisasi
            Log::info('Data imunisasi yang akan disimpan: ', $imunisasi);

            // Gabungkan data yang divalidasi dengan data imunisasi
            $validatedData['imunisasi'] = $imunisasi;

            // Log gabungan data sebelum disimpan
            Log::info('Data yang akan disimpan ke database: ', $validatedData);

            // Simpan data ke database
            KunjunganRumahBalitaApras::create($validatedData);

            // Log setelah data disimpan
            Log::info('Data kunjungan berhasil disimpan: ', ['anggota_keluarga_id' => $validatedData['anggota_keluarga_id']]);

            // Redirect dengan pesan sukses
            return redirect()->route('kunjungan-rumah-balita-apras.index')->with('success', 'Data kunjungan berhasil ditambahkan.');

        } catch (Exception $e) {
            // Log error
            Log::error('Terjadi kesalahan saat menyimpan data kunjungan: ', ['error' => $e->getMessage()]);

            // Redirect dengan pesan error
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi.');
        }
    }



    // Menampilkan form untuk mengedit kunjungan rumah
    public function edit($id)
    {
        $kunjungan = KunjunganRumahBalitaApras::findOrFail($id);
        $anggotaKeluargas = AnggotaKeluarga::all();
        return view('kunjungan-rumah-balita-apras.edit', compact('kunjungan', 'anggotaKeluargas'));
    }

    public function update(Request $request, $id)
    {
        try {
            // Temukan kunjungan yang akan diupdate berdasarkan ID
            $kunjungan = KunjunganRumahBalitaApras::findOrFail($id);
    
            // Validasi data
            $validatedData = $request->validate([
                'anggota_keluarga_id' => 'required|exists:anggota_keluargas,id',
                'waktu_kunjungan' => 'required|date',
                'tanggal' => 'required|date',
                'suhu_tubuh' => 'required|numeric',
                'ada_buku_kia' => 'required|boolean',
                'tanggal_terakhir_menimbang_mengukur' => 'nullable|date',
                'hasil_penimbangan' => 'nullable|string',
                'bb' => 'nullable|numeric',
                'pb_tb' => 'nullable|numeric',
                'lk' => 'nullable|numeric',
                'makanan_pokok' => 'nullable|boolean',
                'makanan_protein_hewani' => 'nullable|boolean',
                'makanan_protein_nabati' => 'nullable|boolean',
                'sumber_lemak' => 'nullable|boolean',
                'buah_sayur' => 'nullable|boolean',
                'ada_obat_cacing' => 'nullable|boolean',
                'waktu_minum_obat_cacing' => 'nullable|date',
                'ada_mt_pangan_lokal' => 'nullable|boolean',
                'kepatuhan_mt_pangan_lokal' => 'nullable|boolean',
                'pemberian_edukasi' => 'nullable|string|max:255',
                'paraf_ibu_balita' => 'nullable|string|max:255',
                'waktu_kunjungan_tanda_bahaya' => 'nullable|date',
                'napas_sesak' => 'nullable|boolean',
                'batuk' => 'nullable|boolean',
                'demam' => 'nullable|boolean',
                'diare' => 'nullable|boolean',
                'warna_kencing' => 'nullable|string|max:255',
                'warna_kulit' => 'nullable|string|max:255',
                'aktifitas' => 'nullable|string|max:255',
                'hisapan_bayi' => 'nullable|string|max:255',
                'pemberian_makanan' => 'nullable|string|max:255',
                'mengingatkan_periksa' => 'nullable|string|max:255',
                'melaporkan_ke_nakes' => 'nullable|date',
            ]);
    
            // Log data yang divalidasi
            Log::info('Data yang divalidasi: ', $validatedData);
    
            // Ambil data imunisasi dalam bentuk array multidimensional sesuai usia dan jenis imunisasi
            $imunisasi = [
                'usia_0_bulan' => [
                    'hepatitis_b' => $request->input('imunisasi.usia_0_bulan.hepatitis_b', false),
                    'bcg' => $request->input('imunisasi.usia_0_bulan.bcg', false),
                    'polio_tetes_1' => $request->input('imunisasi.usia_0_bulan.polio_tetes_1', false),
                ],
                'usia_2_bulan' => [
                    'dpt_hb_hib_1' => $request->input('imunisasi.usia_2_bulan.dpt_hb_hib_1', false),
                    'polio_tetes_2' => $request->input('imunisasi.usia_2_bulan.polio_tetes_2', false),
                    'pcv_1' => $request->input('imunisasi.usia_2_bulan.pcv_1', false),
                    'rv_1' => $request->input('imunisasi.usia_2_bulan.rv_1', false),
                ],
                'usia_3_bulan' => [
                    'dpt_hb_hib_2' => $request->input('imunisasi.usia_3_bulan.dpt_hb_hib_2', false),
                    'polio_tetes_3' => $request->input('imunisasi.usia_3_bulan.polio_tetes_3', false),
                    'pcv_2' => $request->input('imunisasi.usia_3_bulan.pcv_2', false),
                    'rv_2' => $request->input('imunisasi.usia_3_bulan.rv_2', false),
                ],
                'usia_4_bulan' => [
                    'dpt_hb_hib_3' => $request->input('imunisasi.usia_4_bulan.dpt_hb_hib_3', false),
                    'polio_tetes_4' => $request->input('imunisasi.usia_4_bulan.polio_tetes_4', false),
                    'polio_suntik_1' => $request->input('imunisasi.usia_4_bulan.polio_suntik_1', false),
                    'rv_3' => $request->input('imunisasi.usia_4_bulan.rv_3', false),
                ],
                'usia_9_bulan' => [
                    'campak_rubella' => $request->input('imunisasi.usia_9_bulan.campak_rubella', false),
                    'polio_suntik_2' => $request->input('imunisasi.usia_9_bulan.polio_suntik_2', false),
                ],
                'usia_10_bulan' => [
                    'je' => $request->input('imunisasi.usia_10_bulan.je', false),
                ],
                'usia_12_bulan' => [
                    'pcv_3' => $request->input('imunisasi.usia_12_bulan.pcv_3', false),
                ],
                'usia_18_bulan' => [
                    'dpt_hb_hib_lanjutan' => $request->input('imunisasi.usia_18_bulan.dpt_hb_hib_lanjutan', false),
                    'campak_rubella_lanjutan' => $request->input('imunisasi.usia_18_bulan.campak_rubella_lanjutan', false),
                ]
            ];
    
            // Log data imunisasi
            Log::info('Data imunisasi yang akan diupdate: ', $imunisasi);
    
            // Gabungkan data yang divalidasi dengan data imunisasi
            $validatedData['imunisasi'] = $imunisasi;
    
            // Log gabungan data sebelum diupdate
            Log::info('Data yang akan diupdate ke database: ', $validatedData);
    
            // Update data di database
            $kunjungan->update($validatedData);
    
            // Log setelah data diupdate
            Log::info('Data kunjungan berhasil diupdate: ', ['anggota_keluarga_id' => $validatedData['anggota_keluarga_id']]);
    
            // Redirect dengan pesan sukses
            return redirect()->route('kunjungan-rumah-balita-apras.index')->with('success', 'Data kunjungan berhasil diupdate.');
    
        } catch (Exception $e) {
            // Log error
            Log::error('Terjadi kesalahan saat mengupdate data kunjungan: ', ['error' => $e->getMessage()]);
    
            // Redirect dengan pesan error
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengupdate data. Silakan coba lagi.');
        }
    }
    public function show($id)
    {
        $kunjungan = KunjunganRumahBalitaApras::findOrFail($id);
        
        return view('kunjungan-rumah-balita-apras.show', compact('kunjungan'));
    }
    // Menghapus kunjungan rumah balita dan apras
    public function destroy($id)
    {
        $kunjungan = KunjunganRumahBalitaApras::findOrFail($id);
        $kunjungan->delete();

        return redirect()->route('kunjungan-rumah-balita-apras.index')->with('success', 'Data kunjungan berhasil dihapus.');
    }
}
