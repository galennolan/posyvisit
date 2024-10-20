<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Tambah Data Kunjungan Lansia') }}
        </h2>
        <nav class="breadcrumb">
            <ol class="list-reset flex text-sm">
                <li><a href="/dashboard" class="text-blue-600 hover:text-blue-800">Home</a></li>
                <li><span class="mx-2">/</span></li>
                <li><a href="{{ route('kunjungan-lansia.index') }}" class="text-blue-600 hover:text-blue-800">Kunjungan Lansia</a></li>
                <li><span class="mx-2">/</span></li>
                <li class="text-blue-600 font-semibold">Tambah</li>
            </ol>
        </nav>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-lg rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-700 mb-4">Formulir Tambah Kunjungan Lansia</h3>

                <form action="{{ route('kunjungan-lansia.store') }}" method="POST">
                    @csrf

                    <!-- Nama -->
                    <div class="mb-4">
                        <label for="anggota_keluarga_id" class="block text-sm font-medium text-gray-700">Nama Lansia</label>
                        <!-- Input hidden untuk mengirim id Lansia  -->
                        <input type="hidden" name="anggota_keluarga_id" value="{{ $anggotaKeluarga->id }}">
                        @if(isset($anggotaKeluarga))
                            <!-- Input hidden untuk mengirim nama Lansia -->
                            <input type="hidden" name="nama_lansia" value="{{ $anggotaKeluarga->nama_lengkap }}">
                            <p class="mt-1 text-sm text-gray-800 bg-gray-100 p-2 rounded">{{ $anggotaKeluarga->nama_lengkap }}</p>
                        @else
                            <p class="mt-1 text-sm text-gray-800 bg-gray-100 p-2 rounded">-</p>
                        @endif
                    </div>

                    <!-- Tanggal Kunjungan -->
                    <div class="mb-4">
                        <label for="tanggal" class="block text-sm font-medium text-gray-700">Tanggal Kunjungan</label>
                        <input type="date" name="tanggal" id="tanggal" value="{{ old('tanggal') }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
                    </div>

                    <!-- Pemantauan Suhu Tubuh -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Pemantauan Suhu Tubuh</label>
                        <div class="mt-1">
                            <label class="inline-flex items-center">
                                <input type="radio" name="suhu_tubuh" value="<37,5°C" class="form-radio">
                                <span class="ml-2">&lt;37,5°C</span>
                            </label>
                            <label class="inline-flex items-center ml-4">
                                <input type="radio" name="suhu_tubuh" value="≥37,5°C" class="form-radio">
                                <span class="ml-2">≥37,5°C</span>
                            </label>
                        </div>
                    </div>

                    <!-- Pemeriksaan Tekanan Darah -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Pemeriksaan Tekanan Darah dalam satu tahun terakhir</label>
                        <div class="space-y-2 mt-2">
                            <div class="flex flex-col md:flex-row gap-4">
                                <!-- Tanggal Pemeriksaan -->
                                <div class="flex-1">
                                    <label for="pemeriksaan_tekanan_darah_tahun_terakhir" class="block text-sm text-gray-700">Tanggal</label>
                                    <input type="date" name="pemeriksaan_tekanan_darah_tahun_terakhir" id="pemeriksaan_tekanan_darah_tahun_terakhir" value="{{ old('pemeriksaan_tekanan_darah_tahun_terakhir') }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
                                </div>

                                <!-- Tempat Pemeriksaan -->
                                <div class="flex-1">
                                    <label for="tempat_pemeriksaan_tekanan_darah_tahun_terakhir" class="block text-sm text-gray-700">Tempat</label>
                                    <input type="text" name="tempat_pemeriksaan_tekanan_darah_tahun_terakhir" id="tempat_pemeriksaan_tekanan_darah_tahun_terakhir" value="{{ old('tempat_pemeriksaan_tekanan_darah_tahun_terakhir') }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm" placeholder="Contoh: Klinik Y">
                                </div>

                                <!-- Hasil Pemeriksaan -->
                                <div class="flex-1">
                                    <label for="hasil_pemeriksaan_tekanan_darah_tahun_terakhir" class="block text-sm text-gray-700">Hasil</label>
                                    <input type="text" name="hasil_pemeriksaan_tekanan_darah_tahun_terakhir" id="hasil_pemeriksaan_tekanan_darah_tahun_terakhir" value="{{ old('hasil_pemeriksaan_tekanan_darah_tahun_terakhir') }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm" placeholder="Contoh: 120/80 mmHg">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Terdiagnosa Darah Tinggi / Hipertensi -->
                    <div class="mb-4">
                        <label for="terdiagnosa_hipertensi_tahun_terakhir" class="block text-sm font-medium text-gray-700">Terdiagnosa Darah Tinggi / Hipertensi</label>
                        <input type="date" name="terdiagnosa_hipertensi_tahun_terakhir" id="terdiagnosa_hipertensi_tahun_terakhir" value="{{ old('terdiagnosa_hipertensi_tahun_terakhir') }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
                    </div>

                    <!-- Pemeriksaan Tekanan Darah dalam satu bulan terakhir -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Pemeriksaan dalam satu bulan terakhir</label>
                        <div class="space-y-2 mt-2">
                            <div class="flex flex-col md:flex-row gap-4">
                                <!-- Tanggal Pemeriksaan -->
                                <div class="flex-1">
                                    <label for="pemeriksaan_tekanan_darah_bulan_terakhir" class="block text-sm text-gray-700">Tanggal</label>
                                    <input type="date" name="pemeriksaan_tekanan_darah_bulan_terakhir" id="pemeriksaan_tekanan_darah_bulan_terakhir" value="{{ old('pemeriksaan_tekanan_darah_bulan_terakhir') }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
                                </div>

                                <!-- Tempat Pemeriksaan -->
                                <div class="flex-1">
                                    <label for="tempat_pemeriksaan_tekanan_darah_bulan_terakhir" class="block text-sm text-gray-700">Tempat</label>
                                    <input type="text" name="tempat_pemeriksaan_tekanan_darah_bulan_terakhir" id="tempat_pemeriksaan_tekanan_darah_bulan_terakhir" value="{{ old('tempat_pemeriksaan_tekanan_darah_bulan_terakhir') }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm" placeholder="Contoh: Klinik Y">
                                </div>

                                <!-- Hasil Pemeriksaan -->
                                <div class="flex-1">
                                    <label for="hasil_pemeriksaan_tekanan_darah_bulan_terakhir" class="block text-sm text-gray-700">Hasil</label>
                                    <input type="text" name="hasil_pemeriksaan_tekanan_darah_bulan_terakhir" id="hasil_pemeriksaan_tekanan_darah_bulan_terakhir" value="{{ old('hasil_pemeriksaan_tekanan_darah_bulan_terakhir') }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm" placeholder="Contoh: 120/80 mmHg">
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
                        <label class="block text-sm font-medium text-gray-700">Pemeriksaan Kadar Gula Darah dalam satu tahun terakhir</label>
                        <div class="space-y-2 mt-2">
                            <div class="flex flex-col md:flex-row gap-4">
                                <!-- Tanggal Pemeriksaan -->
                                <div class="flex-1">
                                    <label for="pemeriksaan_gula_darah_tahun_terakhir" class="block text-sm text-gray-700">Tanggal</label>
                                    <input type="date" name="pemeriksaan_gula_darah_tahun_terakhir" id="pemeriksaan_gula_darah_tahun_terakhir" value="{{ old('pemeriksaan_gula_darah_tahun_terakhir') }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
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

                    <!-- Pemeriksaan dalam satu bulan terakhir -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Pemeriksaan dalam satu bulan terakhir</label>
                        <div class="space-y-2 mt-2">
                            <div class="flex flex-col md:flex-row gap-4">
                                <!-- Tanggal Pemeriksaan -->
                                <div class="flex-1">
                                    <label for="pemeriksaan_gula_darah_bulan_terakhir" class="block text-sm text-gray-700">Tanggal</label>
                                    <input type="date" name="pemeriksaan_gula_darah_bulan_terakhir" id="pemeriksaan_gula_darah_bulan_terakhir" value="{{ old('pemeriksaan_gula_darah_bulan_terakhir') }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
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
                    <!-- Skriring / Pemeriksaan Geriatri -->
                    <div class="mb-4">
                        <h3 class="text-lg font-semibold text-gray-700 mb-4">Skriring / Pemeriksaan Geriatri</h3>

                        <!-- Aktifitas Kehidupan Sehari-hari (AKS) -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Aktifitas Kehidupan Sehari-hari (AKS)</label>
                            <div class="space-y-2 mt-2">
                                <div class="flex flex-col md:flex-row gap-4">
                                    <!-- Tanggal AKS -->
                                    <div class="flex-1">
                                        <label for="aks_tanggal" class="block text-sm text-gray-700">Tanggal</label>
                                        <input type="date" name="aks_tanggal" id="aks_tanggal" value="{{ old('aks_tanggal') }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
                                    </div>

                                    <!-- Tempat AKS -->
                                    <div class="flex-1">
                                        <label for="aks_tempat" class="block text-sm text-gray-700">Tempat</label>
                                        <input type="text" name="aks_tempat" id="aks_tempat" value="{{ old('aks_tempat') }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm" placeholder="Contoh: Puskesmas X">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Skrining Lansia Sederhana (SKILAS) -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Skrining Lansia Sederhana (SKILAS)</label>
                            <div class="space-y-2 mt-2">
                                <div class="flex flex-col md:flex-row gap-4">
                                    <!-- Tanggal SKILAS -->
                                    <div class="flex-1">
                                        <label for="skilas_tanggal" class="block text-sm text-gray-700">Tanggal</label>
                                        <input type="date" name="skilas_tanggal" id="skilas_tanggal" value="{{ old('skilas_tanggal') }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
                                    </div>

                                    <!-- Tempat SKILAS -->
                                    <div class="flex-1">
                                        <label for="skilas_tempat" class="block text-sm text-gray-700">Tempat</label>
                                        <input type="text" name="skilas_tempat" id="skilas_tempat" value="{{ old('skilas_tempat') }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm" placeholder="Contoh: Puskesmas X">
                                    </div>
                                </div>
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

                        <!-- Melakukan Skrining Kesehatan Jiwa -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Melakukan Skrining Kesehatan Jiwa</label>
                            <div class="space-y-2 mt-2">
                                <div class="flex flex-col md:flex-row gap-4">
                                    <!-- Tanggal Skrining -->
                                    <div class="flex-1">
                                        <label for="skrining_kesehatan_jiwa_tanggal" class="block text-sm text-gray-700">Tanggal</label>
                                        <input type="date" name="skrining_kesehatan_jiwa_tanggal" id="skrining_kesehatan_jiwa_tanggal" value="{{ old('skrining_kesehatan_jiwa_tanggal') }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
                                    </div>

                                    <!-- Tempat Skrining -->
                                    <div class="flex-1">
                                        <label for="skrining_kesehatan_jiwa_tempat" class="block text-sm text-gray-700">Tempat</label>
                                        <input type="text" name="skrining_kesehatan_jiwa_tempat" id="skrining_kesehatan_jiwa_tempat" value="{{ old('skrining_kesehatan_jiwa_tempat') }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm" placeholder="Contoh: Rumah Sakit X">
                                    </div>

                                    <!-- Petugas Skrining -->
                                    <div class="flex-1">
                                        <label for="skrining_kesehatan_jiwa_petugas" class="block text-sm text-gray-700">Petugas</label>
                                        <input type="text" name="skrining_kesehatan_jiwa_petugas" id="skrining_kesehatan_jiwa_petugas" value="{{ old('skrining_kesehatan_jiwa_petugas') }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm" placeholder="Contoh: Nama Petugas">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pemberian Edukasi/Kunjungan Nakes -->
                        <div class="mb-4">
                            <label for="pemberian_edukasi" class="block text-sm font-medium text-gray-700">Pemberian Edukasi/Kunjungan Nakes</label>
                            <input type="text" name="pemberian_edukasi" id="pemberian_edukasi" value="{{ old('pemberian_edukasi') }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
                        </div>

                        <!-- Paraf Lansia -->
                        <div class="mb-4">
                            <label for="paraf_lansia" class="block text-sm font-medium text-gray-700">Paraf Lansia</label>
                            <input type="text" name="paraf_lansia" id="paraf_lansia" value="{{ old('paraf_lansia') }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
                        </div>
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
