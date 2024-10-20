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
                                <label for="umur_remaja" class="block text-sm font-medium text-gray-700">Umur Remaja</label>
                                @if(isset($anggotaKeluarga) && $anggotaKeluarga->tanggal_lahir)
                                    @php
                                        $tanggalLahir = \Carbon\Carbon::parse($anggotaKeluarga->tanggal_lahir);
                                        $umur = $tanggalLahir->age;
                                    @endphp
                                    <!-- Input hidden untuk mengirim umur Remaja  -->
                                    <input type="hidden" name="umur_balita" value="{{ $umur }}">
                                    <input type="number" id="umur" name="umur" value="{{ $umur }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 bg-gray-100" readonly>
                                @else
                                    <input type="number" id="umur" name="umur" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
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
                            <input type="date" name="waktu_kunjungan" id="waktu_kunjungan" value="{{ old('waktu_kunjungan') }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm" required>
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
                                    <input type="radio" name="suhu_tubuh" value="<37,5°C" class="form-radio" required>
                                    <span class="ml-2">&lt;37,5°C</span>
                                </label>
                                <label class="inline-flex items-center ml-4">
                                    <input type="radio" name="suhu_tubuh" value="≥37,5°C" class="form-radio" required>
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
                            <div class="w-1/2">
                                <label for="bb" class="block text-sm font-medium text-gray-700">BB (Berat Badan)</label>
                                <input type="number" name="bb" id="bb" value="{{ old('bb') }}" step="0.1" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
                            </div>

                            <div class="w-1/2">
                                <label for="tb" class="block text-sm font-medium text-gray-700">TB (Tinggi Badan)</label>
                                <input type="number" name="tb" id="tb" value="{{ old('tb') }}" step="0.1" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
                            </div>
                        </div>

                        <!-- Ada TTD -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Ada TTD</label>
                            <div class="mt-1">
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

                        <!-- Minum TTD -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Minum TTD (Minggu Ini)</label>
                            <div class="mt-1">
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

                        <!-- Pemeriksaan anemia -->
                        <div class="mb-4">
                            <label for="tanggal_pemeriksaan_anemia" class="block text-sm font-medium text-gray-700">Tanggal Pemeriksaan Anemia</label>
                            <input type="date" name="tanggal_pemeriksaan_anemia" id="tanggal_pemeriksaan_anemia" value="{{ old('tanggal_pemeriksaan_anemia') }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
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

                    </div>

                    <div class="flex justify-end mt-6">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
