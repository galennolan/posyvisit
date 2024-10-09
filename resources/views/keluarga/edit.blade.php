<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('FORM CHEKLIST KUNJUNGAN RUMAH') }}
        </h2>
        <nav class="breadcrumb">
            <ol class="list-reset flex text-sm">
                <li><a href="/dashboard" class="text-blue-600 hover:text-blue-800">Home </a></li>
                <li><span class="mx-2">/ </span></li>
                <li class="text-blue-600 font-semibold"> <a href="/keluarga/" class="text-blue-600 hover:text-blue-800">Kunjungan Rumah</a></li>
            </ol>
        </nav>
    </x-slot>

    <div class="py-12 px-6 sm:px-8 lg:px-10">
        <!-- Main Form Card -->
        <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-6 sm:p-8 space-y-6">
            <div class="bg-gradient-to-r from-blue-500 to-indigo-600 p-6 rounded-lg shadow-lg">
                <h3 class="text-2xl font-bold text-white tracking-wide uppercase">
                    Form Checklist Kunjungan Rumah
                </h3>
            </div>

            <form action="{{ route('keluarga.update', $keluarga->id) }}" method="POST" class="p-6 space-y-6">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Tanggal Pengumpulan Data -->
                    <div class="col-span-1">
                        <label for="tanggal_pengumpulan_data" class="block text-sm font-medium text-gray-700">Tanggal Pengumpulan Data</label>
                        <input type="date" id="tanggal_pengumpulan_data" name="tanggal_pengumpulan_data" value="{{ $keluarga->tanggal_pengumpulan_data }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('tanggal_pengumpulan_data') border-red-500 @enderror">
                        @error('tanggal_pengumpulan_data')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Alamat -->
                    <div class="col-span-1">
                        <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
                        <input type="text" id="alamat" name="alamat" value="{{ $keluarga->alamat }}" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:text-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('alamat') border-red-500 @enderror">
                        @error('alamat')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- No Handphone -->
                    <div class="col-span-1">
                        <label for="no_handphone" class="block text-sm font-medium text-gray-700">No Handphone KK / salah satu anggota keluarga</label>
                        <input type="text" id="no_handphone" name="no_handphone" value="{{ $keluarga->no_handphone }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('no_handphone') border-red-500 @enderror">
                        @error('no_handphone')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Kabupaten / Kota -->
                    <div class="col-span-1">
                        <label for="kabupaten" class="block text-sm font-medium text-gray-700">Kabupaten / Kota</label>
                        <input type="text" id="kabupaten" name="kabupaten" value="Solo" readonly class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- Kecamatan -->
                    <div class="col-span-1">
                        <label for="kecamatan" class="block text-sm font-medium text-gray-700">Kecamatan</label>
                        <select id="kecamatan" name="kecamatan" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            <option value="Banjarsari" {{ $keluarga->kecamatan === 'Banjarsari' ? 'selected' : '' }}>Banjarsari</option>
                            <option value="Jebres" {{ $keluarga->kecamatan === 'Jebres' ? 'selected' : '' }}>Jebres</option>
                            <option value="Laweyan" {{ $keluarga->kecamatan === 'Laweyan' ? 'selected' : '' }}>Laweyan</option>
                            <option value="Pasar Kliwon" {{ $keluarga->kecamatan === 'Pasar Kliwon' ? 'selected' : '' }}>Pasar Kliwon</option>
                            <option value="Serengan" {{ $keluarga->kecamatan === 'Serengan' ? 'selected' : '' }}>Serengan</option>
                        </select>
                    </div>

                    <!-- Kelurahan Dropdown -->
                    <div class="col-span-1">
                        <label for="kelurahan" class="block text-sm font-medium text-gray-700">Kelurahan</label>
                        <select id="kelurahan" name="kelurahan" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('kelurahan') border-red-500 @enderror">
                            <option selected disabled>Pilih Kelurahan</option>
                        </select>
                        @error('kelurahan')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>


                    <!-- Puskesmas -->
                    <div class="col-span-1">
                        <label for="puskesmas" class="block text-sm font-medium text-gray-700">Puskesmas</label>
                        <input type="text" id="puskesmas" name="puskesmas" value="{{ $keluarga->puskesmas }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('puskesmas') border-red-500 @enderror">
                        @error('puskesmas')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Pustu / Posyandu Prima -->
                    <div class="col-span-1">
                        <label for="pustu" class="block text-sm font-medium text-gray-700">Pustu/Posyandu Prima</label>
                        <input type="text" id="pustu" name="pustu" value="{{ $keluarga->pustu }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('pustu') border-red-500 @enderror">
                        @error('pustu')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Provinsi -->
                    <div class="col-span-1">
                        <label for="provinsi" class="block text-sm font-medium text-gray-700">Provinsi</label>
                        <input type="text" id="provinsi" name="provinsi" value="{{ $keluarga->provinsi }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('provinsi') border-red-500 @enderror">
                        @error('provinsi')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <!-- Provinsi -->
                    <div class="col-span-1">
                        <label for="provinsi" class="block text-sm font-medium text-gray-700">Provinsi</label>
                        <input type="text" id="provinsi" name="provinsi" value="{{ old('provinsi', $keluarga->provinsi) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('provinsi') border-red-500 @enderror">
                        @error('provinsi')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- JKN -->
                    <div class="col-span-1">
                        <label for="jkn" class="block text-sm font-medium text-gray-700">Jaminan Kesehatan Nasional (JKN)</label>
                        <select id="jkn" name="jkn" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('jkn') border-red-500 @enderror">
                            <option selected disabled>Pilih Status</option>
                            <option value="Ya" {{ old('jkn', $keluarga->jkn) == 'Ya' ? 'selected' : '' }}>Ya</option>
                            <option value="Tidak" {{ old('jkn', $keluarga->jkn) == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                        </select>
                        @error('jkn')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Sarana Air Bersih -->
                    <div class="col-span-1">
                        <label for="sarana_air_bersih" class="block text-sm font-medium text-gray-700">Sarana Air Bersih</label>
                        <select id="sarana_air_bersih" name="sarana_air_bersih" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('sarana_air_bersih') border-red-500 @enderror">
                            <option selected disabled>Pilih Status</option>
                            <option value="Ya" {{ old('sarana_air_bersih', $keluarga->sarana_air_bersih) == 'Ya' ? 'selected' : '' }}>Ya</option>
                            <option value="Tidak" {{ old('sarana_air_bersih', $keluarga->sarana_air_bersih) == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                        </select>
                        @error('sarana_air_bersih')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Jenis Sumber Air -->
                    <div class="col-span-1">
                        <label for="jenis_sumber_air" class="block text-sm font-medium text-gray-700">Jenis Sumber Air</label>
                        <select id="jenis_sumber_air" name="jenis_sumber_air" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('jenis_sumber_air') border-red-500 @enderror">
                            <option selected disabled>Pilih Jenis</option>
                            <option value="Terlindung" {{ old('jenis_sumber_air', $keluarga->jenis_sumber_air) == 'Terlindung' ? 'selected' : '' }}>Terlindung</option>
                            <option value="Tidak_Terlindung" {{ old('jenis_sumber_air', $keluarga->jenis_sumber_air) == 'Tidak_Terlindung' ? 'selected' : '' }}>Tidak Terlindung</option>
                        </select>
                        @error('jenis_sumber_air')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Jamban Keluarga -->
                    <div class="col-span-1">
                        <label for="jamban_keluarga" class="block text-sm font-medium text-gray-700">Apakah tersedia jamban keluarga?</label>
                        <select id="jamban_keluarga" name="jamban_keluarga" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('jamban_keluarga') border-red-500 @enderror">
                            <option selected disabled>Pilih Status</option>
                            <option value="Ya" {{ old('jamban_keluarga', $keluarga->jamban_keluarga) == 'Ya' ? 'selected' : '' }}>Ya</option>
                            <option value="Tidak" {{ old('jamban_keluarga', $keluarga->jamban_keluarga) == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                        </select>
                        @error('jamban_keluarga')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Jenis Jamban -->
                    <div class="col-span-1">
                        <label for="jenis_jamban" class="block text-sm font-medium text-gray-700">Apakah jenis jambannya saniter?</label>
                        <select id="jenis_jamban" name="jenis_jamban" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('jenis_jamban') border-red-500 @enderror">
                            <option selected disabled>Pilih Jenis</option>
                            <option value="Saniter" {{ old('jenis_jamban', $keluarga->jenis_jamban) == 'Saniter' ? 'selected' : '' }}>Saniter</option>
                            <option value="Tidak_Saniter" {{ old('jenis_jamban', $keluarga->jenis_jamban) == 'Tidak_Saniter' ? 'selected' : '' }}>Tidak Saniter</option>
                        </select>
                        @error('jenis_jamban')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Ventilasi -->
                    <div class="col-span-1">
                        <label for="ventilasi" class="block text-sm font-medium text-gray-700">Apakah rumah memiliki ventilasi yang cukup?</label>
                        <select id="ventilasi" name="ventilasi" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('ventilasi') border-red-500 @enderror">
                            <option selected disabled>Pilih Status</option>
                            <option value="Ya" {{ old('ventilasi', $keluarga->ventilasi) == 'Ya' ? 'selected' : '' }}>Ya</option>
                            <option value="Tidak" {{ old('ventilasi', $keluarga->ventilasi) == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                        </select>
                        @error('ventilasi')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Gangguan Jiwa -->
                    <div class="col-span-1">
                        <label for="gangguan_jiwa" class="block text-sm font-medium text-gray-700">Apakah ada anggota keluarga yang mengalami gangguan jiwa?</label>
                        <select id="gangguan_jiwa" name="gangguan_jiwa" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('gangguan_jiwa') border-red-500 @enderror">
                            <option selected disabled>Pilih Status</option>
                            <option value="Ya" {{ old('gangguan_jiwa', $keluarga->gangguan_jiwa) == 'Ya' ? 'selected' : '' }}>Ya</option>
                            <option value="Tidak" {{ old('gangguan_jiwa', $keluarga->gangguan_jiwa) == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                        </select>
                        @error('gangguan_jiwa')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Terdiagnosis Penyakit -->
                    <div class="col-span-1">
                        <label for="terdiagnosis_penyakit" class="block text-sm font-medium text-gray-700">Apakah ada anggota keluarga yang terdiagnosis penyakit berikut (TBC, Hipertensi, Diabetes Melitus)?</label>
                        <select id="terdiagnosis_penyakit" name="terdiagnosis_penyakit" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('terdiagnosis_penyakit') border-red-500 @enderror">
                            <option selected disabled>Pilih Status</option>
                            <option value="Ya" {{ old('terdiagnosis_penyakit', $keluarga->terdiagnosis_penyakit) == 'Ya' ? 'selected' : '' }}>Ya</option>
                            <option value="Tidak" {{ old('terdiagnosis_penyakit', $keluarga->terdiagnosis_penyakit) == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                        </select>
                        @error('terdiagnosis_penyakit')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

                <input type="hidden" name="id_user" value="{{ auth()->user()->id }}"> <!-- Menyimpan ID user yang login -->

                <!-- Section for Anggota Keluarga -->
                <div class="bg-gray-100 rounded-lg p-4 mt-6">
                    <h3 class="text-md font-semibold text-gray-700">Data Anggota Keluarga</h3>
                    <div id="anggotaKeluargaContainer" class="mt-4 space-y-4">
                        
                        <!-- Dynamic anggota keluarga form fields will be inserted here -->
                        @foreach($keluarga->anggotaKeluarga as $index => $anggota)
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 p-4 bg-white rounded-md shadow-md">
                                <div class="col-span-2 flex justify-between items-center">
                                    <h5 class="font-semibold">Anggota Keluarga {{ $index + 1 }}</h5>
                                    <button type="button" class="text-red-600 hover:text-red-800" onclick="removeAnggota({{ $index }})">Hapus Anggota</button>
                                </div>

                              <!-- Nama Lengkap -->
                            <div class="col-span-1">
                                <label for="nama_lengkap_{{ $index }}" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                                <input type="text" id="nama_lengkap_{{ $index }}" name="anggota[{{ $index }}][nama_lengkap]" value="{{ old('anggota.' . $index . '.nama_lengkap', $anggota->nama_lengkap) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                                @error('anggota.' . $index . '.nama_lengkap')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- NIK -->
                            <div class="col-span-1">
                                <label for="nik_{{ $index }}" class="block text-sm font-medium text-gray-700">NIK</label>
                                <input type="text" id="nik_{{ $index }}" name="anggota[{{ $index }}][nik]" value="{{ $anggota->nik }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                                <!-- Pesan Error NIK -->
                                @error('anggota.' . $index . '.nik')
                                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                                    @enderror
                            </div>

                            <!-- Tanggal Lahir -->
                            <div class="col-span-1">
                                <label for="tanggal_lahir_{{ $index }}" class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                                <input type="date" id="tanggal_lahir_{{ $index }}" name="anggota[{{ $index }}][tanggal_lahir]" value="{{ $anggota->tanggal_lahir }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                            </div>

                            <!-- Jenis Kelamin -->
                            <div class="col-span-1">
                                <label for="jenis_kelamin_{{ $index }}" class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                                <select id="jenis_kelamin_{{ $index }}" name="anggota[{{ $index }}][jenis_kelamin]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                                    <option value="Laki-Laki" {{ $anggota->jenis_kelamin === 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki</option>
                                    <option value="Perempuan" {{ $anggota->jenis_kelamin === 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                            </div>

                            <!-- Hubungan KK -->
                            <div class="col-span-1">
                                <label for="hubungan_kk_{{ $index }}" class="block text-sm font-medium text-gray-700">Hubungan KK</label>
                                <select id="hubungan_kk_{{ $index }}" name="anggota[{{ $index }}][hubungan_kk]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                                    <option value="1" {{ $anggota->hubungan_kk == 1 ? 'selected' : '' }}>Kepala Keluarga</option>
                                    <option value="2" {{ $anggota->hubungan_kk == 2 ? 'selected' : '' }}>Suami</option>
                                    <option value="3" {{ $anggota->hubungan_kk == 3 ? 'selected' : '' }}>Istri</option>
                                    <option value="4" {{ $anggota->hubungan_kk == 4 ? 'selected' : '' }}>Anak</option>
                                    <option value="5" {{ $anggota->hubungan_kk == 5 ? 'selected' : '' }}>Menantu</option>
                                    <option value="6" {{ $anggota->hubungan_kk == 6 ? 'selected' : '' }}>Cucu</option>
                                    <option value="7" {{ $anggota->hubungan_kk == 7 ? 'selected' : '' }}>Orang Tua</option>
                                    <option value="8" {{ $anggota->hubungan_kk == 8 ? 'selected' : '' }}>Mertua</option>
                                    <option value="9" {{ $anggota->hubungan_kk == 9 ? 'selected' : '' }}>Anggota Lain</option>
                                </select>
                            </div>

                            <!-- Status Perkawinan -->
                            <div class="col-span-1">
                                <label for="status_perkawinan_{{ $index }}" class="block text-sm font-medium text-gray-700">Status Perkawinan</label>
                                <select id="status_perkawinan_{{ $index }}" name="anggota[{{ $index }}][status_perkawinan]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                                    <option value="1" {{ $anggota->status_perkawinan == 1 ? 'selected' : '' }}>Belum Menikah</option>
                                    <option value="2" {{ $anggota->status_perkawinan == 2 ? 'selected' : '' }}>Menikah</option>
                                    <option value="3" {{ $anggota->status_perkawinan == 3 ? 'selected' : '' }}>Cerai Hidup</option>
                                    <option value="4" {{ $anggota->status_perkawinan == 4 ? 'selected' : '' }}>Cerai Mati</option>
                                </select>
                            </div>

                            <!-- Pendidikan Terakhir -->
                            <div class="col-span-1">
                                <label for="pendidikan_terakhir_{{ $index }}" class="block text-sm font-medium text-gray-700">Pendidikan Terakhir</label>
                                <select id="pendidikan_terakhir_{{ $index }}" name="anggota[{{ $index }}][pendidikan_terakhir]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                                    <option value="1" {{ $anggota->pendidikan_terakhir == 1 ? 'selected' : '' }}>Tidak Sekolah</option>
                                    <option value="2" {{ $anggota->pendidikan_terakhir == 2 ? 'selected' : '' }}>SD</option>
                                    <option value="3" {{ $anggota->pendidikan_terakhir == 3 ? 'selected' : '' }}>SMP</option>
                                    <option value="4" {{ $anggota->pendidikan_terakhir == 4 ? 'selected' : '' }}>SMA</option>
                                    <option value="5" {{ $anggota->pendidikan_terakhir == 5 ? 'selected' : '' }}>Diploma</option>
                                    <option value="6" {{ $anggota->pendidikan_terakhir == 6 ? 'selected' : '' }}>Sarjana</option>
                                </select>
                            </div>

                            <!-- Pekerjaan -->
                            <div class="col-span-1">
                                <label for="pekerjaan_{{ $index }}" class="block text-sm font-medium text-gray-700">Pekerjaan</label>
                                <select id="pekerjaan_{{ $index }}" name="anggota[{{ $index }}][pekerjaan]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                                    <option value="1" {{ $anggota->pekerjaan == 1 ? 'selected' : '' }}>Tidak Bekerja</option>
                                    <option value="2" {{ $anggota->pekerjaan == 2 ? 'selected' : '' }}>Petani</option>
                                    <option value="3" {{ $anggota->pekerjaan == 3 ? 'selected' : '' }}>PNS</option>
                                    <option value="4" {{ $anggota->pekerjaan == 4 ? 'selected' : '' }}>Buruh</option>
                                    <option value="5" {{ $anggota->pekerjaan == 5 ? 'selected' : '' }}>Wiraswasta</option>
                                    <option value="6" {{ $anggota->pekerjaan == 6 ? 'selected' : '' }}>Pelajar</option>
                                    <option value="7" {{ $anggota->pekerjaan == 7 ? 'selected' : '' }}>Lainnya</option>
                                </select>
                            </div>

                            <!-- Kelompok Sasaran -->
                            <div class="col-span-1">
                                <label for="kelompok_sasaran_{{ $index }}" class="block text-sm font-medium text-gray-700">Kelompok Sasaran</label>
                                <select id="kelompok_sasaran_{{ $index }}" name="anggota[{{ $index }}][kelompok_sasaran]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                                    <option value="Ibu Hamil" {{ $anggota->kelompok_sasaran == 'Ibu Hamil' ? 'selected' : '' }}>Ibu Hamil</option>
                                    <option value="Ibu Bersalin & Nifas" {{ $anggota->kelompok_sasaran == 'Ibu Bersalin & Nifas' ? 'selected' : '' }}>Ibu Bersalin & Nifas</option>
                                    <option value="Bayi - Balita (0-6 tahun)" {{ $anggota->kelompok_sasaran == 'Bayi - Balita (0-6 tahun)' ? 'selected' : '' }}>Bayi - Balita (0-6 tahun)</option>
                                    <option value="Usia Sekolah & Remaja (≥6 - <18 tahun)" {{ $anggota->kelompok_sasaran == 'Usia Sekolah & Remaja (≥6 - <18 tahun)' ? 'selected' : '' }}>Usia Sekolah & Remaja (≥6 - <18 tahun)</option>
                                    <option value="Usia Dewasa (≥18-59 tahun)" {{ $anggota->kelompok_sasaran == 'Usia Dewasa (≥18-59 tahun)' ? 'selected' : '' }}>Usia Dewasa (≥18-59 tahun)</option>
                                    <option value="Lansia (≥60 tahun)" {{ $anggota->kelompok_sasaran == 'Lansia (≥60 tahun)' ? 'selected' : '' }}>Lansia (≥60 tahun)</option>
                                </select>
                            </div>
                            </div>
                        @endforeach
                    </div>

                    <button type="button" id="addAnggotaButton" class="mt-3 inline-flex items-center px-4 py-2 border border-blue-600 rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Tambah Anggota
                    </button>
                </div>

                <div class="flex justify-end mt-6">
                    <button type="submit" class="ml-2 bg-gray-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded shadow">
                        Simpan Perubahan
                    </button>

                    <a href="{{ route('keluarga') }}" class="ml-2 bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded shadow inline-block text-center">
                        Kembali
                    </a>

                </div>
            </form>
        </div>
    </div>

    <!-- Import jQuery for dynamic fields -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        let anggotaCount = {{ count($keluarga->anggotaKeluarga) }};

        // Function to add new anggota keluarga form
        $('#addAnggotaButton').click(function() {
            anggotaCount++;
            let anggotaForm = `
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 p-4 bg-white rounded-md shadow-md" id="anggota_${anggotaCount}">
                    <div class="col-span-2 flex justify-between items-center">
                        <h5 class="font-semibold">Anggota Keluarga ${anggotaCount}</h5>
                        <button type="button" class="text-red-600 hover:text-red-800" onclick="removeAnggota(${anggotaCount})">Hapus Anggota</button>
                    </div>
                    
                    <div class="col-span-1">
                        <label for="nama_lengkap_${anggotaCount}" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                        <input type="text" id="nama_lengkap_${anggotaCount}" name="anggota[${anggotaCount}][nama_lengkap]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                    </div>

                    <div class="col-span-1">
                        <label for="nik_${anggotaCount}" class="block text-sm font-medium text-gray-700">NIK</label>
                        <input type="text" id="nik_${anggotaCount}" name="anggota[${anggotaCount}][nik]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                        
                    </div>

                    <div class="col-span-1">
                        <label for="tanggal_lahir_${anggotaCount}" class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                        <input type="date" id="tanggal_lahir_${anggotaCount}" name="anggota[${anggotaCount}][tanggal_lahir]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                    </div>

                    <div class="col-span-1">
                        <label for="jenis_kelamin_${anggotaCount}" class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                        <select id="jenis_kelamin_${anggotaCount}" name="anggota[${anggotaCount}][jenis_kelamin]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                            <option value="Laki-Laki">Laki-Laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>

                    <div class="col-span-1">
                        <label for="hubungan_kk_${anggotaCount}" class="block text-sm font-medium text-gray-700">Hubungan KK</label>
                        <select id="hubungan_kk_${anggotaCount}" name="anggota[${anggotaCount}][hubungan_kk]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                            <option value="1">Kepala Keluarga</option>
                            <option value="2">Suami</option>
                            <option value="3">Istri</option>
                            <option value="4">Anak</option>
                            <option value="5">Menantu</option>
                            <option value="6">Cucu</option>
                            <option value="7">Orang Tua</option>
                            <option value="8">Mertua</option>
                            <option value="9">Anggota Lain</option>
                        </select>
                    </div>

                    <div class="col-span-1">
                        <label for="status_perkawinan_${anggotaCount}" class="block text-sm font-medium text-gray-700">Status Perkawinan</label>
                        <select id="status_perkawinan_${anggotaCount}" name="anggota[${anggotaCount}][status_perkawinan]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                            <option value="1">Belum Menikah</option>
                            <option value="2">Menikah</option>
                            <option value="3">Cerai Hidup</option>
                            <option value="4">Cerai Mati</option>
                        </select>
                    </div>

                    <div class="col-span-1">
                        <label for="pendidikan_terakhir_${anggotaCount}" class="block text-sm font-medium text-gray-700">Pendidikan Terakhir</label>
                        <select id="pendidikan_terakhir_${anggotaCount}" name="anggota[${anggotaCount}][pendidikan_terakhir]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                            <option value="1">Tidak Sekolah</option>
                            <option value="2">SD</option>
                            <option value="3">SMP</option>
                            <option value="4">SMA</option>
                            <option value="5">Diploma</option>
                            <option value="6">Sarjana</option>
                        </select>
                    </div>

                    <div class="col-span-1">
                        <label for="pekerjaan_${anggotaCount}" class="block text-sm font-medium text-gray-700">Pekerjaan</label>
                        <select id="pekerjaan_${anggotaCount}" name="anggota[${anggotaCount}][pekerjaan]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                            <option value="1">Tidak Bekerja</option>
                            <option value="2">Petani</option>
                            <option value="3">PNS</option>
                            <option value="4">Buruh</option>
                            <option value="5">Wiraswasta</option>
                            <option value="6">Pelajar</option>
                            <option value="7">Lainnya</option>
                        </select>
                    </div>

                    <div class="col-span-1">
                        <label for="kelompok_sasaran_${anggotaCount}" class="block text-sm font-medium text-gray-700">Kelompok Sasaran</label>
                        <select id="kelompok_sasaran_${anggotaCount}" name="anggota[${anggotaCount}][kelompok_sasaran]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                            <option value="Ibu Hamil">Ibu Hamil</option>
                            <option value="Ibu Bersalin & Nifas">Ibu Bersalin & Nifas</option>
                            <option value="Bayi - Balita (0-6 tahun)">Bayi - Balita (0-6 tahun)</option>
                            <option value="Usia Sekolah & Remaja (≥6 - <18 tahun)">Usia Sekolah & Remaja (≥6 - <18 tahun)</option>
                            <option value="Usia Dewasa (≥18-59 tahun)">Usia Dewasa (≥18-59 tahun)</option>
                            <option value="Lansia (≥60 tahun)">Lansia (≥60 tahun)</option>
                        </select>
                    </div>
                </div>`; 
            
            $('#anggotaKeluargaContainer').append(anggotaForm);
        });

        // Function to remove anggota keluarga form
        window.removeAnggota = function(anggotaId) {
            $('#anggota_' + anggotaId).remove();
        };
    });
</script>
<script>
    const kelurahanOptions = {
        'Banjarsari': [
            'Banjarsari', 'Banyuanyar', 'Gilingan', 'Joglo', 'Kadipiro',
            'Keprabon', 'Kestalan', 'Ketelan', 'Manahan', 'Mangkubumen',
            'Nusukan', 'Punggawan', 'Setabelan', 'Sumber Timuran'
        ],
        'Jebres': [
            'Gandekan', 'Jagalan', 'Jebres', 'Kepatihan Kulon', 'Kepatihan Wetan',
            'Mojosongo', 'Pucang Sawit', 'Purwodiningratan', 'Sewu',
            'Sudiroprajan', 'Tegalharjo'
        ],
        'Laweyan': [
            'Bumi', 'Jajar', 'Karangasem', 'Kerten', 'Laweyan', 'Pajang',
            'Panularan', 'Penumping', 'Purwosari', 'Sondakan', 'Sriwedari'
        ],
        'Pasar Kliwon': [
            'Baluwarti', 'Gajahan', 'Joyosuran', 'Kampung Baru', 'Kauman',
            'Kedung Lumbu', 'Mojo', 'Pasar Kliwon', 'Sangkrah', 'Semanggi'
        ],
        'Serengan': [
            'Danukusuman', 'Jayengan', 'Joyotakan', 'Kemlayan', 'Kratonan',
            'Serengan', 'Tipes'
        ]
    };

    $(document).ready(function() {
        // Trigger population of Kelurahan based on selected Kecamatan
        $('#kecamatan').on('change', function() {
            var kecamatan = $(this).val();
            var kelurahanDropdown = $('#kelurahan');
            kelurahanDropdown.empty().append('<option selected disabled>Pilih Kelurahan</option>');

            if (kecamatan && kelurahanOptions[kecamatan]) {
                kelurahanOptions[kecamatan].forEach(function(kelurahan) {
                    kelurahanDropdown.append('<option value="' + kelurahan + '">' + kelurahan + '</option>');
                });
            }
        });

        // Set the initial selected value of Kelurahan if available
        var initialKelurahan = '{{ $keluarga->kelurahan }}'; // Assuming `kelurahan` is a property
        if (initialKelurahan) {
            $('#kecamatan').val('{{ $keluarga->kecamatan }}').trigger('change'); // Trigger change to load Kelurahan options
            $('#kelurahan').val(initialKelurahan); // Set the selected Kelurahan
        }
    });
</script>

<!-- Tambahkan Script SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Cek jika ada pesan sukses di session
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
            });
        @endif

        // Cek jika ada pesan error di session
        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: '{{ session('error') }}',
            });
        @endif
    });
</script>

</x-app-layout>
