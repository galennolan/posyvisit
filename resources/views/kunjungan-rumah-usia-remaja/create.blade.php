<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Tambah Data Checklist Kunjungan Rumah Usia Sekolah dan Remaja') }}
        </h2>
        <nav class="breadcrumb">
            <ol class="list-reset flex text-sm">
                <li><a href="/dashboard" class="text-blue-600 hover:text-blue-800">Home</a></li>
                <li><span class="mx-2">/</span></li>
                <li><a href="{{ route('kunjungan-rumah-usia-remaja.index') }}" class="text-blue-600 hover:text-blue-800">Checklist Kunjungan Usia Sekolah</a></li>
                <li><span class="mx-2">/</span></li>
                <li class="text-blue-600 font-semibold">Tambah</li>
            </ol>
        </nav>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-lg rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-700 mb-4">Formulir Tambah Kunjungan</h3>

                <form action="{{ route('kunjungan-rumah-usia-remaja.store') }}" method="POST">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Nama -->
                        <div class="mb-4">
                                <label for="nama_remaja" class="block text-sm font-medium text-gray-700">Nama Remaja</label>
                                <!-- Input hidden untuk mengirim id Remaja  -->
                                <input type="hidden" name="anggota_keluarga_id" value="{{ $anggotaKeluarga->id }}">
                                @if(isset($anggotaKeluarga))
                                    <!-- Input hidden untuk mengirim nama Remaja -->
                                    <input type="hidden" name="nama_remaja" value="{{ $anggotaKeluarga->nama_lengkap }}">
                                    <p class="mt-1 text-sm text-gray-800 bg-gray-100 p-2 rounded">{{ $anggotaKeluarga->nama_lengkap }}</p>
                                @else
                                    <p class="mt-1 text-sm text-gray-800 bg-gray-100 p-2 rounded">-</p>
                                @endif
                            </div>

                            <!-- Umur Balita -->
                            <div class="mb-4">
                                <label for="umur" class="block text-sm font-medium text-gray-700">Umur Remaja</label>
                                @if(isset($anggotaKeluarga) && $anggotaKeluarga->tanggal_lahir)
                                    @php
                                        $tanggalLahir = \Carbon\Carbon::parse($anggotaKeluarga->tanggal_lahir);
                                        $umur = $tanggalLahir->age;
                                    @endphp
                                    <!-- Input hidden untuk mengirim umur Remaja atau Pra sekolah -->
                                    <input type="hidden" name="umur_balita" value="{{ $umur }}">
                                    <input type="number" id="umur" name="umur" value="{{ $umur }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 bg-gray-100" readonly >
                                @else
                                    <input type="number" id="umur" name="umur" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                @endif
                            </div>

                        <!-- Jenis Kelamin -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                            <div class="mt-1">
                                <label class="inline-flex items-center">
                                    <input type="radio" name="jenis_kelamin" value="Laki-Laki" class="form-radio" required>
                                    <span class="ml-2">Laki-Laki</span>
                                </label>
                                <label class="inline-flex items-center ml-4">
                                    <input type="radio" name="jenis_kelamin" value="Wanita" class="form-radio" required>
                                    <span class="ml-2">Wanita</span>
                                </label>
                            </div>
                        </div>

                        <!-- Waktu Kunjungan -->
                        <div class="mb-4">
                            <label for="waktu_kunjungan" class="block text-sm font-medium text-gray-700">Waktu Kunjungan</label>
                            <input type="date" name="waktu_kunjungan" id="waktu_kunjungan" value="{{ old('waktu_kunjungan') }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
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

                        <!-- Tanggal Terakhir Menimbang dan Mengukur -->
                        <div class="mb-4">
                            <label for="tanggal_terakhir_menimbang_mengukur" class="block text-sm font-medium text-gray-700">Tanggal Terakhir Menimbang dan Mengukur</label>
                            <input type="date" name="tanggal_terakhir_menimbang_mengukur" id="tanggal_terakhir_menimbang_mengukur" value="{{ old('tanggal_terakhir_menimbang_mengukur') }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
                        </div>

                        <!-- Isi Piringku Usia Sekolah/Remaja -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Isi Piringku Usia Sekolah/Remaja</label>
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

                        <!-- BB dan TB -->
                        <div class="flex space-x-4 mb-4">
                            <div class="w-1/3">
                                <label for="bb" class="block text-sm font-medium text-gray-700">BB (Berat Badan)</label>
                                <input type="number" name="bb" id="bb" value="{{ old('bb') }}" step="0.1" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
                            </div>

                            <div class="w-1/3">
                                <label for="tb" class="block text-sm font-medium text-gray-700">TB (Tinggi Badan)</label>
                                <input type="number" name="tb" id="tb" value="{{ old('tb') }}" step="0.1" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
                            </div>
                            <div class="w-1/3">
                                <label for="lp" class="block text-sm font-medium text-gray-700">LP (Lingkar Pinggang)</label>
                                <input type="number" name="lp" id="lp" value="{{ old('lp') }}" step="0.1" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
                            </div>
                        </div>

                        <!-- Ada TTD -->
                        <div class="mb-4 flex flex-wrap -mx-2">
                        <!-- Kolom Kiri -->
                        <div class="w-full md:w-1/2 px-2">
                            <label class="block text-sm font-medium text-gray-700">Ada TTD</label>
                            <div class="mt-1 flex">
                                <label class="inline-flex items-center">
                                    <input type="radio" name="ada_ttd" value="1" class="form-radio">
                                    <span class="ml-2">Ya</span>
                                </label>
                                <label class="inline-flex items-center ml-4">
                                    <input type="radio" name="ada_ttd" value="0" class="form-radio">
                                    <span class="ml-2">Tidak</span>
                                </label>
                            </div>
                        </div>

                        <!-- Kolom Kanan -->
                        <div class="w-full md:w-1/2 px-2">
                            <label class="block text-sm font-medium text-gray-700">Minum TTD (Minggu Ini)</label>
                            <div class="mt-1 flex">
                                <label class="inline-flex items-center">
                                    <input type="radio" name="minum_ttd" value="Ya" class="form-radio">
                                    <span class="ml-2">Ya</span>
                                </label>
                                <label class="inline-flex items-center ml-4">
                                    <input type="radio" name="minum_ttd" value="Tidak" class="form-radio">
                                    <span class="ml-2">Tidak</span>
                                </label>
                            </div>
                        </div>
                    </div>


                       <!-- Pemeriksaan Anemia -->
                        <div class="mb-4">
                            <label for="tanggal_pemeriksaan_anemia" class="block text-sm font-medium text-gray-700">
                                Pemeriksaan Anemia (Skrining Hb) - Satu Tahun Terakhir
                            </label>
                            <div class="space-y-2">
                                <!-- Pemeriksaan ke-1 -->
                                <div class="flex flex-col md:flex-row gap-4">
                                    <div class="flex-1">
                                        <label for="tanggal_pemeriksaan_1" class="block text-sm text-gray-700">Tanggal</label>
                                        <input type="date" name="tanggal_pemeriksaan_1" id="tanggal_pemeriksaan_1" value="{{ old('tanggal_pemeriksaan_1') }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
                                    </div>
                                    <div class="flex-1">
                                        <label for="tempat_pemeriksaan_1" class="block text-sm text-gray-700">Tempat</label>
                                        <input type="text" name="tempat_pemeriksaan_1" id="tempat_pemeriksaan_1" value="{{ old('tempat_pemeriksaan_1') }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm" placeholder="Contoh: Puskesmas A">
                                    </div>
                                    <div class="flex-1">
                                        <label for="hasil_pemeriksaan_1" class="block text-sm text-gray-700">Hasil</label>
                                        <input type="text" name="hasil_pemeriksaan_1" id="hasil_pemeriksaan_1" value="{{ old('hasil_pemeriksaan_1') }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm" placeholder="Contoh: 12.5 g/dL">
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
                        <!-- Pemeriksaan Gula Darah -->
                        <div class="mb-4">
                            <label for="tanggal_pemeriksaan_gula" class="block text-sm font-medium text-gray-700">
                                Pemeriksaan Gula Darah
                            </label>
                            <div class="space-y-2 mt-2">
                                <div class="flex flex-col md:flex-row gap-4">
                                    <!-- Tanggal Pemeriksaan -->
                                    <div class="flex-1">
                                        <label for="tanggal_pemeriksaan_gula" class="block text-sm text-gray-700">Tanggal</label>
                                        <input type="date" name="tanggal_pemeriksaan_gula" id="tanggal_pemeriksaan_gula" value="{{ old('tanggal_pemeriksaan_gula') }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
                                    </div>

                                    <!-- Tempat Pemeriksaan -->
                                    <div class="flex-1">
                                        <label for="tempat_pemeriksaan_gula" class="block text-sm text-gray-700">Tempat</label>
                                        <input type="text" name="tempat_pemeriksaan_gula" id="tempat_pemeriksaan_gula" value="{{ old('tempat_pemeriksaan_gula') }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm" placeholder="Contoh: Puskesmas X">
                                    </div>

                                    <!-- Hasil Pemeriksaan -->
                                    <div class="flex-1">
                                        <label for="hasil_pemeriksaan_gula" class="block text-sm text-gray-700">Hasil</label>
                                        <input type="text" name="hasil_pemeriksaan_gula" id="hasil_pemeriksaan_gula" value="{{ old('hasil_pemeriksaan_gula') }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm" placeholder="Contoh: 120 mg/dL">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pemeriksaan Tekanan Darah -->
                        <div class="mb-4">
                            <label for="tanggal_pemeriksaan_tekanan" class="block text-sm font-medium text-gray-700">
                                Pemeriksaan Tekanan Darah
                            </label>
                            <div class="space-y-2 mt-2">
                                <div class="flex flex-col md:flex-row gap-4">
                                    <!-- Tanggal Pemeriksaan -->
                                    <div class="flex-1">
                                        <label for="tanggal_pemeriksaan_tekanan" class="block text-sm text-gray-700">Tanggal</label>
                                        <input type="date" name="tanggal_pemeriksaan_tekanan" id="tanggal_pemeriksaan_tekanan" value="{{ old('tanggal_pemeriksaan_tekanan') }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
                                    </div>

                                    <!-- Tempat Pemeriksaan -->
                                    <div class="flex-1">
                                        <label for="tempat_pemeriksaan_tekanan" class="block text-sm text-gray-700">Tempat</label>
                                        <input type="text" name="tempat_pemeriksaan_tekanan" id="tempat_pemeriksaan_tekanan" value="{{ old('tempat_pemeriksaan_tekanan') }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm" placeholder="Contoh: Klinik Y">
                                    </div>

                                    <!-- Hasil Pemeriksaan (Sistolik / Diastolik) -->
                                    <div class="flex-1">
                                        <label for="hasil_pemeriksaan_tekanan" class="block text-sm text-gray-700">Hasil (mmHg)</label>
                                        <input type="text" name="hasil_pemeriksaan_tekanan" id="hasil_pemeriksaan_tekanan" value="{{ old('hasil_pemeriksaan_tekanan') }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm" placeholder="Contoh: 120/80">
                                    </div>
                                </div>
                            </div>
                        </div>

                    <!-- Skrining Kesehatan Jiwa -->
                    <div class="mb-4">
                        <label for="tanggal_skrining_jiwa" class="block text-sm font-medium text-gray-700">
                            Skrining Kesehatan Jiwa
                        </label>
                        <div class="space-y-2 mt-2">
                            <div class="flex flex-col md:flex-row gap-4">
                                <!-- Tanggal Skrining -->
                                <div class="flex-1">
                                    <label for="tanggal_skrining_jiwa" class="block text-sm text-gray-700">Tanggal</label>
                                    <input type="date" name="tanggal_skrining_jiwa" id="tanggal_skrining_jiwa" value="{{ old('tanggal_skrining_jiwa') }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
                                </div>

                                <!-- Tempat Skrining -->
                                <div class="flex-1">
                                    <label for="tempat_skrining_jiwa" class="block text-sm text-gray-700">Tempat</label>
                                    <input type="text" name="tempat_skrining_jiwa" id="tempat_skrining_jiwa" value="{{ old('tempat_skrining_jiwa') }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm" placeholder="Contoh: Rumah Sakit X">
                                </div>

                                <!-- Hasil Skrining -->
                                <div class="flex-1">
                                    <label for="hasil_skrining_jiwa" class="block text-sm text-gray-700">Hasil</label>
                                    <input type="text" name="hasil_skrining_jiwa" id="hasil_skrining_jiwa" value="{{ old('hasil_skrining_jiwa') }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm" placeholder="Contoh: Normal / Perlu Konseling">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Pemberian Edukasi / Kunjungan Nakes -->
                    <div class="flex space-x-4 mb-4">
                        <div class="w-1/2">
                            <label for="pemberian_edukasi" class="block text-sm font-medium text-gray-700">Pemberian Edukasi / Kunjungan Nakes</label>
                            <input type="text" name="pemberian_edukasi" id="pemberian_edukasi" value="{{ old('pemberian_edukasi') }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
                        </div>

                        <div class="w-1/2">
                            <label for="paraf_remaja" class="block text-sm font-medium text-gray-700">Paraf Remaja Setelah Wawancara</label>
                            <input type="text" name="paraf_remaja" id="paraf_remaja" value="{{ old('paraf_remaja') }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
                        </div>
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
