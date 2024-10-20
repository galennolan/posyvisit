<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Tambah Data Checklist Kunjungan Usia Dewasa') }}
        </h2>
        <nav class="breadcrumb">
            <ol class="list-reset flex text-sm">
                <li><a href="/dashboard" class="text-blue-600 hover:text-blue-800">Home</a></li>
                <li><span class="mx-2">/</span></li>
                <li><a href="{{ route('kunjungan-usia-dewasa.index') }}" class="text-blue-600 hover:text-blue-800">Checklist Kunjungan Usia Dewasa</a></li>
                <li><span class="mx-2">/</span></li>
                <li class="text-blue-600 font-semibold">Tambah</li>
            </ol>
        </nav>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-lg rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-700 mb-4">Formulir Tambah Kunjungan</h3>

                <form action="{{ route('kunjungan-usia-dewasa.store') }}" method="POST">
                    @csrf

                    <!-- Nama -->
                    <div class="mb-4">
                        <label for="nama_dewasa" class="block text-sm font-medium text-gray-700">Nama Anggota Keluarga</label>
                        <!-- Input hidden untuk mengirim id Anggota Keluarga  -->
                        <input type="hidden" name="anggota_keluarga_id" value="{{ $anggotaKeluarga->id }}">
                        @if(isset($anggotaKeluarga))
                            <!-- Input hidden untuk mengirim nama Anggota Keluarga -->
                            <input type="hidden" name="nama_dewasa" value="{{ $anggotaKeluarga->nama_lengkap }}">
                            <p class="mt-1 text-sm text-gray-800 bg-gray-100 p-2 rounded">{{ $anggotaKeluarga->nama_lengkap }}</p>
                        @else
                            <p class="mt-1 text-sm text-gray-800 bg-gray-100 p-2 rounded">-</p>
                        @endif
                    </div>

                    <!-- Umur Dewasa -->
                    <div class="mb-4">
                        <label for="umur" class="block text-sm font-medium text-gray-700">Umur Dewasa</label>
                        @if(isset($anggotaKeluarga) && $anggotaKeluarga->tanggal_lahir)
                            @php
                                $tanggalLahir = \Carbon\Carbon::parse($anggotaKeluarga->tanggal_lahir);
                                $umur = $tanggalLahir->age;
                            @endphp
                            <!-- Input hidden untuk mengirim umur Dewasa -->
                            <input type="hidden" name="umur_dewasa" value="{{ $umur }}">
                            <input type="number" id="umur" name="umur" value="{{ $umur }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 bg-gray-100" readonly >
                        @else
                            <input type="number" id="umur" name="umur" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        @endif
                    </div>

                    <!-- Riwayat Penyakit Keluarga -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Riwayat Penyakit Keluarga</label>
                        <div class="mt-1">
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="riwayat_penyakit_keluarga[]" value="Hipertensi" class="form-checkbox">
                                <span class="ml-2">Hipertensi</span>
                            </label>
                            <label class="inline-flex items-center ml-4">
                                <input type="checkbox" name="riwayat_penyakit_keluarga[]" value="Diabetes Melitus" class="form-checkbox">
                                <span class="ml-2">Diabetes Melitus</span>
                            </label>
                            <label class="inline-flex items-center ml-4">
                                <input type="checkbox" name="riwayat_penyakit_keluarga[]" value="Stroke" class="form-checkbox">
                                <span class="ml-2">Stroke</span>
                            </label>
                            <label class="inline-flex items-center ml-4">
                                <input type="checkbox" name="riwayat_penyakit_keluarga[]" value="Jantung" class="form-checkbox">
                                <span class="ml-2">Jantung</span>
                            </label>
                            <label class="inline-flex items-center ml-4">
                                <input type="checkbox" name="riwayat_penyakit_keluarga[]" value="Asma" class="form-checkbox">
                                <span class="ml-2">Asma</span>
                            </label>
                            <label class="inline-flex items-center ml-4">
                                <input type="checkbox" name="riwayat_penyakit_keluarga[]" value="Kanker" class="form-checkbox">
                                <span class="ml-2">Kanker</span>
                            </label>
                            <label class="inline-flex items-center ml-4">
                                <input type="checkbox" name="riwayat_penyakit_keluarga[]" value="Kolesterol Tinggi" class="form-checkbox">
                                <span class="ml-2">Kolesterol Tinggi</span>
                            </label>
                        </div>
                    </div>

                    <!-- Tanggal Kunjungan -->
                    <div class="mb-4">
                        <label for="tanggal_kunjungan" class="block text-sm font-medium text-gray-700">Tanggal Kunjungan</label>
                        <input type="date" name="tanggal_kunjungan" id="tanggal_kunjungan" value="{{ old('tanggal_kunjungan') }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm" required>
                    </div>

                    <!-- Pemantauan Suhu Tubuh -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Pemantauan Suhu Tubuh</label>
                        <div class="mt-1">
                            <label class="inline-flex items-center">
                                <input type="radio" name="suhu_tubuh" value="<37,5°C" class="form-radio" >
                                <span class="ml-2">&lt;37,5°C</span>
                            </label>
                            <label class="inline-flex items-center ml-4">
                                <input type="radio" name="suhu_tubuh" value="≥37,5°C" class="form-radio" >
                                <span class="ml-2">≥37,5°C</span>
                            </label>
                        </div>
                    </div>

                    <!-- Isi Piringku Usia Dewasa -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Isi Piringku Usia Dewasa</label>
                        <div class="mt-1">
                            <label class="inline-flex items-center">
                                <input type="radio" name="isi_piringku" value="Sesuai" class="form-radio" required>
                                <span class="ml-2">Sesuai</span>
                            </label>
                            <label class="inline-flex items-center ml-4">
                                <input type="radio" name="isi_piringku" value="Tidak" class="form-radio" required>
                                <span class="ml-2">Tidak</span>
                            </label>
                        </div>
                    </div>

                    <!-- Pemeriksaan Tekanan Darah -->
                    <div class="mb-4">
                        <label for="pemeriksaan_tekanan_darah_tahun_terakhir" class="block text-sm font-medium text-gray-700">Pemeriksaan Tekanan Darah Tahun Terakhir</label>
                        <div class="space-y-2 mt-2">
                            <div class="flex flex-col md:flex-row gap-4">
                                <!-- Tanggal Pemeriksaan -->
                                <div class="flex-1">
                                    <label for="tanggal_pemeriksaan_tekanan_darah_tahun_terakhir" class="block text-sm text-gray-700">Tanggal</label>
                                    <input type="date" name="pemeriksaan_tekanan_darah_tahun_terakhir" id="tanggal_pemeriksaan_tekanan_darah_tahun_terakhir" value="{{ old('pemeriksaan_tekanan_darah_tahun_terakhir') }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
                                </div>

                                <!-- Tempat Pemeriksaan -->
                                <div class="flex-1">
                                    <label for="tempat_pemeriksaan_tekanan_darah_tahun_terakhir" class="block text-sm text-gray-700">Tempat</label>
                                    <input type="text" name="tempat_pemeriksaan_tekanan_darah_tahun_terakhir" id="tempat_pemeriksaan_tekanan_darah_tahun_terakhir" value="{{ old('tempat_pemeriksaan_tekanan_darah_tahun_terakhir') }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm" placeholder="Contoh: Klinik Y">
                                </div>

                                <!-- Hasil Pemeriksaan -->
                                <div class="flex-1">
                                    <label for="hasil_pemeriksaan_tekanan_darah_tahun_terakhir" class="block text-sm text-gray-700">Hasil</label>
                                    <input type="text" name="hasil_pemeriksaan_tekanan_darah_tahun_terakhir" id="hasil_pemeriksaan_tekanan_darah_tahun_terakhir" value="{{ old('hasil_pemeriksaan_tekanan_darah_tahun_terakhir') }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm" placeholder="Contoh: 120/80">
                                </div>
                            </div>
                        </div>

                        <!-- Terdiagnosa Darah Tinggi / Hipertensi -->
                        <div class="mb-4">
                            <label for="terdiagnosa_hipertensi_tahun_terakhir" class="block text-sm font-medium text-gray-700">Terdiagnosa Darah Tinggi / Hipertensi</label>
                            <input type="date" name="terdiagnosa_hipertensi_tahun_terakhir" id="terdiagnosa_hipertensi_tahun_terakhir" value="{{ old('terdiagnosa_hipertensi_tahun_terakhir') }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
                        </div>

                        <!-- Pemeriksaan dalam satu bulan terakhir -->
                        <div class="mb-4">
                            <label for="pemeriksaan_tekanan_darah_bulan_terakhir" class="block text-sm font-medium text-gray-700">Pemeriksaan dalam satu bulan terakhir</label>
                            <div class="space-y-2 mt-2">
                                <div class="flex flex-col md:flex-row gap-4">
                                    <!-- Tanggal Pemeriksaan -->
                                    <div class="flex-1">
                                        <label for="tanggal_pemeriksaan_tekanan_darah_bulan_terakhir" class="block text-sm text-gray-700">Tanggal</label>
                                        <input type="date" name="tanggal_pemeriksaan_tekanan_darah_bulan_terakhir" id="tanggal_pemeriksaan_tekanan_darah_bulan_terakhir" value="{{ old('tanggal_pemeriksaan_tekanan_darah_bulan_terakhir') }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
                                    </div>

                                    <!-- Tempat Pemeriksaan -->
                                    <div class="flex-1">
                                        <label for="tempat_pemeriksaan_tekanan_darah_bulan_terakhir" class="block text-sm text-gray-700">Tempat</label>
                                        <input type="text" name="tempat_pemeriksaan_tekanan_darah_bulan_terakhir" id="tempat_pemeriksaan_tekanan_darah_bulan_terakhir" value="{{ old('tempat_pemeriksaan_tekanan_darah_bulan_terakhir') }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm" placeholder="Contoh: Klinik Y">
                                    </div>

                                    <!-- Hasil Pemeriksaan -->
                                    <div class="flex-1">
                                        <label for="hasil_pemeriksaan_tekanan_darah_bulan_terakhir" class="block text-sm text-gray-700">Hasil</label>
                                        <input type="text" name="hasil_pemeriksaan_tekanan_darah_bulan_terakhir" id="hasil_pemeriksaan_tekanan_darah_bulan_terakhir" value="{{ old('hasil_pemeriksaan_tekanan_darah_bulan_terakhir') }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm" placeholder="Contoh: 120/80">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Ada Obat Hipertensi -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Ada Obat Hipertensi</label>
                            <div class="mt-1">
                                <label class="inline-flex items-center">
                                    <input type="radio" name="ada_obat_hipertensi" value="Ada" class="form-radio">
                                    <span class="ml-2">Ada</span>
                                </label>
                                <label class="inline-flex items-center ml-4">
                                    <input type="radio" name="ada_obat_hipertensi" value="Tidak" class="form-radio">
                                    <span class="ml-2">Tidak</span>
                                </label>
                            </div>
                        </div>

                        <!-- Sudah Minum Obat Hari Ini / 24 Jam Terakhir -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Sudah Minum Obat Hari Ini / 24 Jam Terakhir</label>
                            <div class="mt-1">
                                <label class="inline-flex items-center">
                                    <input type="radio" name="sudah_minum_obat_hipertensi" value="Ya" class="form-radio">
                                    <span class="ml-2">Ya</span>
                                </label>
                                <label class="inline-flex items-center ml-4">
                                    <input type="radio" name="sudah_minum_obat_hipertensi" value="Tidak" class="form-radio">
                                    <span class="ml-2">Tidak</span>
                                </label>
                            </div>
                        </div>

                        <!-- Pemeriksaan Kadar Gula Darah dalam satu tahun terakhir -->
                        <div class="mb-4">
                            <label for="pemeriksaan_gula_darah_tahun_terakhir" class="block text-sm font-medium text-gray-700">Pemeriksaan Kadar Gula Darah dalam satu tahun terakhir</label>
                            <div class="space-y-2 mt-2">
                                <div class="flex flex-col md:flex-row gap-4">
                                    <!-- Tanggal Pemeriksaan -->
                                    <div class="flex-1">
                                        <label for="tanggal_pemeriksaan_gula_darah_tahun_terakhir" class="block text-sm text-gray-700">Tanggal</label>
                                        <input type="date" name="tanggal_pemeriksaan_gula_darah_tahun_terakhir" id="tanggal_pemeriksaan_gula_darah_tahun_terakhir" value="{{ old('tanggal_pemeriksaan_gula_darah_tahun_terakhir') }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
                                    </div>

                                    <!-- Tempat Pemeriksaan -->
                                    <div class="flex-1">
                                        <label for="tempat_pemeriksaan_gula_darah_tahun_terakhir" class="block text-sm text-gray-700">Tempat</label>
                                        <input type="text" name="tempat_pemeriksaan_gula_darah_tahun_terakhir" id="tempat_pemeriksaan_gula_darah_tahun_terakhir" value="{{ old('tempat_pemeriksaan_gula_darah_tahun_terakhir') }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm" placeholder="Contoh: Klinik Y">
                                    </div>

                                    <!-- Hasil Pemeriksaan -->
                                    <div class="flex-1">
                                        <label for="hasil_pemeriksaan_gula_darah_tahun_terakhir" class="block text-sm text-gray-700">Hasil</label>
                                        <input type="text" name="hasil_pemeriksaan_gula_darah_tahun_terakhir" id="hasil_pemeriksaan_gula_darah_tahun_terakhir" value="{{ old('hasil_pemeriksaan_gula_darah_tahun_terakhir') }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm" placeholder="Contoh: 120 mg/dL">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Terdiagnosa Kencing Manis / Diabetes Melitus (DM) -->
                        <div class="mb-4">
                            <label for="terdiagnosa_diabetes_melitus_tahun_terakhir" class="block text-sm font-medium text-gray-700">Terdiagnosa Kencing Manis / Diabetes Melitus (DM)</label>
                            <input type="date" name="terdiagnosa_diabetes_melitus_tahun_terakhir" id="terdiagnosa_diabetes_melitus_tahun_terakhir" value="{{ old('terdiagnosa_diabetes_melitus_tahun_terakhir') }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
                        </div>

                        <!-- Terdiagnosa Gula Darah Tinggi / Diabetes Melitus -->
                        <div class="mb-4">
                            <label for="pemeriksaan_gula_darah_bulan_terakhir" class="block text-sm font-medium text-gray-700">Pemeriksaan dalam satu bulan terakhir</label>
                            <div class="space-y-2 mt-2">
                                <div class="flex flex-col md:flex-row gap-4">
                                    <!-- Tanggal Pemeriksaan -->
                                    <div class="flex-1">
                                        <label for="tanggal_pemeriksaan_gula_darah_bulan_terakhir" class="block text-sm text-gray-700">Tanggal</label>
                                        <input type="date" name="tanggal_pemeriksaan_gula_darah_bulan_terakhir" id="tanggal_pemeriksaan_gula_darah_bulan_terakhir" value="{{ old('tanggal_pemeriksaan_gula_darah_bulan_terakhir') }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
                                    </div>

                                    <!-- Tempat Pemeriksaan -->
                                    <div class="flex-1">
                                        <label for="tempat_pemeriksaan_gula_darah_bulan_terakhir" class="block text-sm text-gray-700">Tempat</label>
                                        <input type="text" name="tempat_pemeriksaan_gula_darah_bulan_terakhir" id="tempat_pemeriksaan_gula_darah_bulan_terakhir" value="{{ old('tempat_pemeriksaan_gula_darah_bulan_terakhir') }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm" placeholder="Contoh: Klinik Y">
                                    </div>

                                    <!-- Hasil Pemeriksaan -->
                                    <div class="flex-1">
                                        <label for="hasil_pemeriksaan_gula_darah_bulan_terakhir" class="block text-sm text-gray-700">Hasil</label>
                                        <input type="text" name="hasil_pemeriksaan_gula_darah_bulan_terakhir" id="hasil_pemeriksaan_gula_darah_bulan_terakhir" value="{{ old('hasil_pemeriksaan_gula_darah_bulan_terakhir') }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm" placeholder="Contoh: 120 mg/dL">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Ada Obat DM -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Ada Obat DM</label>
                            <div class="mt-1">
                                <label class="inline-flex items-center">
                                    <input type="radio" name="ada_obat_dm" value="Ada" class="form-radio">
                                    <span class="ml-2">Ada</span>
                                </label>
                                <label class="inline-flex items-center ml-4">
                                    <input type="radio" name="ada_obat_dm" value="Tidak" class="form-radio">
                                    <span class="ml-2">Tidak</span>
                                </label>
                            </div>
                        </div>

                        <!-- Sudah Minum Obat Hari Ini / 24 Jam Terakhir -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Sudah Minum Obat Hari Ini / 24 Jam Terakhir</label>
                            <div class="mt-1">
                                <label class="inline-flex items-center">
                                    <input type="radio" name="sudah_minum_obat_dm" value="Ya" class="form-radio">
                                    <span class="ml-2">Ya</span>
                                </label>
                                <label class="inline-flex items-center ml-4">
                                    <input type="radio" name="sudah_minum_obat_dm" value="Tidak" class="form-radio">
                                    <span class="ml-2">Tidak</span>
                                </label>
                            </div>
                        </div>

                        <!-- Perilaku Merokok -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Perilaku Merokok</label>
                            <div class="mt-1">
                                <label class="inline-flex items-center">
                                    <input type="radio" name="perilaku_merokok" value="Aktif" class="form-radio">
                                    <span class="ml-2">Aktif</span>
                                </label>
                                <label class="inline-flex items-center ml-4">
                                    <input type="radio" name="perilaku_merokok" value="Pasif" class="form-radio">
                                    <span class="ml-2">Pasif</span>
                                </label>
                            </div>
                        </div>

                        <!-- Kontrasepsi yang Digunakan -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Kontrasepsi yang Digunakan</label>
                            <div class="mt-1">
                                <label class="inline-flex items-center">
                                    <input type="checkbox" name="kontrasepsi[]" value="Pil" class="form-checkbox">
                                    <span class="ml-2">Pil</span>
                                </label>
                                <label class="inline-flex items-center ml-4">
                                    <input type="checkbox" name="kontrasepsi[]" value="Kondom" class="form-checkbox">
                                    <span class="ml-2">Kondom</span>
                                </label>
                                <label class="inline-flex items-center ml-4">
                                    <input type="checkbox" name="kontrasepsi[]" value="Suntik" class="form-checkbox">
                                    <span class="ml-2">Suntik</span>
                                </label>
                                <label class="inline-flex items-center ml-4">
                                    <input type="checkbox" name="kontrasepsi[]" value="Implan/Susuk" class="form-checkbox">
                                    <span class="ml-2">Implan/Susuk</span>
                                </label>
                                <label class="inline-flex items-center ml-4">
                                    <input type="checkbox" name="kontrasepsi[]" value="Lainnya" class="form-checkbox">
                                    <span class="ml-2">Lainnya</span>
                                </label>
                            </div>
                        </div>

                        <!-- Melakukan Skrining Kesehatan Jiwa -->
                        <div class="mb-4">
                            <label for="skrining_kesehatan_jiwa" class="block text-sm font-medium text-gray-700">Melakukan Skrining Kesehatan Jiwa</label>
                            <div class="space-y-2 mt-2">
                                <div class="flex flex-col md:flex-row gap-4">
                                    <!-- Tanggal Skrining -->
                                    <div class="flex-1">
                                        <label for="tanggal_skrining_kesehatan_jiwa" class="block text-sm text-gray-700">Tanggal</label>
                                        <input type="date" name="tanggal_skrining_kesehatan_jiwa" id="tanggal_skrining_kesehatan_jiwa" value="{{ old('tanggal_skrining_kesehatan_jiwa') }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
                                    </div>

                                    <!-- Tempat Skrining -->
                                    <div class="flex-1">
                                        <label for="tempat_skrining_kesehatan_jiwa" class="block text-sm text-gray-700">Tempat</label>
                                        <input type="text" name="tempat_skrining_kesehatan_jiwa" id="tempat_skrining_kesehatan_jiwa" value="{{ old('tempat_skrining_kesehatan_jiwa') }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm" placeholder="Contoh: Rumah Sakit X">
                                    </div>

                                    <!-- Petugas Skrining -->
                                    <div class="flex-1">
                                        <label for="petugas_skrining_kesehatan_jiwa" class="block text-sm text-gray-700">Petugas</label>
                                        <input type="text" name="petugas_skrining_kesehatan_jiwa" id="petugas_skrining_kesehatan_jiwa" value="{{ old('petugas_skrining_kesehatan_jiwa') }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm" placeholder="Contoh: Nama Petugas">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pemberian Edukasi / Kunjungan Nakes -->
                        <div class="mb-4">
                            <label for="pemberian_edukasi" class="block text-sm font-medium text-gray-700">Pemberian Edukasi / Kunjungan Nakes</label>
                            <input type="text" name="pemberian_edukasi" id="pemberian_edukasi" value="{{ old('pemberian_edukasi') }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
                        </div>

                    <!-- Paraf Usia Dewasa -->
                    <div class="mb-4">
                        <label for="paraf_usia_dewasa" class="block text-sm font-medium text-gray-700">Paraf Usia Dewasa</label>
                        <input type="text" name="paraf_usia_dewasa" id="paraf_usia_dewasa" value="{{ old('paraf_usia_dewasa') }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
                    </div>

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