<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Edit Data Kunjungan Rumah Balita dan Apras') }}
        </h2>
        <nav class="breadcrumb">
            <ol class="list-reset flex text-sm">
                <li><a href="/dashboard" class="text-blue-600 hover:text-blue-800">Home</a></li>
                <li><span class="mx-2">/</span></li>
                <li><a href="{{ route('kunjungan-rumah-balita-apras.index') }}" class="text-blue-600 hover:text-blue-800">Kunjungan Rumah Balita dan Apras</a></li>
                <li><span class="mx-2">/</span></li>
                <li class="text-blue-600 font-semibold">Edit</li>
            </ol>
        </nav>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-lg rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-700 mb-4">Formulir Edit Kunjungan</h3>

                <form action="{{ route('kunjungan-rumah-balita-apras.update', $kunjungan->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Grid untuk membagi form menjadi dua kolom pada desktop dan satu kolom pada mobile -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        <!-- Nama Balita atau Pra sekolah -->
                        <div class="mb-4">
                            <label for="nama_ibu" class="block text-sm font-medium text-gray-700">Nama Balita atau Pra sekolah</label>
                            <input type="hidden" name="anggota_keluarga_id" value="{{ $kunjungan->anggota_keluarga_id }}">
                            <p class="mt-1 text-sm text-gray-800 bg-gray-100 p-2 rounded">{{ $kunjungan->anggotaKeluarga->nama_lengkap }}</p>
                        </div>

                        <!-- Umur Balita -->
                        <div class="mb-4">
                            <label for="umur_balita" class="block text-sm font-medium text-gray-700">Umur Balita atau Pra sekolah</label>
                            <input type="number" id="umur" name="umur" value="{{ $kunjungan->umur_balita }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm bg-gray-100" readonly>
                        </div>

                        <!-- Waktu Kunjungan -->
                        <div class="mb-4">
                            <label for="waktu_kunjungan" class="block text-sm font-medium text-gray-700">Waktu Kunjungan</label>
                            <input type="date" name="waktu_kunjungan" id="waktu_kunjungan" value="{{ $kunjungan->waktu_kunjungan }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm" required>
                        </div>

                        <!-- Tanggal -->
                        <div class="mb-4">
                            <label for="tanggal" class="block text-sm font-medium text-gray-700">Tanggal</label>
                            <input type="date" name="tanggal" id="tanggal" value="{{ $kunjungan->tanggal }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm" required>
                        </div>

                        <!-- Suhu Tubuh -->
                        <div class="mb-4">
                            <label for="suhu_tubuh" class="block text-sm font-medium text-gray-700">Suhu Tubuh (°C)</label>
                            <input type="number" name="suhu_tubuh" id="suhu_tubuh" value="{{ $kunjungan->suhu_tubuh }}" step="0.1" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm" required>
                        </div>

                        <!-- Ada Buku KIA -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Ada Buku KIA</label>
                            <div class="mt-1">
                                <label class="inline-flex items-center">
                                    <input type="radio" name="ada_buku_kia" value="1" {{ $kunjungan->ada_buku_kia == 1 ? 'checked' : '' }} class="form-radio">
                                    <span class="ml-2">Ya</span>
                                </label>
                                <label class="inline-flex items-center ml-4">
                                    <input type="radio" name="ada_buku_kia" value="0" {{ $kunjungan->ada_buku_kia == 0 ? 'checked' : '' }} class="form-radio">
                                    <span class="ml-2">Tidak</span>
                                </label>
                            </div>
                        </div>

                        <!-- Tanggal Terakhir Menimbang dan Mengukur -->
                        <div class="mb-4">
                            <label for="tanggal_terakhir_menimbang_mengukur" class="block text-sm font-medium text-gray-700">Tanggal Terakhir Menimbang dan Mengukur</label>
                            <input type="date" name="tanggal_terakhir_menimbang_mengukur" id="tanggal_terakhir_menimbang_mengukur" value="{{ $kunjungan->tanggal_terakhir_menimbang_mengukur }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
                        </div>

                        <!-- Hasil Penimbangan dan Pengukuran -->
                        <div class="mb-4">
                            <label for="hasil_penimbangan" class="block text-sm font-medium text-gray-700">Hasil Penimbangan dan Pengukuran</label>
                            <textarea name="hasil_penimbangan" id="hasil_penimbangan" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">{{ $kunjungan->hasil_penimbangan }}</textarea>
                        </div>

                        <!-- BB (Berat Badan) -->
                        <div class="mb-4">
                            <label for="bb" class="block text-sm font-medium text-gray-700">BB (Berat Badan)</label>
                            <input type="number" name="bb" id="bb" value="{{ $kunjungan->bb }}" step="0.1" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
                        </div>

                        <!-- PB/TB (Tinggi Badan) -->
                        <div class="mb-4">
                            <label for="pb_tb" class="block text-sm font-medium text-gray-700">PB/TB (Tinggi Badan)</label>
                            <input type="number" name="pb_tb" id="pb_tb" value="{{ $kunjungan->pb_tb }}" step="0.1" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
                        </div>

                        <!-- LK (Lingkar Kepala) -->
                        <div class="mb-4">
                            <label for="lk" class="block text-sm font-medium text-gray-700">LK (Lingkar Kepala)</label>
                            <input type="number" name="lk" id="lk" value="{{ $kunjungan->lk }}" step="0.1" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
                        </div>

                       <!-- Imunisasi untuk Usia 0 Bulan --><!-- Imunisasi untuk Usia 0 Bulan -->
                        <div class="mb-12">
                            <label class="block text-lg font-semibold text-gray-800 mb-4">Usia 0 Bulan - Imunisasi</label>
                            <div id="usia_0_bulan_container" class="space-y-8">
                                <!-- Hepatitis B -->
                                <div class="flex items-center space-x-4">
                                    <input type="checkbox" name="imunisasi[usia_0_bulan][hepatitis_b]" value="1" {{ isset($kunjungan->imunisasi['usia_0_bulan']['hepatitis_b']) && $kunjungan->imunisasi['usia_0_bulan']['hepatitis_b'] == 1 ? 'checked' : '' }}>
                                    <label for="imunisasi[usia_0_bulan][hepatitis_b]" class="w-full text-sm font-medium text-gray-700">Hepatitis B</label>
                                </div>

                                <!-- BCG -->
                                <div class="flex items-center space-x-4">
                                    <input type="checkbox" name="imunisasi[usia_0_bulan][bcg]" value="1" {{ isset($kunjungan->imunisasi['usia_0_bulan']['bcg']) && $kunjungan->imunisasi['usia_0_bulan']['bcg'] == 1 ? 'checked' : '' }}>
                                    <label for="imunisasi[usia_0_bulan][bcg]" class="w-full text-sm font-medium text-gray-700">BCG</label>
                                </div>

                                <!-- Polio Tetes 1 -->
                                <div class="flex items-center space-x-4">
                                    <input type="checkbox" name="imunisasi[usia_0_bulan][polio_tetes_1]" value="1" {{ isset($kunjungan->imunisasi['usia_0_bulan']['polio_tetes_1']) && $kunjungan->imunisasi['usia_0_bulan']['polio_tetes_1'] == 1 ? 'checked' : '' }}>
                                    <label for="imunisasi[usia_0_bulan][polio_tetes_1]" class="w-full text-sm font-medium text-gray-700">Polio Tetes 1</label>
                                </div>
                            </div>
                        </div>

                        <!-- Imunisasi untuk Usia 1 Bulan -->
                        <div class="mb-12">
                            <label class="block text-lg font-semibold text-gray-800 mb-4">Usia 1 Bulan - Imunisasi</label>
                            <div id="usia_1_bulan_container" class="space-y-8">
                                <!-- BCG -->
                                <div class="flex items-center space-x-4">
                                    <input type="checkbox" name="imunisasi[usia_1_bulan][bcg]" value="1" {{ isset($kunjungan->imunisasi['usia_1_bulan']['bcg']) && $kunjungan->imunisasi['usia_1_bulan']['bcg'] == 1 ? 'checked' : '' }}>
                                    <label for="imunisasi[usia_1_bulan][bcg]" class="w-full text-sm font-medium text-gray-700">BCG</label>
                                </div>

                                <!-- Polio Tetes 1 -->
                                <div class="flex items-center space-x-4">
                                    <input type="checkbox" name="imunisasi[usia_1_bulan][polio_tetes_1]" value="1" {{ isset($kunjungan->imunisasi['usia_1_bulan']['polio_tetes_1']) && $kunjungan->imunisasi['usia_1_bulan']['polio_tetes_1'] == 1 ? 'checked' : '' }}>
                                    <label for="imunisasi[usia_1_bulan][polio_tetes_1]" class="w-full text-sm font-medium text-gray-700">Polio Tetes 1</label>
                                </div>
                            </div>
                        </div>

                        <!-- Imunisasi untuk Usia 2 Bulan -->
                        <div class="mb-12">
                            <label class="block text-lg font-semibold text-gray-800 mb-4">Usia 2 Bulan - Imunisasi</label>
                            <div id="usia_2_bulan_container" class="space-y-8">
                                <!-- DPT-HB-Hib 1 -->
                                <div class="flex items-center space-x-4">
                                    <input type="checkbox" name="imunisasi[usia_2_bulan][dpt_hb_hib_1]" value="1" {{ isset($kunjungan->imunisasi['usia_2_bulan']['dpt_hb_hib_1']) && $kunjungan->imunisasi['usia_2_bulan']['dpt_hb_hib_1'] == 1 ? 'checked' : '' }}>
                                    <label for="imunisasi[usia_2_bulan][dpt_hb_hib_1]" class="w-full text-sm font-medium text-gray-700">DPT-HB-Hib 1</label>
                                </div>

                                <!-- Polio Tetes 2 -->
                                <div class="flex items-center space-x-4">
                                    <input type="checkbox" name="imunisasi[usia_2_bulan][polio_tetes_2]" value="1" {{ isset($kunjungan->imunisasi['usia_2_bulan']['polio_tetes_2']) && $kunjungan->imunisasi['usia_2_bulan']['polio_tetes_2'] == 1 ? 'checked' : '' }}>
                                    <label for="imunisasi[usia_2_bulan][polio_tetes_2]" class="w-full text-sm font-medium text-gray-700">Polio Tetes 2</label>
                                </div>

                                <!-- PCV 1 -->
                                <div class="flex items-center space-x-4">
                                    <input type="checkbox" name="imunisasi[usia_2_bulan][pcv_1]" value="1" {{ isset($kunjungan->imunisasi['usia_2_bulan']['pcv_1']) && $kunjungan->imunisasi['usia_2_bulan']['pcv_1'] == 1 ? 'checked' : '' }}>
                                    <label for="imunisasi[usia_2_bulan][pcv_1]" class="w-full text-sm font-medium text-gray-700">PCV 1</label>
                                </div>

                                <!-- RV 1 -->
                                <div class="flex items-center space-x-4">
                                    <input type="checkbox" name="imunisasi[usia_2_bulan][rv_1]" value="1" {{ isset($kunjungan->imunisasi['usia_2_bulan']['rv_1']) && $kunjungan->imunisasi['usia_2_bulan']['rv_1'] == 1 ? 'checked' : '' }}>
                                    <label for="imunisasi[usia_2_bulan][rv_1]" class="w-full text-sm font-medium text-gray-700">RV 1</label>
                                </div>
                            </div>
                        </div>

                        <!-- Imunisasi untuk Usia 3 Bulan -->
                        <div class="mb-12">
                            <label class="block text-lg font-semibold text-gray-800 mb-4">Usia 3 Bulan - Imunisasi</label>
                            <div id="usia_3_bulan_container" class="space-y-8">
                                <!-- DPT-HB-Hib 2 -->
                                <div class="flex items-center space-x-4">
                                    <input type="checkbox" name="imunisasi[usia_3_bulan][dpt_hb_hib_2]" value="1" {{ isset($kunjungan->imunisasi['usia_3_bulan']['dpt_hb_hib_2']) && $kunjungan->imunisasi['usia_3_bulan']['dpt_hb_hib_2'] == 1 ? 'checked' : '' }}>
                                    <label for="imunisasi[usia_3_bulan][dpt_hb_hib_2]" class="w-full text-sm font-medium text-gray-700">DPT-HB-Hib 2</label>
                                </div>

                                <!-- Polio Tetes 3 -->
                                <div class="flex items-center space-x-4">
                                    <input type="checkbox" name="imunisasi[usia_3_bulan][polio_tetes_3]" value="1" {{ isset($kunjungan->imunisasi['usia_3_bulan']['polio_tetes_3']) && $kunjungan->imunisasi['usia_3_bulan']['polio_tetes_3'] == 1 ? 'checked' : '' }}>
                                    <label for="imunisasi[usia_3_bulan][polio_tetes_3]" class="w-full text-sm font-medium text-gray-700">Polio Tetes 3</label>
                                </div>

                                <!-- PCV 2 -->
                                <div class="flex items-center space-x-4">
                                    <input type="checkbox" name="imunisasi[usia_3_bulan][pcv_2]" value="1" {{ isset($kunjungan->imunisasi['usia_3_bulan']['pcv_2']) && $kunjungan->imunisasi['usia_3_bulan']['pcv_2'] == 1 ? 'checked' : '' }}>
                                    <label for="imunisasi[usia_3_bulan][pcv_2]" class="w-full text-sm font-medium text-gray-700">PCV 2</label>
                                </div>

                                <!-- RV 2 -->
                                <div class="flex items-center space-x-4">
                                    <input type="checkbox" name="imunisasi[usia_3_bulan][rv_2]" value="1" {{ isset($kunjungan->imunisasi['usia_3_bulan']['rv_2']) && $kunjungan->imunisasi['usia_3_bulan']['rv_2'] == 1 ? 'checked' : '' }}>
                                    <label for="imunisasi[usia_3_bulan][rv_2]" class="w-full text-sm font-medium text-gray-700">RV 2</label>
                                </div>
                            </div>
                        </div>

                       <!-- Imunisasi untuk Usia 4 Bulan -->
                        <div class="mb-12">
                            <label class="block text-lg font-semibold text-gray-800 mb-4">Usia 4 Bulan - Imunisasi</label>
                            <div id="usia_4_bulan_container" class="space-y-8">
                                <!-- DPT-HB-Hib 3 -->
                                <div class="flex items-center space-x-4">
                                    <input type="checkbox" name="imunisasi[usia_4_bulan][dpt_hb_hib_3]" value="1" {{ isset($kunjungan->imunisasi['usia_4_bulan']['dpt_hb_hib_3']) && $kunjungan->imunisasi['usia_4_bulan']['dpt_hb_hib_3'] == 1 ? 'checked' : '' }}>
                                    <label for="imunisasi[usia_4_bulan][dpt_hb_hib_3]" class="w-full text-sm font-medium text-gray-700">DPT-HB-Hib 3</label>
                                </div>

                                <!-- Polio Tetes 4 -->
                                <div class="flex items-center space-x-4">
                                    <input type="checkbox" name="imunisasi[usia_4_bulan][polio_tetes_4]" value="1" {{ isset($kunjungan->imunisasi['usia_4_bulan']['polio_tetes_4']) && $kunjungan->imunisasi['usia_4_bulan']['polio_tetes_4'] == 1 ? 'checked' : '' }}>
                                    <label for="imunisasi[usia_4_bulan][polio_tetes_4]" class="w-full text-sm font-medium text-gray-700">Polio Tetes 4</label>
                                </div>

                                <!-- Polio Suntik (IPV) 1 -->
                                <div class="flex items-center space-x-4">
                                    <input type="checkbox" name="imunisasi[usia_4_bulan][polio_suntik_1]" value="1" {{ isset($kunjungan->imunisasi['usia_4_bulan']['polio_suntik_1']) && $kunjungan->imunisasi['usia_4_bulan']['polio_suntik_1'] == 1 ? 'checked' : '' }}>
                                    <label for="imunisasi[usia_4_bulan][polio_suntik_1]" class="w-full text-sm font-medium text-gray-700">Polio Suntik (IPV) 1</label>
                                </div>

                                <!-- RV 3 -->
                                <div class="flex items-center space-x-4">
                                    <input type="checkbox" name="imunisasi[usia_4_bulan][rv_3]" value="1" {{ isset($kunjungan->imunisasi['usia_4_bulan']['rv_3']) && $kunjungan->imunisasi['usia_4_bulan']['rv_3'] == 1 ? 'checked' : '' }}>
                                    <label for="imunisasi[usia_4_bulan][rv_3]" class="w-full text-sm font-medium text-gray-700">RV 3</label>
                                </div>
                            </div>
                        </div>

                        <!-- Imunisasi untuk Usia 9 Bulan -->
                        <div class="mb-12">
                            <label class="block text-lg font-semibold text-gray-800 mb-4">Usia 9 Bulan - Imunisasi</label>
                            <div id="usia_9_bulan_container" class="space-y-8">
                                <!-- Campak-Rubella -->
                                <div class="flex items-center space-x-4">
                                    <input type="checkbox" name="imunisasi[usia_9_bulan][campak_rubella]" value="1" {{ isset($kunjungan->imunisasi['usia_9_bulan']['campak_rubella']) && $kunjungan->imunisasi['usia_9_bulan']['campak_rubella'] == 1 ? 'checked' : '' }}>
                                    <label for="imunisasi[usia_9_bulan][campak_rubella]" class="w-full text-sm font-medium text-gray-700">Campak-Rubella</label>
                                </div>

                                <!-- Polio Suntik (IPV) 2 -->
                                <div class="flex items-center space-x-4">
                                    <input type="checkbox" name="imunisasi[usia_9_bulan][polio_suntik_2]" value="1" {{ isset($kunjungan->imunisasi['usia_9_bulan']['polio_suntik_2']) && $kunjungan->imunisasi['usia_9_bulan']['polio_suntik_2'] == 1 ? 'checked' : '' }}>
                                    <label for="imunisasi[usia_9_bulan][polio_suntik_2]" class="w-full text-sm font-medium text-gray-700">Polio Suntik (IPV) 2</label>
                                </div>
                            </div>
                        </div>

                        <!-- Imunisasi untuk Usia 10 Bulan -->
                        <div class="mb-12">
                            <label class="block text-lg font-semibold text-gray-800 mb-4">Usia 10 Bulan - Imunisasi</label>
                            <div id="usia_10_bulan_container" class="space-y-8">
                                <!-- Japanese Encephalitis (JE) -->
                                <div class="flex items-center space-x-4">
                                    <input type="checkbox" name="imunisasi[usia_10_bulan][je]" value="1" {{ isset($kunjungan->imunisasi['usia_10_bulan']['je']) && $kunjungan->imunisasi['usia_10_bulan']['je'] == 1 ? 'checked' : '' }}>
                                    <label for="imunisasi[usia_10_bulan][je]" class="w-full text-sm font-medium text-gray-700">Japanese Encephalitis (JE)</label>
                                </div>
                            </div>
                        </div>

                        <!-- Imunisasi untuk Usia 12 Bulan -->
                        <div class="mb-12">
                            <label class="block text-lg font-semibold text-gray-800 mb-4">Usia 12 Bulan - Imunisasi</label>
                            <div id="usia_12_bulan_container" class="space-y-8">
                                <!-- PCV 3 -->
                                <div class="flex items-center space-x-4">
                                    <input type="checkbox" name="imunisasi[usia_12_bulan][pcv_3]" value="1" {{ isset($kunjungan->imunisasi['usia_12_bulan']['pcv_3']) && $kunjungan->imunisasi['usia_12_bulan']['pcv_3'] == 1 ? 'checked' : '' }}>
                                    <label for="imunisasi[usia_12_bulan][pcv_3]" class="w-full text-sm font-medium text-gray-700">PCV 3</label>
                                </div>
                            </div>
                        </div>

                        <!-- Imunisasi untuk Usia 18 Bulan -->
                        <div class="mb-12">
                            <label class="block text-lg font-semibold text-gray-800 mb-4">Usia 18 Bulan - Imunisasi</label>
                            <div id="usia_18_bulan_container" class="space-y-8">
                                <!-- DPT-HB-Hib Lanjutan -->
                                <div class="flex items-center space-x-4">
                                    <input type="checkbox" name="imunisasi[usia_18_bulan][dpt_hb_hib_lanjutan]" value="1" {{ isset($kunjungan->imunisasi['usia_18_bulan']['dpt_hb_hib_lanjutan']) && $kunjungan->imunisasi['usia_18_bulan']['dpt_hb_hib_lanjutan'] == 1 ? 'checked' : '' }}>
                                    <label for="imunisasi[usia_18_bulan][dpt_hb_hib_lanjutan]" class="w-full text-sm font-medium text-gray-700">DPT-HB-Hib Lanjutan</label>
                                </div>

                                <!-- Campak-Rubella Lanjutan -->
                                <div class="flex items-center space-x-4">
                                    <input type="checkbox" name="imunisasi[usia_18_bulan][campak_rubella_lanjutan]" value="1" {{ isset($kunjungan->imunisasi['usia_18_bulan']['campak_rubella_lanjutan']) && $kunjungan->imunisasi['usia_18_bulan']['campak_rubella_lanjutan'] == 1 ? 'checked' : '' }}>
                                    <label for="imunisasi[usia_18_bulan][campak_rubella_lanjutan]" class="w-full text-sm font-medium text-gray-700">Campak-Rubella Lanjutan</label>
                                </div>
                            </div>
                        </div>



                        <div class="grid grid-cols-2 gap-4">
                        <!-- Makanan Pokok -->
                        <div class="mb-4">
                            <label for="makanan_pokok" class="block text-sm font-medium text-gray-700">Makanan Pokok (Beras/Kentang/Jagung)</label>
                            <input type="checkbox" name="makanan_pokok" id="makanan_pokok" value="1" {{ $kunjungan->makanan_pokok ? 'checked' : '' }} class="mt-1 block">
                        </div>

                        <!-- Makanan Sumber Protein Hewan -->
                        <div class="mb-4">
                            <label for="makanan_protein_hewani" class="block text-sm font-medium text-gray-700">Makanan Sumber Protein Hewan</label>
                            <input type="checkbox" name="makanan_protein_hewani" id="makanan_protein_hewani" value="1" {{ $kunjungan->makanan_protein_hewani ? 'checked' : '' }} class="mt-1 block">
                        </div>

                        <!-- Makanan Sumber Protein Nabati -->
                        <div class="mb-4">
                            <label for="makanan_protein_nabati" class="block text-sm font-medium text-gray-700">Makanan Sumber Protein Nabati</label>
                            <input type="checkbox" name="makanan_protein_nabati" id="makanan_protein_nabati" value="1" {{ $kunjungan->makanan_protein_nabati ? 'checked' : '' }} class="mt-1 block">
                        </div>

                        <!-- Sumber Lemak -->
                        <div class="mb-4">
                            <label for="sumber_lemak" class="block text-sm font-medium text-gray-700">Sumber Lemak (Minyak/Santan)</label>
                            <input type="checkbox" name="sumber_lemak" id="sumber_lemak" value="1" {{ $kunjungan->sumber_lemak ? 'checked' : '' }} class="mt-1 block">
                        </div>

                        <!-- Buah dan Sayur -->
                        <div class="mb-4">
                            <label for="buah_sayur" class="block text-sm font-medium text-gray-700">Buah dan Sayur</label>
                            <input type="checkbox" name="buah_sayur" id="buah_sayur" value="1" {{ $kunjungan->buah_sayur ? 'checked' : '' }} class="mt-1 block">
                        </div>

                        <!-- Ada Obat Cacing -->
                        <div class="mb-4">
                            <label for="ada_obat_cacing" class="block text-sm font-medium text-gray-700">Ada Obat Cacing</label>
                            <input type="checkbox" name="ada_obat_cacing" id="ada_obat_cacing" value="1" {{ $kunjungan->ada_obat_cacing ? 'checked' : '' }} class="mt-1 block">
                        </div>

                        <!-- Waktu Minum Obat Cacing -->
                        <div class="mb-4">
                            <label for="waktu_minum_obat_cacing" class="block text-sm font-medium text-gray-700">Waktu Minum Obat Cacing</label>
                            <input type="date" name="waktu_minum_obat_cacing" id="waktu_minum_obat_cacing" value="{{ $kunjungan->waktu_minum_obat_cacing }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
                        </div>

                        <!-- Usia 6-11 Bulan (Kapsul Biru) -->
                        <div class="mb-4">
                            <label for="usia_6_11_bulan_kapsul_biru" class="block text-sm font-medium text-gray-700">Usia 6-11 Bulan (Kapsul Biru)</label>
                            <input type="checkbox" name="usia_6_11_bulan_kapsul_biru" id="usia_6_11_bulan_kapsul_biru" value="1" {{ $kunjungan->usia_6_11_bulan_kapsul_biru ? 'checked' : '' }} class="mt-1 block">
                        </div>

                        <!-- Usia >11 Bulan (Kapsul Merah) -->
                        <div class="mb-4">
                            <label for="usia_lebih_11_bulan_kapsul_merah" class="block text-sm font-medium text-gray-700">Usia >11 Bulan (Kapsul Merah)</label>
                            <input type="checkbox" name="usia_lebih_11_bulan_kapsul_merah" id="usia_lebih_11_bulan_kapsul_merah" value="1" {{ $kunjungan->usia_lebih_11_bulan_kapsul_merah ? 'checked' : '' }} class="mt-1 block">
                        </div>

                        <!-- Ada MT Pangan Lokal -->
                        <div class="mb-4">
                            <label for="ada_mt_pangan_lokal" class="block text-sm font-medium text-gray-700">Ada MT Pangan Lokal</label>
                            <input type="checkbox" name="ada_mt_pangan_lokal" id="ada_mt_pangan_lokal" value="1" {{ $kunjungan->ada_mt_pangan_lokal ? 'checked' : '' }} class="mt-1 block">
                        </div>

                        <!-- Kepatuhan Konsumsi MT Pangan Lokal -->
                        <div class="mb-4">
                            <label for="kepatuhan_mt_pangan_lokal" class="block text-sm font-medium text-gray-700">Kepatuhan Konsumsi MT Pangan Lokal</label>
                            <input type="checkbox" name="kepatuhan_mt_pangan_lokal" id="kepatuhan_mt_pangan_lokal" value="1" {{ $kunjungan->kepatuhan_mt_pangan_lokal ? 'checked' : '' }} class="mt-1 block">
                        </div>

                        <!-- Pemberian Edukasi -->
                        <div class="mb-4 col-span-2">
                            <label for="pemberian_edukasi" class="block text-sm font-medium text-gray-700">Pemberian Edukasi/Kunjungan Nakes</label>
                            <textarea name="pemberian_edukasi" id="pemberian_edukasi" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">{{ $kunjungan->pemberian_edukasi }}</textarea>
                        </div>

                        <!-- Paraf Ibu Balita -->
                        <div class="mb-4 col-span-2">
                            <label for="paraf_ibu_balita" class="block text-sm font-medium text-gray-700">Paraf Ibu Balita/Apras</label>
                            <input type="text" name="paraf_ibu_balita" id="paraf_ibu_balita" value="{{ $kunjungan->paraf_ibu_balita }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
                        </div>
                    </div>

                    <!-- kolom kedua -->
                    <div class="grid grid-cols-2 gap-4">
                        <!-- Waktu Kunjungan -->
                        <div class="mb-4">
                            <label for="waktu_kunjungan" class="block text-sm font-medium text-gray-700">Waktu Kunjungan</label>
                            <input type="date" name="waktu_kunjungan" id="waktu_kunjungan" value="{{ $kunjungan->waktu_kunjungan }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
                        </div>

                        <!-- Tanggal -->
                        <div class="mb-4">
                            <label for="tanggal" class="block text-sm font-medium text-gray-700">Tanggal</label>
                            <input type="date" name="tanggal" id="tanggal" value="{{ $kunjungan->tanggal }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
                        </div>

                        <!-- Napas Sesak -->
                        <div class="mb-4">
                            <label for="napas_sesak" class="block text-sm font-medium text-gray-700">Napas Sesak</label>
                            <input type="checkbox" name="napas_sesak" id="napas_sesak" value="1" {{ $kunjungan->napas_sesak ? 'checked' : '' }} class="mt-1 block">
                        </div>

                        <!-- Batuk -->
                        <div class="mb-4">
                            <label for="batuk" class="block text-sm font-medium text-gray-700">Batuk</label>
                            <input type="checkbox" name="batuk" id="batuk" value="1" {{ $kunjungan->batuk ? 'checked' : '' }} class="mt-1 block">
                        </div>

                        <!-- Demam -->
                        <div class="mb-4">
                            <label for="demam" class="block text-sm font-medium text-gray-700">Demam</label>
                            <input type="checkbox" name="demam" id="demam" value="1" {{ $kunjungan->demam ? 'checked' : '' }} class="mt-1 block">
                        </div>

                        <!-- Diare -->
                        <div class="mb-4">
                            <label for="diare" class="block text-sm font-medium text-gray-700">Diare</label>
                            <input type="checkbox" name="diare" id="diare" value="1" {{ $kunjungan->diare ? 'checked' : '' }} class="mt-1 block">
                        </div>

                        <!-- Warna Kencing -->
                        <div class="mb-4">
                            <label for="warna_kencing" class="block text-sm font-medium text-gray-700">Warna Kencing</label>
                            <input type="text" name="warna_kencing" id="warna_kencing" value="{{ $kunjungan->warna_kencing }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
                        </div>

                        <!-- Warna Kulit -->
                        <div class="mb-4">
                            <label for="warna_kulit" class="block text-sm font-medium text-gray-700">Warna Kulit</label>
                            <input type="text" name="warna_kulit" id="warna_kulit" value="{{ $kunjungan->warna_kulit }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
                        </div>

                        <!-- Aktifitas -->
                        <div class="mb-4">
                            <label for="aktifitas" class="block text-sm font-medium text-gray-700">Aktifitas</label>
                            <input type="text" name="aktifitas" id="aktifitas" value="{{ $kunjungan->aktifitas }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
                        </div>

                        <!-- Hisapan Bayi -->
                        <div class="mb-4">
                            <label for="hisapan_bayi" class="block text-sm font-medium text-gray-700">Hisapan Bayi</label>
                            <input type="text" name="hisapan_bayi" id="hisapan_bayi" value="{{ $kunjungan->hisapan_bayi }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
                        </div>

                        <!-- Pemberian Makanan -->
                        <div class="mb-4">
                            <label for="pemberian_makanan" class="block text-sm font-medium text-gray-700">Pemberian Makanan</label>
                            <input type="text" name="pemberian_makanan" id="pemberian_makanan" value="{{ $kunjungan->pemberian_makanan }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
                        </div>

                        <!-- Mengingatkan Periksa -->
                        <div class="mb-4">
                            <label for="mengingatkan_periksa" class="block text-sm font-medium text-gray-700">Mengingatkan Periksa</label>
                            <input type="text" name="mengingatkan_periksa" id="mengingatkan_periksa" value="{{ $kunjungan->mengingatkan_periksa }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
                        </div>

                        <!-- Melaporkan ke Nakes -->
                        <div class="mb-4">
                            <label for="melaporkan_ke_nakes" class="block text-sm font-medium text-gray-700">Melaporkan ke Nakes</label>
                            <input type="date" name="melaporkan_ke_nakes" id="melaporkan_ke_nakes" value="{{ $kunjungan->melaporkan_ke_nakes }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
                        </div>
                    </div>


                        <!-- Ulangi pola ini untuk input lainnya yang berkaitan dengan form imunisasi atau lainnya -->

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
