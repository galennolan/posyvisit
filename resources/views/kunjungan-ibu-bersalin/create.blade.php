    <x-app-layout>
        <x-slot name="header">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Tambah Data Kunjungan Ibu Bersalin dan Nifas') }}
            </h2>
            <nav class="breadcrumb">
                <ol class="list-reset flex text-sm">
                    <li><a href="/dashboard" class="text-blue-600 hover:text-blue-800">Home</a></li>
                    <li><span class="mx-2">/</span></li>
                    <li><a href="{{ route('kunjungan-ibu-bersalin.index') }}" class="text-blue-600 hover:text-blue-800">Kunjungan Ibu Bersalin dan Nifas</a></li>
                    <li><span class="mx-2">/</span></li>
                    <li class="text-blue-600 font-semibold">Tambah</li>
                </ol>
            </nav>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white shadow-lg rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-700 mb-4">Formulir Tambah Kunjungan Ibu Bersalin</h3>

                    <form action="{{ route('kunjungan-ibu-bersalin.store') }}" method="POST">
                        @csrf

                

                        <!-- Nama Ibu -->
                        <div class="mb-4">
                            <label for="nama_ibu" class="block text-sm font-medium text-gray-700">Nama Ibu</label>
                            <!-- Input hidden untuk mengirim id ibu -->
                            <input type="hidden" name="anggota_keluarga_id" value="{{ $anggotaKeluarga->id }}">
                            @if(isset($anggotaKeluarga))
                                <!-- Input hidden untuk mengirim nama ibu -->
                                <input type="hidden" name="nama_ibu" value="{{ $anggotaKeluarga->nama_lengkap }}">
                                <p class="mt-1 text-sm text-gray-800 bg-gray-100 p-2 rounded">{{ $anggotaKeluarga->nama_lengkap }}</p>
                            @else
                                <p class="mt-1 text-sm text-gray-800 bg-gray-100 p-2 rounded">-</p>
                            @endif
                        </div>

                        <!-- Umur Ibu -->
                        <div class="mb-4">
                            <label for="umur_ibu" class="block text-sm font-medium text-gray-700">Umur Ibu</label>
                            @if(isset($anggotaKeluarga) && $anggotaKeluarga->tanggal_lahir)
                                @php
                                    $tanggalLahir = \Carbon\Carbon::parse($anggotaKeluarga->tanggal_lahir);
                                    $umur = $tanggalLahir->age;
                                @endphp
                                <!-- Input hidden untuk mengirim umur ibu -->
                                <input type="hidden" name="umur_ibu" value="{{ $umur }}">
                                <input type="number" id="umur" name="umur" value="{{ $umur }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 bg-gray-100" readonly>
                            @else
                                <input type="number" id="umur" name="umur" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                            @endif
                        </div>


                        <!-- Tanggal Persalinan -->
                        <div class="mb-4">
                            <label for="tanggal_persalinan" class="block text-sm font-medium text-gray-700">Tanggal Persalinan</label>
                            <input type="date" id="tanggal_persalinan" name="tanggal_persalinan" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm" required>
                        </div>

                        <!-- Usia Kehamilan Saat Persalinan -->
                        <div class="mb-4">
                            <label for="usia_kehamilan_saat_persalinan" class="block text-sm font-medium text-gray-700">Usia Kehamilan Saat Persalinan (minggu)</label>
                            <input type="number" id="usia_kehamilan_saat_persalinan" name="usia_kehamilan_saat_persalinan" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm" min="20" max="45" required>
                        </div>

                        <!-- Kelahiran Anak Ke -->
                        <div class="mb-4">
                            <label for="kelahiran_anak_ke" class="block text-sm font-medium text-gray-700">Kelahiran Anak Ke</label>
                            <input type="number" id="kelahiran_anak_ke" name="kelahiran_anak_ke" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm" required>
                        </div>

                        <!-- Pukul Persalinan -->
                        <div class="mb-4">
                            <label for="pukul_persalinan" class="block text-sm font-medium text-gray-700">Pukul Persalinan</label>
                            <input type="time" id="pukul_persalinan" name="pukul_persalinan" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm" required>
                        </div>

                        <!-- Penolong Persalinan -->
                        <div class="mb-4">
                            <label for="penolong_persalinan" class="block text-sm font-medium text-gray-700">Penolong Persalinan</label>
                            <select id="penolong_persalinan" name="penolong_persalinan" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm" required>
                                <option value="">-- Pilih Penolong --</option>
                                <option value="Bidan">Bidan</option>
                                <option value="Dokter Umum">Dokter Umum</option>
                                <option value="Dokter SpOG">Dokter SpOG</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>

                        <!-- Tempat Persalinan -->
                        <div class="mb-4">
                            <label for="tempat_persalinan" class="block text-sm font-medium text-gray-700">Tempat Persalinan</label>
                            <select id="tempat_persalinan" name="tempat_persalinan" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm" required>
                                <option value="">-- Pilih Tempat --</option>
                                <option value="Posyandu Prima">Posyandu Prima</option>
                                <option value="Puskesmas">Puskesmas</option>
                                <option value="Rumah Sakit">Rumah Sakit</option>
                                <option value="Klinik">Klinik</option>
                                <option value="Bidan Praktik Mandiri">Bidan Praktik Mandiri</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>

                        <!-- Keadaan Ibu -->
                        <div class="mb-4">
                            <label for="keadaan_ibu" class="block text-sm font-medium text-gray-700">Keadaan Ibu</label>
                            <select id="keadaan_ibu" name="keadaan_ibu" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm" required>
                                <option value="">-- Pilih Keadaan Ibu --</option>
                                <option value="Sehat">Sehat</option>
                                <option value="Pendarahan">Pendarahan</option>
                                <option value="Demam">Demam</option>
                                <option value="Kejang">Kejang</option>
                                <option value="Lokhia Berbau">Lokhia Berbau</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>

                        <!-- Inisiasi Menyusu Dini (IMD) -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Inisiasi Menyusu Dini (IMD)</label>
                            <div class="mt-1">
                                <label class="inline-flex items-center">
                                    <input type="radio" name="inisiasi_menyusu_dini" value="1" class="form-radio" required>
                                    <span class="ml-2">Ya</span>
                                </label>
                                <label class="inline-flex items-center ml-4">
                                    <input type="radio" name="inisiasi_menyusu_dini" value="0" class="form-radio" required>
                                    <span class="ml-2">Tidak</span>
                                </label>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end mt-6">
                            <!-- Tombol Kembali -->
                            <a href="{{ route('keluarga') }}" class="ml-2 bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded shadow inline-block text-center">
                            Kembali
                        </a>
                            <button type="submit" class="ml-2 bg-gray-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded shadow">
                            Simpan Perubahan
                        </button>
                    </div>

                    
                        

                        
                    </form>
                </div>
            </div>
        </div>
    </x-app-layout>
