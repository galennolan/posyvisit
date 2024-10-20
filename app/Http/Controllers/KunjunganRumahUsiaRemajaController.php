<?php

namespace App\Http\Controllers;

use App\Models\KunjunganRumahUsiaRemaja;
use App\Models\AnggotaKeluarga;
use Illuminate\Http\Request;

class KunjunganRumahUsiaRemajaController extends Controller
{
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
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-Laki,Wanita',
            'waktu_kunjungan' => 'required|date',
            'tanggal_kunjungan' => 'required|date',
            'suhu_tubuh' => 'required|in:<37,5°C,≥37,5°C',
            'tanggal_terakhir_menimbang_mengukur' => 'nullable|date',
            'isi_piringku' => 'required|in:Sesuai,Tidak',
            'bb' => 'nullable|numeric',
            'tb' => 'nullable|numeric',
            'ada_ttd' => 'nullable|boolean',
            'minum_ttd' => 'nullable|boolean',
            'tanggal_pemeriksaan_anemia' => 'nullable|date',
            'perilaku_merokok' => 'nullable|in:Aktif,Pasif',
            'tekanan_darah_tanggal' => 'nullable|date',
            'gula_darah_tanggal' => 'nullable|date',
            'skring_kesehatan_jiwa_tanggal' => 'nullable|date',
            'pemberian_edukasi' => 'nullable|string',
            'paraf_remaja' => 'nullable|string|max:255',
        ]);
    
        KunjunganRumahUsiaRemaja::create($validated);
    
        return redirect()->route('checklist-kunjungan.index')->with('success', 'Data kunjungan berhasil disimpan.');
    }
    
}
