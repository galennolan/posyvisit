<?php

namespace App\Http\Controllers;

use App\Models\KunjunganIbuBersalinNifas;
use Illuminate\Http\Request;

class KunjunganIbuBersalinNifasController extends Controller
{
    public function index()
    {
        $kunjungans = KunjunganIbuBersalinNifas::all();
        return view('kunjungan_ibu_bersalin_nifas.index', compact('kunjungans'));
    }

    public function create()
    {
        return view('kunjungan_ibu_bersalin_nifas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'anggota_keluarga_id' => 'required|exists:anggota_keluargas,id',
            'nama_ibu' => 'required|string',
            'umur_ibu' => 'required|integer',
            'tanggal_persalinan' => 'required|date',
            'usia_kehamilan_saat_persalinan' => 'required|integer',
            'kelahiran_anak_ke' => 'required|integer',
            'pukul_persalinan' => 'required',
            'penolong_persalinan' => 'required|string',
            'tempat_persalinan' => 'required|string',
            'keadaan_ibu' => 'required|string',
            'inisiasi_menyusu_dini' => 'required|boolean',
        ]);

        KunjunganIbuBersalinNifas::create($request->all());

        return redirect()->route('kunjungan_ibu_bersalin_nifas.index')->with('success', 'Data kunjungan berhasil disimpan.');
    }

    public function edit($id)
    {
        $kunjungan = KunjunganIbuBersalinNifas::findOrFail($id);
        return view('kunjungan_ibu_bersalin_nifas.edit', compact('kunjungan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_ibu' => 'required|string',
            'umur_ibu' => 'required|integer',
            'tanggal_persalinan' => 'required|date',
            'usia_kehamilan_saat_persalinan' => 'required|integer',
            'kelahiran_anak_ke' => 'required|integer',
            'pukul_persalinan' => 'required',
            'penolong_persalinan' => 'required|string',
            'tempat_persalinan' => 'required|string',
            'keadaan_ibu' => 'required|string',
            'inisiasi_menyusu_dini' => 'required|boolean',
        ]);

        $kunjungan = KunjunganIbuBersalinNifas::findOrFail($id);
        $kunjungan->update($request->all());

        return redirect()->route('kunjungan_ibu_bersalin_nifas.index')->with('success', 'Data kunjungan berhasil diupdate.');
    }

    public function destroy($id)
    {
        $kunjungan = KunjunganIbuBersalinNifas::findOrFail($id);
        $kunjungan->delete();

        return redirect()->route('kunjungan_ibu_bersalin_nifas.index')->with('success', 'Data kunjungan berhasil dihapus.');
    }
}
