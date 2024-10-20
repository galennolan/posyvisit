<?php

namespace App\Http\Controllers;

use App\Models\KunjunganIbuBersalinNifas;
use App\Models\AnggotaKeluarga;
use Illuminate\Http\Request;

class KunjunganIbuBersalinNifasController extends Controller
{
    public function index(Request $request)
    {
        $query = KunjunganIbuBersalinNifas::query();
    
        if ($request->has('search') && $request->search != '') {
            $query->where('nama_ibu', 'like', '%' . $request->search . '%');
        }
    
        // Paginate dengan 10 item per halaman
        $kunjungan_ibu_bersalin = $query->paginate(10);
    
        return view('kunjungan-ibu-bersalin.index', compact('kunjungan_ibu_bersalin'));
    }
    

    public function create(Request $request)
    {
        $anggotaKeluarga = AnggotaKeluarga::find($request->anggota_keluarga_id);
        return view('kunjungan-ibu-bersalin.create', compact('anggotaKeluarga'));
    }

    public function show($id)
    {
        $kunjungan = KunjunganIbuBersalinNifas::findOrFail($id);
        
        return view('kunjungan-ibu-bersalin.show', compact('kunjungan'));
    }
    


    public function store(Request $request)
    {
        KunjunganIbuBersalinNifas::create([
            'anggota_keluarga_id' => $request->anggota_keluarga_id,
            'nama_ibu' => $request->nama_ibu,
            'umur_ibu' => $request->umur_ibu,
            'tanggal_persalinan' => $request->tanggal_persalinan,
            'usia_kehamilan_saat_persalinan' => $request->usia_kehamilan_saat_persalinan,
            'kelahiran_anak_ke' => $request->kelahiran_anak_ke,
            'pukul_persalinan' => $request->pukul_persalinan,
            'penolong_persalinan' => $request->penolong_persalinan,
            'tempat_persalinan' => $request->tempat_persalinan,
            'keadaan_ibu' => $request->keadaan_ibu,
            'inisiasi_menyusu_dini' => $request->inisiasi_menyusu_dini,
        ]);

        KunjunganIbuBersalinNifas::create($request->all());
        
        return redirect()->route('kunjungan-ibu-bersalin.index')->with('success', 'Data kunjungan Ibu Bersalin Nifas berhasil disimpan.');
    }

    public function edit($id)
    {
        $kunjungan = KunjunganIbuBersalinNifas::findOrFail($id);
        return view('kunjungan-ibu-bersalin.edit', compact('kunjungan'));
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

        return redirect()->route('kunjungan-ibu-bersalin.index')->with('success', 'Data kunjungan berhasil diupdate.');
    }

    public function destroy($id)
    {
        $kunjungan = KunjunganIbuBersalinNifas::findOrFail($id);
        $kunjungan->delete();

        return redirect()->route('kunjungan-ibu-bersalin.index')->with('success', 'Data kunjungan berhasil dihapus.');
    }
}
