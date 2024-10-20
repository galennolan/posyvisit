<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Edit Data Kunjungan Ibu Bersalin dan Nifas') }}
        </h2>
        <nav class="breadcrumb">
            <ol class="list-reset flex text-sm">
                <li><a href="/dashboard" class="text-blue-600 hover:text-blue-800">Home</a></li>
                <li><span class="mx-2">/</span></li>
                <li><a href="{{ route('kunjungan-ibu-bersalin.index') }}" class="text-blue-600 hover:text-blue-800">Kunjungan Ibu Bersalin dan Nifas</a></li>
                <li><span class="mx-2">/</span></li>
                <li class="text-blue-600 font-semibold">Edit</li>
            </ol>
        </nav>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-lg rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-700 mb-4">Formulir Edit Kunjungan Ibu Bersalin</h3>

                <form action="{{ route('kunjungan-ibu-bersalin.update', $kunjungan->id) }}" method="POST">
                    @csrf
                    @method('PUT') <!-- Method PUT untuk update data -->

                    <!-- Nama Ibu -->
                    <div class="mb-4">
                        <label for="nama_ibu" class="block text-sm font-medium text-gray-700">Nama Ibu</label>
                        <p class="mt-1 text-sm text-gray-800 bg-gray-100 p-2 rounded">{{ $kunjungan->nama_ibu }}</p>
                        <!-- Hidden input untuk anggota_keluarga_id -->
                        <input type="hidden" name="anggota_keluarga_id" value="{{ $kunjungan->anggota_keluarga_id }}">
                        <!-- Hidden input untuk nama ibu -->
                        <input type="hidden" name="nama_ibu" value="{{ $kunjungan->nama_ibu }}">
                    </div>

                    <!-- Umur Ibu -->
                    <div class="mb-4">
                        <label for="umur_ibu" class="block text-sm font-medium text-gray-700">Umur Ibu</label>
                        <input type="number" id="umur_ibu" name="umur_ibu" value="{{ $kunjungan->umur_ibu }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 bg-gray-100" readonly>
                    </div>

                    <!-- Tanggal Persalinan -->
                    <div class="mb-4">
                        <label for="tanggal_persalinan" class="block text-sm font-medium text-gray-700">Tanggal Persalinan</label>
                        <input type="date" id="tanggal_persalinan" name="tanggal_persalinan" value="{{ $kunjungan->tanggal_persalinan }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm" required>
                    </div>

                    <!-- Usia Kehamilan Saat Persalinan -->
                    <div class="mb-4">
                        <label for="usia_kehamilan_saat_persalinan" class="block text-sm font-medium text-gray-700">Usia Kehamilan Saat Persalinan (minggu)</label>
                        <input type="number" id="usia_kehamilan_saat_persalinan" name="usia_kehamilan_saat_persalinan" value="{{ $kunjungan->usia_kehamilan_saat_persalinan }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm" min="20" max="45" required>
                    </div>

                    <!-- Kelahiran Anak Ke -->
                    <div class="mb-4">
                        <label for="kelahiran_anak_ke" class="block text-sm font-medium text-gray-700">Kelahiran Anak Ke</label>
                        <input type="number" id="kelahiran_anak_ke" name="kelahiran_anak_ke" value="{{ $kunjungan->kelahiran_anak_ke }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm" required>
                    </div>

                    <!-- Pukul Persalinan -->
                    <div class="mb-4">
                        <label for="pukul_persalinan" class="block text-sm font-medium text-gray-700">Pukul Persalinan</label>
                        <input type="time" id="pukul_persalinan" name="pukul_persalinan" value="{{ $kunjungan->pukul_persalinan }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm" required>
                    </div>

                    <!-- Penolong Persalinan -->
                    <div class="mb-4">
                        <label for="penolong_persalinan" class="block text-sm font-medium text-gray-700">Penolong Persalinan</label>
                        <select id="penolong_persalinan" name="penolong_persalinan" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm" required>
                            <option value="Bidan" {{ $kunjungan->penolong_persalinan == 'Bidan' ? 'selected' : '' }}>Bidan</option>
                            <option value="Dokter Umum" {{ $kunjungan->penolong_persalinan == 'Dokter Umum' ? 'selected' : '' }}>Dokter Umum</option>
                            <option value="Dokter SpOG" {{ $kunjungan->penolong_persalinan == 'Dokter SpOG' ? 'selected' : '' }}>Dokter SpOG</option>
                            <option value="Lainnya" {{ $kunjungan->penolong_persalinan == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                    </div>

                    <!-- Tempat Persalinan -->
                    <div class="mb-4">
                        <label for="tempat_persalinan" class="block text-sm font-medium text-gray-700">Tempat Persalinan</label>
                        <select id="tempat_persalinan" name="tempat_persalinan" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm" required>
                            <option value="Posyandu Prima" {{ $kunjungan->tempat_persalinan == 'Posyandu Prima' ? 'selected' : '' }}>Posyandu Prima</option>
                            <option value="Puskesmas" {{ $kunjungan->tempat_persalinan == 'Puskesmas' ? 'selected' : '' }}>Puskesmas</option>
                            <option value="Rumah Sakit" {{ $kunjungan->tempat_persalinan == 'Rumah Sakit' ? 'selected' : '' }}>Rumah Sakit</option>
                            <option value="Klinik" {{ $kunjungan->tempat_persalinan == 'Klinik' ? 'selected' : '' }}>Klinik</option>
                            <option value="Bidan Praktik Mandiri" {{ $kunjungan->tempat_persalinan == 'Bidan Praktik Mandiri' ? 'selected' : '' }}>Bidan Praktik Mandiri</option>
                            <option value="Lainnya" {{ $kunjungan->tempat_persalinan == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                    </div>

                    <!-- Keadaan Ibu -->
                    <div class="mb-4">
                        <label for="keadaan_ibu" class="block text-sm font-medium text-gray-700">Keadaan Ibu</label>
                        <select id="keadaan_ibu" name="keadaan_ibu" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm" required>
                            <option value="Sehat" {{ $kunjungan->keadaan_ibu == 'Sehat' ? 'selected' : '' }}>Sehat</option>
                            <option value="Pendarahan" {{ $kunjungan->keadaan_ibu == 'Pendarahan' ? 'selected' : '' }}>Pendarahan</option>
                            <option value="Demam" {{ $kunjungan->keadaan_ibu == 'Demam' ? 'selected' : '' }}>Demam</option>
                            <option value="Kejang" {{ $kunjungan->keadaan_ibu == 'Kejang' ? 'selected' : '' }}>Kejang</option>
                            <option value="Lokhia Berbau" {{ $kunjungan->keadaan_ibu == 'Lokhia Berbau' ? 'selected' : '' }}>Lokhia Berbau</option>
                            <option value="Lainnya" {{ $kunjungan->keadaan_ibu == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                    </div>

                    <!-- Inisiasi Menyusu Dini (IMD) -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Inisiasi Menyusu Dini (IMD)</label>
                        <div class="mt-1">
                            <label class="inline-flex items-center">
                                <input type="radio" name="inisiasi_menyusu_dini" value="1" {{ $kunjungan->inisiasi_menyusu_dini == 1 ? 'checked' : '' }} class="form-radio" required>
                                <span class="ml-2">Ya</span>
                            </label>
                            <label class="inline-flex items-center ml-4">
                                <input type="radio" name="inisiasi_menyusu_dini" value="0" {{ $kunjungan->inisiasi_menyusu_dini == 0 ? 'checked' : '' }} class="form-radio" required>
                                <span class="ml-2">Tidak</span>
                            </label>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end items-center mt-6 space-x-2">
                        <button type="submit" class="bg-gray-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded shadow">
                            Simpan Perubahan
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
