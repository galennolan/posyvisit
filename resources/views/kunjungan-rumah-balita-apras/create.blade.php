<x-app-layout>
        <x-slot name="header">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Tambah Data Kunjungan Rumah Balita dan Apras') }}
            </h2>
            <nav class="breadcrumb">
                <ol class="list-reset flex text-sm">
                    <li><a href="/dashboard" class="text-blue-600 hover:text-blue-800">Home</a></li>
                    <li><span class="mx-2">/</span></li>
                    <li><a href="{{ route('kunjungan-rumah-balita-apras.index') }}" class="text-blue-600 hover:text-blue-800">Kunjungan Rumah Balita dan Apras</a></li>
                    <li><span class="mx-2">/</span></li>
                    <li class="text-blue-600 font-semibold">Tambah</li>
                </ol>
            </nav>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white shadow-lg rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-700 mb-4">Formulir Tambah Kunjungan</h3>

                    <form action="{{ route('kunjungan-rumah-balita-apras.store') }}" method="POST">
                        @csrf

                        <!-- Grid untuk membagi form menjadi dua kolom pada desktop dan satu kolom pada mobile -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                            <!-- Nama Balita atau Pra sekolah -->
                        <div class="mb-4">
                                <label for="nama_ibu" class="block text-sm font-medium text-gray-700">Nama Balita atau Pra sekolah</label>
                                <!-- Input hidden untuk mengirim id Balita atau Pra sekolah -->
                                <input type="hidden" name="anggota_keluarga_id" value="{{ $anggotaKeluarga->id }}">
                                @if(isset($anggotaKeluarga))
                                    <!-- Input hidden untuk mengirim nama Balita atau Pra sekolah -->
                                    <input type="hidden" name="nama_ibu" value="{{ $anggotaKeluarga->nama_lengkap }}">
                                    <p class="mt-1 text-sm text-gray-800 bg-gray-100 p-2 rounded">{{ $anggotaKeluarga->nama_lengkap }}</p>
                                @else
                                    <p class="mt-1 text-sm text-gray-800 bg-gray-100 p-2 rounded">-</p>
                                @endif
                            </div>

                            <!-- Umur Balita -->
                            <div class="mb-4">
                                <label for="umur_balita" class="block text-sm font-medium text-gray-700">Umur Balita atau Pra sekolah</label>
                                @if(isset($anggotaKeluarga) && $anggotaKeluarga->tanggal_lahir)
                                    @php
                                        $tanggalLahir = \Carbon\Carbon::parse($anggotaKeluarga->tanggal_lahir);
                                        $umur = $tanggalLahir->age;
                                    @endphp
                                    <!-- Input hidden untuk mengirim umur Balita atau Pra sekolah -->
                                    <input type="hidden" name="umur_balita" value="{{ $umur }}">
                                    <input type="number" id="umur" name="umur" value="{{ $umur }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 bg-gray-100" readonly>
                                @else
                                    <input type="number" id="umur" name="umur" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                                @endif
                            </div>

                            <!-- Waktu Kunjungan -->
                            <div class="mb-4">
                                <label for="waktu_kunjungan" class="block text-sm font-medium text-gray-700">Waktu Kunjungan</label>
                                <input type="date" name="waktu_kunjungan" id="waktu_kunjungan" value="{{ old('waktu_kunjungan') }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm" required>
                            </div>

                            <!-- Tanggal -->
                            <div class="mb-4">
                                <label for="tanggal" class="block text-sm font-medium text-gray-700">Tanggal</label>
                                <input type="date" name="tanggal" id="tanggal" value="{{ old('tanggal') }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm" required>
                            </div>

                            <!-- Suhu Tubuh -->
                            <div class="mb-4">
                                <label for="suhu_tubuh" class="block text-sm font-medium text-gray-700">Suhu Tubuh (°C)</label>
                                <input type="number" name="suhu_tubuh" id="suhu_tubuh" value="{{ old('suhu_tubuh') }}" step="0.1" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm" required>
                            </div>

                            <!-- Ada Buku KIA -->
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700">Ada Buku KIA</label>
                                <div class="mt-1">
                                    <label class="inline-flex items-center">
                                        <input type="radio" name="ada_buku_kia" value="1" class="form-radio" required>
                                        <span class="ml-2">Ya</span>
                                    </label>
                                    <label class="inline-flex items-center ml-4">
                                        <input type="radio" name="ada_buku_kia" value="0" class="form-radio" required>
                                        <span class="ml-2">Tidak</span>
                                    </label>
                                </div>
                            </div>

                            <!-- Tanggal Terakhir Menimbang dan Mengukur -->
                            <div class="mb-4">
                                <label for="tanggal_terakhir_menimbang_mengukur" class="block text-sm font-medium text-gray-700">Tanggal Terakhir Menimbang dan Mengukur</label>
                                <input type="date" name="tanggal_terakhir_menimbang_mengukur" id="tanggal_terakhir_menimbang_mengukur" value="{{ old('tanggal_terakhir_menimbang_mengukur') }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
                            </div>

                            <!-- Hasil Penimbangan dan Pengukuran -->
                            <div class="mb-4">
                                <label for="hasil_penimbangan" class="block text-sm font-medium text-gray-700">Hasil Penimbangan dan Pengukuran</label>
                                <textarea name="hasil_penimbangan" id="hasil_penimbangan" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">{{ old('hasil_penimbangan') }}</textarea>
                            </div>

                           <!-- BB (Berat Badan) dan PB/TB (Tinggi Badan) dalam satu baris -->
                            <div class="mb-4">
                                <div class="flex space-x-4">
                                    <!-- BB (Berat Badan) -->
                                    <div class="w-1/2">
                                        <label for="bb" class="block text-sm font-medium text-gray-700">BB (Berat Badan)</label>
                                        <input type="number" name="bb" id="bb" value="{{ old('bb') }}" step="0.1" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
                                    </div>

                                    <!-- PB/TB (Tinggi Badan) -->
                                    <div class="w-1/2">
                                        <label for="pb_tb" class="block text-sm font-medium text-gray-700">PB/TB (Tinggi Badan)</label>
                                        <input type="number" name="pb_tb" id="pb_tb" value="{{ old('pb_tb') }}" step="0.1" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
                                    </div>
                                </div>
                            </div>


                            <!-- LK (Lingkar Kepala) -->
                            <div class="mb-4">
                                <label for="lk" class="block text-sm font-medium text-gray-700">LK (Lingkar Kepala)</label>
                                <input type="number" name="lk" id="lk" value="{{ old('lk') }}" step="0.1" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
                            </div>
                            <!-- Imunisasi untuk Usia 0 Bulan -->
                    <!-- Imunisasi Usia 0 Bulan -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Usia 0 Bulan (Hepatitis B, BCG, Polio Tetes 1)</label>
                        <div>
                            <input type="checkbox" name="imunisasi[usia_0_bulan][hepatitis_b]" value="1" {{ old('imunisasi.usia_0_bulan.hepatitis_b', isset($kunjungan->imunisasi['usia_0_bulan']['hepatitis_b']) && $kunjungan->imunisasi['usia_0_bulan']['hepatitis_b']) ? 'checked' : '' }}> Hepatitis B
                        </div>
                        <div>
                            <input type="checkbox" name="imunisasi[usia_0_bulan][bcg]" value="1" {{ old('imunisasi.usia_0_bulan.bcg', isset($kunjungan->imunisasi['usia_0_bulan']['bcg']) && $kunjungan->imunisasi['usia_0_bulan']['bcg']) ? 'checked' : '' }}> BCG
                        </div>
                        <div>
                            <input type="checkbox" name="imunisasi[usia_0_bulan][polio_tetes_1]" value="1" {{ old('imunisasi.usia_0_bulan.polio_tetes_1', isset($kunjungan->imunisasi['usia_0_bulan']['polio_tetes_1']) && $kunjungan->imunisasi['usia_0_bulan']['polio_tetes_1']) ? 'checked' : '' }}> Polio Tetes 1
                        </div>
                    </div>

                    <!-- Imunisasi Usia 2 Bulan -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Usia 2 Bulan (DPT-HB-Hib 1, Polio Tetes 2, PCV 1, RV 1)</label>
                        <div>
                            <input type="checkbox" name="imunisasi[usia_2_bulan][dpt_hb_hib_1]" value="1" {{ old('imunisasi.usia_2_bulan.dpt_hb_hib_1', isset($kunjungan->imunisasi['usia_2_bulan']['dpt_hb_hib_1']) && $kunjungan->imunisasi['usia_2_bulan']['dpt_hb_hib_1']) ? 'checked' : '' }}> DPT-HB-Hib 1
                        </div>
                        <div>
                            <input type="checkbox" name="imunisasi[usia_2_bulan][polio_tetes_2]" value="1" {{ old('imunisasi.usia_2_bulan.polio_tetes_2', isset($kunjungan->imunisasi['usia_2_bulan']['polio_tetes_2']) && $kunjungan->imunisasi['usia_2_bulan']['polio_tetes_2']) ? 'checked' : '' }}> Polio Tetes 2
                        </div>
                        <div>
                            <input type="checkbox" name="imunisasi[usia_2_bulan][pcv_1]" value="1" {{ old('imunisasi.usia_2_bulan.pcv_1', isset($kunjungan->imunisasi['usia_2_bulan']['pcv_1']) && $kunjungan->imunisasi['usia_2_bulan']['pcv_1']) ? 'checked' : '' }}> PCV 1
                        </div>
                        <div>
                            <input type="checkbox" name="imunisasi[usia_2_bulan][rv_1]" value="1" {{ old('imunisasi.usia_2_bulan.rv_1', isset($kunjungan->imunisasi['usia_2_bulan']['rv_1']) && $kunjungan->imunisasi['usia_2_bulan']['rv_1']) ? 'checked' : '' }}> RV 1
                        </div>
                    </div>

                    <!-- Imunisasi Usia 3 Bulan -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Usia 3 Bulan (DPT-HB-Hib 2, Polio Tetes 3, PCV 2, RV 2)</label>
                        <div>
                            <input type="checkbox" name="imunisasi[usia_3_bulan][dpt_hb_hib_2]" value="1" {{ old('imunisasi.usia_3_bulan.dpt_hb_hib_2', isset($kunjungan->imunisasi['usia_3_bulan']['dpt_hb_hib_2']) && $kunjungan->imunisasi['usia_3_bulan']['dpt_hb_hib_2']) ? 'checked' : '' }}> DPT-HB-Hib 2
                        </div>
                        <div>
                            <input type="checkbox" name="imunisasi[usia_3_bulan][polio_tetes_3]" value="1" {{ old('imunisasi.usia_3_bulan.polio_tetes_3', isset($kunjungan->imunisasi['usia_3_bulan']['polio_tetes_3']) && $kunjungan->imunisasi['usia_3_bulan']['polio_tetes_3']) ? 'checked' : '' }}> Polio Tetes 3
                        </div>
                        <div>
                            <input type="checkbox" name="imunisasi[usia_3_bulan][pcv_2]" value="1" {{ old('imunisasi.usia_3_bulan.pcv_2', isset($kunjungan->imunisasi['usia_3_bulan']['pcv_2']) && $kunjungan->imunisasi['usia_3_bulan']['pcv_2']) ? 'checked' : '' }}> PCV 2
                        </div>
                        <div>
                            <input type="checkbox" name="imunisasi[usia_3_bulan][rv_2]" value="1" {{ old('imunisasi.usia_3_bulan.rv_2', isset($kunjungan->imunisasi['usia_3_bulan']['rv_2']) && $kunjungan->imunisasi['usia_3_bulan']['rv_2']) ? 'checked' : '' }}> RV 2
                        </div>
                    </div>

                    <!-- Imunisasi Usia 4 Bulan -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Usia 4 Bulan (DPT-HB-Hib 3, Polio Tetes 4, Polio Suntik (IPV) 1, RV 3)</label>
                        <div>
                            <input type="checkbox" name="imunisasi[usia_4_bulan][dpt_hb_hib_3]" value="1" {{ old('imunisasi.usia_4_bulan.dpt_hb_hib_3', isset($kunjungan->imunisasi['usia_4_bulan']['dpt_hb_hib_3']) && $kunjungan->imunisasi['usia_4_bulan']['dpt_hb_hib_3']) ? 'checked' : '' }}> DPT-HB-Hib 3
                        </div>
                        <div>
                            <input type="checkbox" name="imunisasi[usia_4_bulan][polio_tetes_4]" value="1" {{ old('imunisasi.usia_4_bulan.polio_tetes_4', isset($kunjungan->imunisasi['usia_4_bulan']['polio_tetes_4']) && $kunjungan->imunisasi['usia_4_bulan']['polio_tetes_4']) ? 'checked' : '' }}> Polio Tetes 4
                        </div>
                        <div>
                            <input type="checkbox" name="imunisasi[usia_4_bulan][polio_suntik_1]" value="1" {{ old('imunisasi.usia_4_bulan.polio_suntik_1', isset($kunjungan->imunisasi['usia_4_bulan']['polio_suntik_1']) && $kunjungan->imunisasi['usia_4_bulan']['polio_suntik_1']) ? 'checked' : '' }}> Polio Suntik (IPV) 1
                        </div>
                        <div>
                            <input type="checkbox" name="imunisasi[usia_4_bulan][rv_3]" value="1" {{ old('imunisasi.usia_4_bulan.rv_3', isset($kunjungan->imunisasi['usia_4_bulan']['rv_3']) && $kunjungan->imunisasi['usia_4_bulan']['rv_3']) ? 'checked' : '' }}> RV 3
                        </div>
                    </div>

                    <!-- Imunisasi Usia 9 Bulan -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Usia 9 Bulan (Campak-Rubella, Polio Suntik (IPV) 2)</label>
                        <div>
                            <input type="checkbox" name="imunisasi[usia_9_bulan][campak_rubella]" value="1" {{ old('imunisasi.usia_9_bulan.campak_rubella', isset($kunjungan->imunisasi['usia_9_bulan']['campak_rubella']) && $kunjungan->imunisasi['usia_9_bulan']['campak_rubella']) ? 'checked' : '' }}> Campak-Rubella
                        </div>
                        <div>
                            <input type="checkbox" name="imunisasi[usia_9_bulan][polio_suntik_2]" value="1" {{ old('imunisasi.usia_9_bulan.polio_suntik_2', isset($kunjungan->imunisasi['usia_9_bulan']['polio_suntik_2']) && $kunjungan->imunisasi['usia_9_bulan']['polio_suntik_2']) ? 'checked' : '' }}> Polio Suntik (IPV) 2
                        </div>
                    </div>

                    <!-- Imunisasi Usia 10 Bulan -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Usia 10 Bulan (Japanese Encephalitis (JE))</label>
                        <div>
                            <input type="checkbox" name="imunisasi[usia_10_bulan][je]" value="1" {{ old('imunisasi.usia_10_bulan.je', isset($kunjungan->imunisasi['usia_10_bulan']['je']) && $kunjungan->imunisasi['usia_10_bulan']['je']) ? 'checked' : '' }}> Japanese Encephalitis (JE)
                        </div>
                    </div>

                    <!-- Imunisasi Usia 12 Bulan -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Usia 12 Bulan (PCV 3)</label>
                        <div>
                            <input type="checkbox" name="imunisasi[usia_12_bulan][pcv_3]" value="1" {{ old('imunisasi.usia_12_bulan.pcv_3', isset($kunjungan->imunisasi['usia_12_bulan']['pcv_3']) && $kunjungan->imunisasi['usia_12_bulan']['pcv_3']) ? 'checked' : '' }}> PCV 3
                        </div>
                    </div>

                    <!-- Imunisasi Usia 18 Bulan -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Usia 18 Bulan (DPT-HB-Hib Lanjutan, Campak-Rubella Lanjutan)</label>
                        <div>
                            <input type="checkbox" name="imunisasi[usia_18_bulan][dpt_hb_hib_lanjutan]" value="1" {{ old('imunisasi.usia_18_bulan.dpt_hb_hib_lanjutan', isset($kunjungan->imunisasi['usia_18_bulan']['dpt_hb_hib_lanjutan']) && $kunjungan->imunisasi['usia_18_bulan']['dpt_hb_hib_lanjutan']) ? 'checked' : '' }}> DPT-HB-Hib Lanjutan
                        </div>
                        <div>
                            <input type="checkbox" name="imunisasi[usia_18_bulan][campak_rubella_lanjutan]" value="1" {{ old('imunisasi.usia_18_bulan.campak_rubella_lanjutan', isset($kunjungan->imunisasi['usia_18_bulan']['campak_rubella_lanjutan']) && $kunjungan->imunisasi['usia_18_bulan']['campak_rubella_lanjutan']) ? 'checked' : '' }}> Campak-Rubella Lanjutan
                        </div>
                    </div>


                    <div class="grid grid-cols-2 gap-4">
                    <!-- Makanan Pokok -->
                    <div class="mb-4">
                        <label for="makanan_pokok" class="block text-sm font-medium text-gray-700">Makanan Pokok (Beras/Kentang/Jagung)</label>
                        <input type="checkbox" name="makanan_pokok" id="makanan_pokok" value="1" {{ old('makanan_pokok') ? 'checked' : '' }} class="mt-1 block">
                    </div>

                    <!-- Makanan Sumber Protein Hewan -->
                    <div class="mb-4">
                        <label for="makanan_protein_hewani" class="block text-sm font-medium text-gray-700">Makanan Sumber Protein Hewan</label>
                        <input type="checkbox" name="makanan_protein_hewani" id="makanan_protein_hewani" value="1" {{ old('makanan_protein_hewani') ? 'checked' : '' }} class="mt-1 block">
                    </div>

                    <!-- Makanan Sumber Protein Nabati -->
                    <div class="mb-4">
                        <label for="makanan_protein_nabati" class="block text-sm font-medium text-gray-700">Makanan Sumber Protein Nabati</label>
                        <input type="checkbox" name="makanan_protein_nabati" id="makanan_protein_nabati" value="1" {{ old('makanan_protein_nabati') ? 'checked' : '' }} class="mt-1 block">
                    </div>

                    <!-- Sumber Lemak -->
                    <div class="mb-4">
                        <label for="sumber_lemak" class="block text-sm font-medium text-gray-700">Sumber Lemak (Minyak/Santan)</label>
                        <input type="checkbox" name="sumber_lemak" id="sumber_lemak" value="1" {{ old('sumber_lemak') ? 'checked' : '' }} class="mt-1 block">
                    </div>

                    <!-- Buah dan Sayur -->
                    <div class="mb-4">
                        <label for="buah_sayur" class="block text-sm font-medium text-gray-700">Buah dan Sayur</label>
                        <input type="checkbox" name="buah_sayur" id="buah_sayur" value="1" {{ old('buah_sayur') ? 'checked' : '' }} class="mt-1 block">
                    </div>

                    <!-- Ada Obat Cacing -->
                    <div class="mb-4">
                        <label for="ada_obat_cacing" class="block text-sm font-medium text-gray-700">Ada Obat Cacing</label>
                        <input type="checkbox" name="ada_obat_cacing" id="ada_obat_cacing" value="1" {{ old('ada_obat_cacing') ? 'checked' : '' }} class="mt-1 block">
                    </div>

                    <!-- Waktu Minum Obat Cacing -->
                    <div class="mb-4">
                        <label for="waktu_minum_obat_cacing" class="block text-sm font-medium text-gray-700">Waktu Minum Obat Cacing</label>
                        <input type="date" name="waktu_minum_obat_cacing" id="waktu_minum_obat_cacing" value="{{ old('waktu_minum_obat_cacing') }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
                    </div>

                    <!-- Usia 6-11 Bulan (Kapsul Biru) -->
                    <div class="mb-4">
                        <label for="usia_6_11_bulan_kapsul_biru" class="block text-sm font-medium text-gray-700">Usia 6-11 Bulan (Kapsul Biru)</label>
                        <input type="checkbox" name="usia_6_11_bulan_kapsul_biru" id="usia_6_11_bulan_kapsul_biru" value="1" {{ old('usia_6_11_bulan_kapsul_biru') ? 'checked' : '' }} class="mt-1 block">
                    </div>

                    <!-- Usia >11 Bulan (Kapsul Merah) -->
                    <div class="mb-4">
                        <label for="usia_lebih_11_bulan_kapsul_merah" class="block text-sm font-medium text-gray-700">Usia >11 Bulan (Kapsul Merah)</label>
                        <input type="checkbox" name="usia_lebih_11_bulan_kapsul_merah" id="usia_lebih_11_bulan_kapsul_merah" value="1" {{ old('usia_lebih_11_bulan_kapsul_merah') ? 'checked' : '' }} class="mt-1 block">
                    </div>

                    <!-- Ada MT Pangan Lokal -->
                    <div class="mb-4">
                        <label for="ada_mt_pangan_lokal" class="block text-sm font-medium text-gray-700">Ada MT Pangan Lokal</label>
                        <input type="checkbox" name="ada_mt_pangan_lokal" id="ada_mt_pangan_lokal" value="1" {{ old('ada_mt_pangan_lokal') ? 'checked' : '' }} class="mt-1 block">
                    </div>

                    <!-- Kepatuhan Konsumsi MT Pangan Lokal -->
                    <div class="mb-4">
                        <label for="kepatuhan_mt_pangan_lokal" class="block text-sm font-medium text-gray-700">Kepatuhan Konsumsi MT Pangan Lokal</label>
                        <input type="checkbox" name="kepatuhan_mt_pangan_lokal" id="kepatuhan_mt_pangan_lokal" value="1" {{ old('kepatuhan_mt_pangan_lokal') ? 'checked' : '' }} class="mt-1 block">
                    </div>

                    <!-- Pemberian Edukasi -->
                    <div class="mb-4 col-span-2">
                        <label for="pemberian_edukasi" class="block text-sm font-medium text-gray-700">Pemberian Edukasi/Kunjungan Nakes</label>
                        <textarea name="pemberian_edukasi" id="pemberian_edukasi" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">{{ old('pemberian_edukasi') }}</textarea>
                    </div>

                    <!-- Paraf Ibu Balita -->
                    <div class="mb-4 col-span-2">
                        <label for="paraf_ibu_balita" class="block text-sm font-medium text-gray-700">Paraf Ibu Balita/Apras</label>
                        <input type="text" name="paraf_ibu_balita" id="paraf_ibu_balita" value="{{ old('paraf_ibu_balita') }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
                    </div>
                </div>
                <!-- kolom kedua -->
                <div class="grid grid-cols-2 gap-4">
                <!-- Waktu Kunjungan -->
                <div class="mb-4">
                    <label for="waktu_kunjungan" class="block text-sm font-medium text-gray-700">Waktu Kunjungan</label>
                    <input type="date" name="waktu_kunjungan" id="waktu_kunjungan" value="{{ old('waktu_kunjungan') }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
                </div>

                <!-- Tanggal -->
                <div class="mb-4">
                    <label for="tanggal" class="block text-sm font-medium text-gray-700">Tanggal</label>
                    <input type="date" name="tanggal" id="tanggal" value="{{ old('tanggal') }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
                </div>

                <!-- Napas Sesak -->
                <div class="mb-4">
                    <label for="napas_sesak" class="block text-sm font-medium text-gray-700">Napas Sesak</label>
                    <input type="checkbox" name="napas_sesak" id="napas_sesak" value="1" {{ old('napas_sesak') ? 'checked' : '' }} class="mt-1 block">
                </div>

                <!-- Batuk -->
                <div class="mb-4">
                    <label for="batuk" class="block text-sm font-medium text-gray-700">Batuk</label>
                    <input type="checkbox" name="batuk" id="batuk" value="1" {{ old('batuk') ? 'checked' : '' }} class="mt-1 block">
                </div>

                <!-- Demam -->
                <div class="mb-4">
                    <label for="demam" class="block text-sm font-medium text-gray-700">Demam</label>
                    <input type="checkbox" name="demam" id="demam" value="1" {{ old('demam') ? 'checked' : '' }} class="mt-1 block">
                </div>

                <!-- Diare -->
                <div class="mb-4">
                    <label for="diare" class="block text-sm font-medium text-gray-700">Diare</label>
                    <input type="checkbox" name="diare" id="diare" value="1" {{ old('diare') ? 'checked' : '' }} class="mt-1 block">
                </div>

                <!-- Warna Kencing -->
                <div class="mb-4">
                    <label for="warna_kencing" class="block text-sm font-medium text-gray-700">Warna Kencing</label>
                    <input type="text" name="warna_kencing" id="warna_kencing" value="{{ old('warna_kencing') }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
                </div>

                <!-- Warna Kulit -->
                <div class="mb-4">
                    <label for="warna_kulit" class="block text-sm font-medium text-gray-700">Warna Kulit</label>
                    <input type="text" name="warna_kulit" id="warna_kulit" value="{{ old('warna_kulit') }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
                </div>

                <!-- Aktifitas -->
                <div class="mb-4">
                    <label for="aktifitas" class="block text-sm font-medium text-gray-700">Aktifitas</label>
                    <input type="text" name="aktifitas" id="aktifitas" value="{{ old('aktifitas') }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
                </div>

                <!-- Hisapan Bayi -->
                <div class="mb-4">
                    <label for="hisapan_bayi" class="block text-sm font-medium text-gray-700">Hisapan Bayi</label>
                    <input type="text" name="hisapan_bayi" id="hisapan_bayi" value="{{ old('hisapan_bayi') }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
                </div>

                <!-- Pemberian Makanan -->
                <div class="mb-4">
                    <label for="pemberian_makanan" class="block text-sm font-medium text-gray-700">Pemberian Makanan</label>
                    <input type="text" name="pemberian_makanan" id="pemberian_makanan" value="{{ old('pemberian_makanan') }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
                </div>

                <!-- Mengingatkan Periksa -->
                <div class="mb-4">
                    <label for="mengingatkan_periksa" class="block text-sm font-medium text-gray-700">Mengingatkan Periksa</label>
                    <input type="text" name="mengingatkan_periksa" id="mengingatkan_periksa" value="{{ old('mengingatkan_periksa') }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
                </div>

                <!-- Melaporkan ke Nakes -->
                <div class="mb-4">
                    <label for="melaporkan_ke_nakes" class="block text-sm font-medium text-gray-700">Melaporkan ke Nakes</label>
                    <input type="date" name="melaporkan_ke_nakes" id="melaporkan_ke_nakes" value="{{ old('melaporkan_ke_nakes') }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
                </div>
            </div>




                        </div> <!-- Akhir Grid -->

                        <!-- Submit Button -->
                        <div class="flex justify-end items-center mt-6 space-x-2">
                            <button type="submit" class="bg-gray-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded shadow">
                                Submit
                            </button>
                            <a href="{{ route('keluarga') }}" class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded shadow text-center">
                                Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</x-app-layout>
