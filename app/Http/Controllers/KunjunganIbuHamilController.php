<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KunjunganIbuHamil;
use App\Models\AnggotaKeluarga;

class KunjunganIbuHamilController extends Controller
{
    public function index()
    {
        $kunjungans = KunjunganIbuHamil::with('anggotaKeluarga')->get();
        return view('kunjungan.index', compact('kunjungans'));
    }

    public function create(Request $request)
    {
        $anggotaKeluarga = AnggotaKeluarga::find($request->anggota_keluarga_id);
        return view('kunjungan.create', compact('anggotaKeluarga'));
    }
    

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'anggota_keluarga_id' => 'required|string',
            'umur' => 'required|integer',
            'kehamilan_ke' => 'required|integer',
            'jarak_kehamilan' => 'nullable|string',
            'waktu_kunjungan' => 'required|date',
            'tanggal_kunjungan' => 'required|date',
            'suhu_tubuh' => 'nullable|numeric',
            'buku_kia' => 'required|string',
    
            // Validasi untuk K1-K6
            'k1_tanggal' => 'nullable|date',
            'k1_tempat' => 'nullable|string',
            'k1_petugas' => 'nullable|string',
            'k2_tanggal' => 'nullable|date',
            'k2_tempat' => 'nullable|string',
            'k2_petugas' => 'nullable|string',
            'k3_tanggal' => 'nullable|date',
            'k3_tempat' => 'nullable|string',
            'k3_petugas' => 'nullable|string',
            'k4_tanggal' => 'nullable|date',
            'k4_tempat' => 'nullable|string',
            'k4_petugas' => 'nullable|string',
            'k5_tanggal' => 'nullable|date',
            'k5_tempat' => 'nullable|string',
            'k5_petugas' => 'nullable|string',
            'k6_tanggal' => 'nullable|date',
            'k6_tempat' => 'nullable|string',
            'k6_petugas' => 'nullable|string',
    
            'isi_piringku' => 'required|string',
            'ttd' => 'required|string',
            'ttd_dikonsumsi' => 'nullable|string',
            'lila' => 'nullable|string',
            'pmt_bumil_kek' => 'nullable|string',
    
            // Validasi untuk Kelas Ibu Hamil, Skrining Kesehatan Jiwa, dan Edukasi
            'kelas_tanggal' => 'nullable|date',
            'kelas_tempat' => 'nullable|string',
            'kelas_pendamping' => 'nullable|string',
            'skrining_tanggal' => 'nullable|date',
            'skrining_tempat' => 'nullable|string',
            'skrining_petugas' => 'nullable|string',
            'edukasi_tanggal' => 'nullable|date',
            'edukasi_materi' => 'nullable|string',
        ]);
    
        // Menyimpan data ke dalam model
        $kunjungan = new KunjunganIbuHamil();
        $kunjungan->anggota_keluarga_id = $request->anggota_keluarga_id;
        $kunjungan->umur = $request->umur;
        $kunjungan->kehamilan_ke = $request->kehamilan_ke;
        $kunjungan->jarak_kehamilan = $request->jarak_kehamilan;
        $kunjungan->waktu_kunjungan = $request->waktu_kunjungan;
        $kunjungan->tanggal_kunjungan = $request->tanggal_kunjungan;
        $kunjungan->suhu_tubuh = $request->suhu_tubuh;
        $kunjungan->buku_kia = $request->buku_kia;
    
        // Menyimpan data K1-K6
        $kunjungan->k1 = [
            'tanggal' => $request->k1_tanggal,
            'tempat' => $request->k1_tempat,
            'petugas' => $request->k1_petugas
        ];
        $kunjungan->k2 = [
            'tanggal' => $request->k2_tanggal,
            'tempat' => $request->k2_tempat,
            'petugas' => $request->k2_petugas
        ];
        $kunjungan->k3 = [
            'tanggal' => $request->k3_tanggal,
            'tempat' => $request->k3_tempat,
            'petugas' => $request->k3_petugas
        ];
        $kunjungan->k4 = [
            'tanggal' => $request->k4_tanggal,
            'tempat' => $request->k4_tempat,
            'petugas' => $request->k4_petugas
        ];
        $kunjungan->k5 = [
            'tanggal' => $request->k5_tanggal,
            'tempat' => $request->k5_tempat,
            'petugas' => $request->k5_petugas
        ];
        $kunjungan->k6 = [
            'tanggal' => $request->k6_tanggal,
            'tempat' => $request->k6_tempat,
            'petugas' => $request->k6_petugas
        ];
    
        // Menyimpan data lainnya
        $kunjungan->isi_piringku = $request->isi_piringku;
        $kunjungan->ttd = $request->ttd;
        $kunjungan->ttd_dikonsumsi = $request->ttd_dikonsumsi;
        $kunjungan->lila = $request->lila;
        $kunjungan->pmt_bumil_kek = $request->pmt_bumil_kek;
    
        // Menyimpan data Kelas Ibu Hamil, Skrining Kesehatan Jiwa, dan Edukasi sebagai JSON
        $kunjungan->kelas_ibu_hamil = json_encode([
            'tanggal' => $request->kelas_tanggal,
            'tempat' => $request->kelas_tempat,
            'pendamping' => $request->kelas_pendamping
        ]);
        $kunjungan->skrining_jiwa = json_encode([
            'tanggal' => $request->skrining_tanggal,
            'tempat' => $request->skrining_tempat,
            'petugas' => $request->skrining_petugas
        ]);
        $kunjungan->edukasi = json_encode([
            'tanggal' => $request->edukasi_tanggal,
            'materi' => $request->edukasi_materi
        ]);
    
        // Menyimpan data ke database
        $kunjungan->save();
    
        // Redirect setelah data berhasil disimpan
        return redirect()->route('kunjungan.index')->with('success', 'Data kunjungan ibu hamil berhasil disimpan.');
    }
    
    public function show($id)
    {
        $kunjungan = KunjunganIbuHamil::with('anggotaKeluarga')->findOrFail($id);
        
        if (request()->ajax()) {
            return view('kunjungan.partials.detail', compact('kunjungan'));
        }
    
        return view('kunjungan.show', compact('kunjungan'));
    }
    
    
    public function edit($id)
    {
        $kunjungan = KunjunganIbuHamil::findOrFail($id);
        return view('kunjungan.edit', compact('kunjungan'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'anggota_keluarga_id' => 'required|string',
            'umur' => 'required|integer',
            'kehamilan_ke' => 'required|integer',
            'jarak_kehamilan' => 'nullable|string',
            'waktu_kunjungan' => 'required|date',
            'tanggal_kunjungan' => 'required|date',
            'suhu_tubuh' => 'nullable|numeric',
            'buku_kia' => 'required|string',

            // Validasi untuk K1-K6
            'k1_tanggal' => 'nullable|date',
            'k1_tempat' => 'nullable|string',
            'k1_petugas' => 'nullable|string',
            'k2_tanggal' => 'nullable|date',
            'k2_tempat' => 'nullable|string',
            'k2_petugas' => 'nullable|string',
            'k3_tanggal' => 'nullable|date',
            'k3_tempat' => 'nullable|string',
            'k3_petugas' => 'nullable|string',
            'k4_tanggal' => 'nullable|date',
            'k4_tempat' => 'nullable|string',
            'k4_petugas' => 'nullable|string',
            'k5_tanggal' => 'nullable|date',
            'k5_tempat' => 'nullable|string',
            'k5_petugas' => 'nullable|string',
            'k6_tanggal' => 'nullable|date',
            'k6_tempat' => 'nullable|string',
            'k6_petugas' => 'nullable|string',

            'isi_piringku' => 'required|string',
            'ttd' => 'required|string',
            'ttd_dikonsumsi' => 'nullable|string',
            'lila' => 'nullable|string',
            'pmt_bumil_kek' => 'nullable|string',

            // Validasi untuk Kelas Ibu Hamil, Skrining Kesehatan Jiwa, dan Edukasi
            'kelas_tanggal' => 'nullable|date',
            'kelas_tempat' => 'nullable|string',
            'kelas_pendamping' => 'nullable|string',
            'skrining_tanggal' => 'nullable|date',
            'skrining_tempat' => 'nullable|string',
            'skrining_petugas' => 'nullable|string',
            'edukasi_tanggal' => 'nullable|date',
            'edukasi_materi' => 'nullable|string',
        ]);

        // Cari data kunjungan yang akan diupdate
        $kunjungan = KunjunganIbuHamil::findOrFail($id);

        // Update data dasar
        $kunjungan->anggota_keluarga_id = $request->anggota_keluarga_id;
        $kunjungan->umur = $request->umur;
        $kunjungan->kehamilan_ke = $request->kehamilan_ke;
        $kunjungan->jarak_kehamilan = $request->jarak_kehamilan;
        $kunjungan->waktu_kunjungan = $request->waktu_kunjungan;
        $kunjungan->tanggal_kunjungan = $request->tanggal_kunjungan;
        $kunjungan->suhu_tubuh = $request->suhu_tubuh;
        $kunjungan->buku_kia = $request->buku_kia;

        // Update data K1-K6
        $kunjungan->k1 = [
            'tanggal' => $request->k1_tanggal,
            'tempat' => $request->k1_tempat,
            'petugas' => $request->k1_petugas
        ];
        $kunjungan->k2 = [
            'tanggal' => $request->k2_tanggal,
            'tempat' => $request->k2_tempat,
            'petugas' => $request->k2_petugas
        ];
        $kunjungan->k3 = [
            'tanggal' => $request->k3_tanggal,
            'tempat' => $request->k3_tempat,
            'petugas' => $request->k3_petugas
        ];
        $kunjungan->k4 = [
            'tanggal' => $request->k4_tanggal,
            'tempat' => $request->k4_tempat,
            'petugas' => $request->k4_petugas
        ];
        $kunjungan->k5 = [
            'tanggal' => $request->k5_tanggal,
            'tempat' => $request->k5_tempat,
            'petugas' => $request->k5_petugas
        ];
        $kunjungan->k6 = [
            'tanggal' => $request->k6_tanggal,
            'tempat' => $request->k6_tempat,
            'petugas' => $request->k6_petugas
        ];

        // Update data lainnya
        $kunjungan->isi_piringku = $request->isi_piringku;
        $kunjungan->ttd = $request->ttd;
        $kunjungan->ttd_dikonsumsi = $request->ttd_dikonsumsi;
        $kunjungan->lila = $request->lila;
        $kunjungan->pmt_bumil_kek = $request->pmt_bumil_kek;

        // Update data Kelas Ibu Hamil, Skrining Kesehatan Jiwa, dan Edukasi sebagai JSON
        $kunjungan->kelas_ibu_hamil = json_encode([
            'tanggal' => $request->kelas_tanggal,
            'tempat' => $request->kelas_tempat,
            'pendamping' => $request->kelas_pendamping
        ]);
        $kunjungan->skrining_jiwa = json_encode([
            'tanggal' => $request->skrining_tanggal,
            'tempat' => $request->skrining_tempat,
            'petugas' => $request->skrining_petugas
        ]);
        $kunjungan->edukasi = json_encode([
            'tanggal' => $request->edukasi_tanggal,
            'materi' => $request->edukasi_materi
        ]);

        // Simpan perubahan ke database
        $kunjungan->save();

        // Redirect setelah data berhasil diperbarui
        return redirect()->route('kunjungan.index')->with('success', 'Data kunjungan ibu hamil berhasil diperbarui.');
    }


    public function destroy($id)
    {
        $kunjungan = KunjunganIbuHamil::findOrFail($id);
        $kunjungan->delete();

        return redirect()->route('kunjungan.index')->with('success', 'Data kunjungan berhasil dihapus.');
    }
}
