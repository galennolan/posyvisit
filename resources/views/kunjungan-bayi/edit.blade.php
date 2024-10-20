<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Edit Kunjungan Bayi') }}
        </h2>
        <nav class="breadcrumb">
            <ol class="list-reset flex text-sm">
                <li><a href="/dashboard" class="text-blue-600 hover:text-blue-800">Home</a></li>
                <li><span class="mx-2">/</span></li>
                <li class="text-blue-600 font-semibold"><a href="{{ route('kunjungan-bayi.index') }}" class="text-blue-600 hover:text-blue-800">Kunjungan Bayi</a></li>
                <li><span class="mx-2">/</span></li>
                <li class="text-gray-600">Edit Kunjungan Bayi</li>
            </ol>
        </nav>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-lg rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-700 mb-4">Form Edit Kunjungan Bayi</h3>

                <!-- Pesan validasi error -->
                @if ($errors->any())
                    <div class="mb-4">
                        <ul class="list-disc list-inside text-red-600">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Form untuk mengedit kunjungan bayi -->
                <form method="POST" action="{{ route('kunjungan-bayi.update', $kunjunganBayi->id) }}">
                    @csrf
                    @method('PUT')

                    <!-- Nama Ibu -->
                    <div class="mb-4">
                        <label for="nama_anak" class="block text-sm font-medium text-gray-700">Nama Anak</label>
                        <input type="hidden" name="anggota_keluarga_id" value="{{ $anggotaKeluarga->id }}">
                        @if(isset($anggotaKeluarga))
                            <input type="hidden" name="nama_anak" value="{{ $anggotaKeluarga->nama_lengkap }}">
                            <p class="mt-1 text-sm text-gray-800 bg-gray-100 p-2 rounded">{{ $anggotaKeluarga->nama_lengkap }}</p>
                        @else
                            <p class="mt-1 text-sm text-gray-800 bg-gray-100 p-2 rounded">-</p>
                        @endif
                    </div>

                    <!-- Umur Ibu -->
                    <div class="mb-4">
                        <label for="umur_ibu" class="block text-sm font-medium text-gray-700">Umur Anak</label>
                        @if(isset($anggotaKeluarga) && $anggotaKeluarga->tanggal_lahir)
                            @php
                                $tanggalLahir = \Carbon\Carbon::parse($anggotaKeluarga->tanggal_lahir);
                                $umur = $tanggalLahir->age;
                            @endphp
                            <input type="hidden" name="umur_anak" value="{{ $umur }}">
                            <input type="number" id="umur" name="umur" value="{{ $umur }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 bg-gray-100" readonly>
                        @else
                            <input type="number" id="umur" name="umur" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                        @endif
                    </div>

                    <!-- Tempat dan Tanggal Lahir -->
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="tempat_lahir" class="block text-sm font-medium text-gray-700">Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" id="tempat_lahir" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-blue-500 focus:border-blue-500 sm:text-sm" value="{{ old('tempat_lahir', $kunjunganBayi->tempat_lahir) }}">
                        </div>
                        <div>
                            <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-blue-500 focus:border-blue-500 sm:text-sm" value="{{ old('tanggal_lahir', $anggotaKeluarga->tanggal_lahir) }}">
                        </div>
                    </div>

                    <!-- Jenis Kelamin -->
                    <div class="mb-4">
                        <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                        <select name="jenis_kelamin" id="jenis_kelamin" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            <option value="Laki-laki" {{ old('jenis_kelamin', $anggotaKeluarga->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Perempuan" {{ old('jenis_kelamin', $anggotaKeluarga->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>

                    <!-- Waktu Kunjungan -->
                    <div class="mb-4">
                        <label for="waktu_kunjungan" class="block text-sm font-medium text-gray-700">Waktu Kunjungan</label>
                        <input type="date" name="waktu_kunjungan" id="waktu_kunjungan" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-blue-500 focus:border-blue-500 sm:text-sm" value="{{ old('waktu_kunjungan', $kunjunganBayi->tanggal_kunjungan) }}">
                    </div>

                    <!-- Pemantauan Suhu Tubuh -->
                    <div class="mb-4">
                        <label for="pemantauan_suhu_tubuh" class="block text-sm font-medium text-gray-700">Pemantauan Suhu Tubuh</label>
                        <select name="pemantauan_suhu_tubuh" id="pemantauan_suhu_tubuh" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            <option value="<37.5 C" {{ old('pemantauan_suhu_tubuh', $kunjunganBayi->pemantauan_suhu_tubuh) == '<37.5 C' ? 'selected' : '' }}> <37.5 C</option>
                            <option value=">=36.5 C" {{ old('pemantauan_suhu_tubuh', $kunjunganBayi->pemantauan_suhu_tubuh) == '>=36.5 C' ? 'selected' : '' }}>>=36.5 C</option>
                        </select>
                    </div>

                    <!-- Ada Buku KIA -->
                    <div class="mb-4">
                        <label for="ada_buku_kia" class="block text-sm font-medium text-gray-700">Ada Buku KIA</label>
                        <select name="ada_buku_kia" id="ada_buku_kia" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            <option value="Ada" {{ old('ada_buku_kia', $kunjunganBayi->ada_buku_kia) == 'Ada' ? 'selected' : '' }}>Ada</option>
                            <option value="Tidak" {{ old('ada_buku_kia', $kunjunganBayi->ada_buku_kia) == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                        </select>
                    </div>

                    <!-- ASI Eksklusif -->
                    <div class="mb-4">
                        <label for="asi_eksklusif" class="block text-sm font-medium text-gray-700">ASI Eksklusif</label>
                        <select name="asi_eksklusif" id="asi_eksklusif" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            <option value="Ada" {{ old('asi_eksklusif', $kunjunganBayi->asi_eksklusif) == 'Ada' ? 'selected' : '' }}>Ada</option>
                            <option value="Tidak" {{ old('asi_eksklusif', $kunjunganBayi->asi_eksklusif) == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                        </select>
                    </div>

                     <!-- 6. Tanggal Terakhir Ditimbang dan Diukur -->
                     <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="tanggal_terakhir_ditimbang" class="block text-sm font-medium text-gray-700">6. Tanggal Terakhir Ditimbang</label>
                            <input type="date" name="tanggal_terakhir_ditimbang" id="tanggal_terakhir_ditimbang" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-blue-500 focus:border-blue-500 sm:text-sm" value="{{ old('tanggal_terakhir_ditimbang', $kunjunganBayi->tanggal_terakhir_ditimbang) }}">
                        </div>
                        <div>
                            <label for="tempat_penimbangan" class="block text-sm font-medium text-gray-700">Tempat Penimbangan</label>
                            <input type="text" name="tempat_penimbangan" id="tempat_penimbangan" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-blue-500 focus:border-blue-500 sm:text-sm" value="{{ old('tempat_penimbangan', $kunjunganBayi->tempat_penimbangan) }}">
                        </div>
                    </div>

                    <!-- 7. Hasil Penimbangan dan Pengukuran -->
                    <div class="grid grid-cols-3 gap-4 mb-4">
                        <div>
                            <label for="berat_badan" class="block text-sm font-medium text-gray-700">Berat Badan (Kg)</label>
                            <input type="number" step="0.01" name="berat_badan" id="berat_badan" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-blue-500 focus:border-blue-500 sm:text-sm" value="{{ old('berat_badan', $kunjunganBayi->berat_badan) }}">
                        </div>
                        <div>
                            <label for="panjang_badan" class="block text-sm font-medium text-gray-700">Panjang Badan (cm)</label>
                            <input type="number" step="0.01" name="panjang_badan" id="panjang_badan" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-blue-500 focus:border-blue-500 sm:text-sm" value="{{ old('panjang_badan', $kunjunganBayi->panjang_badan) }}">
                        </div>
                        <div>
                            <label for="lingkar_kepala" class="block text-sm font-medium text-gray-700">Lingkar Kepala (cm)</label>
                            <input type="number" step="0.01" name="lingkar_kepala" id="lingkar_kepala" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-blue-500 focus:border-blue-500 sm:text-sm" value="{{ old('lingkar_kepala', $kunjunganBayi->lingkar_kepala) }}">
                        </div>
                    </div>

                    <!-- 8. Pelayanan Neonatal Esensial Setelah Lahir (0-6 jam) -->
                    <h4 class="font-semibold text-gray-600 mb-2">Pemeriksaan Setelah Bayi Lahir (0-28 hari)</h4>
                    <div class="grid grid-cols-3 gap-4 mb-4">
                        <div>
                            <label for="pelayanan_neonatal_essensial_0_6_jam" class="block text-sm font-medium text-gray-700">8. Pelayanan Neonatal Esensial (0-6 jam)</label>
                            <input type="date" name="pelayanan_neonatal_essensial_0_6_jam" id="pelayanan_neonatal_essensial_0_6_jam" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-blue-500 focus:border-blue-500 sm:text-sm" value="{{ old('pelayanan_neonatal_essensial_0_6_jam', $kunjunganBayi->pelayanan_neonatal_essensial_0_6_jam) }}">
                        </div>
                        <div>
                            <label for="tempat_pelayanan_neonatal_0_6_jam" class="block text-sm font-medium text-gray-700">Tempat Pelayanan</label>
                            <input type="text" name="tempat_pelayanan_neonatal_0_6_jam" id="tempat_pelayanan_neonatal_0_6_jam" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-blue-500 focus:border-blue-500 sm:text-sm" value="{{ old('tempat_pelayanan_neonatal_0_6_jam', $kunjunganBayi->tempat_pelayanan_neonatal_0_6_jam) }}">
                        </div>
                        <div>
                            <label for="petugas_pelayanan_neonatal_0_6_jam" class="block text-sm font-medium text-gray-700">Petugas Pelayanan</label>
                            <input type="text" name="petugas_pelayanan_neonatal_0_6_jam" id="petugas_pelayanan_neonatal_0_6_jam" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-blue-500 focus:border-blue-500 sm:text-sm" value="{{ old('petugas_pelayanan_neonatal_0_6_jam', $kunjunganBayi->petugas_pelayanan_neonatal_0_6_jam) }}">
                        </div>
                    </div>

                    <!-- 9. KN 1 (6-48 jam) -->
                    <div class="grid grid-cols-3 gap-4 mb-4">
                        <div>
                            <label for="kn1_6_48_jam" class="block text-sm font-medium text-gray-700">9. KN 1 (6-48 jam)</label>
                            <input type="date" name="kn1_6_48_jam" id="kn1_6_48_jam" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-blue-500 focus:border-blue-500 sm:text-sm" value="{{ old('kn1_6_48_jam', $kunjunganBayi->kn1_6_48_jam) }}">
                        </div>
                        <div>
                            <label for="tempat_kn1" class="block text-sm font-medium text-gray-700">Tempat KN 1</label>
                            <input type="text" name="tempat_kn1" id="tempat_kn1" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-blue-500 focus:border-blue-500 sm:text-sm" value="{{ old('tempat_kn1', $kunjunganBayi->tempat_kn1) }}">
                        </div>
                        <div>
                            <label for="petugas_kn1" class="block text-sm font-medium text-gray-700">Petugas KN 1</label>
                            <input type="text" name="petugas_kn1" id="petugas_kn1" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-blue-500 focus:border-blue-500 sm:text-sm" value="{{ old('petugas_kn1', $kunjunganBayi->petugas_kn1) }}">
                        </div>
                    </div>

                    <!-- 10. KN 2 (3-7 hari) -->
                    <div class="grid grid-cols-3 gap-4 mb-4">
                        <div>
                            <label for="kn2_3_7_hari" class="block text-sm font-medium text-gray-700">10. KN 2 (3-7 hari)</label>
                            <input type="date" name="kn2_3_7_hari" id="kn2_3_7_hari" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-blue-500 focus:border-blue-500 sm:text-sm" value="{{ old('kn2_3_7_hari', $kunjunganBayi->kn2_3_7_hari) }}">
                        </div>
                        <div>
                            <label for="tempat_kn2" class="block text-sm font-medium text-gray-700">Tempat KN 2</label>
                            <input type="text" name="tempat_kn2" id="tempat_kn2" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-blue-500 focus:border-blue-500 sm:text-sm" value="{{ old('tempat_kn2', $kunjunganBayi->tempat_kn2) }}">
                        </div>
                        <div>
                            <label for="petugas_kn2" class="block text-sm font-medium text-gray-700">Petugas KN 2</label>
                            <input type="text" name="petugas_kn2" id="petugas_kn2" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-blue-500 focus:border-blue-500 sm:text-sm" value="{{ old('petugas_kn2', $kunjunganBayi->petugas_kn2) }}">
                        </div>
                    </div>

                    <!-- 11. KN 3 (8-28 hari) -->
                    <div class="grid grid-cols-3 gap-4 mb-4">
                        <div>
                            <label for="kn3_8_28_hari" class="block text-sm font-medium text-gray-700">11. KN 3 (8-28 hari)</label>
                            <input type="date" name="kn3_8_28_hari" id="kn3_8_28_hari" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-blue-500 focus:border-blue-500 sm:text-sm" value="{{ old('kn3_8_28_hari', $kunjunganBayi->kn3_8_28_hari) }}">
                        </div>
                        <div>
                            <label for="tempat_kn3" class="block text-sm font-medium text-gray-700">Tempat KN 3</label>
                            <input type="text" name="tempat_kn3" id="tempat_kn3" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-blue-500 focus:border-blue-500 sm:text-sm" value="{{ old('tempat_kn3', $kunjunganBayi->tempat_kn3) }}">
                        </div>
                        <div>
                            <label for="petugas_kn3" class="block text-sm font-medium text-gray-700">Petugas KN 3</label>
                            <input type="text" name="petugas_kn3" id="petugas_kn3" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-blue-500 focus:border-blue-500 sm:text-sm" value="{{ old('petugas_kn3', $kunjunganBayi->petugas_kn3) }}">
                        </div>
                    </div>

                    <!-- 12. Status Imunisasi Bayi -->
                    <h4 class="font-semibold text-gray-600 mb-2">Status Imunisasi Bayi (0-6 bulan)</h4>

                    <!-- Usia 0 Bulan -->
                    <div class="grid grid-cols-3 gap-4 mb-4">
                        <div>
                            <label for="hepatitis_b_0_bulan" class="block text-sm font-medium text-gray-700">12. Hepatitis B (<24 jam)</label>
                            <select name="hepatitis_b_0_bulan" id="hepatitis_b_0_bulan" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                <option value="Ya" {{ old('hepatitis_b_0_bulan', $kunjunganBayi->hepatitis_b_0_bulan) == 'Ya' ? 'selected' : '' }}>Ya</option>
                                <option value="Tidak" {{ old('hepatitis_b_0_bulan', $kunjunganBayi->hepatitis_b_0_bulan) == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                            </select>
                        </div>
                        <div>
                            <label for="bcg_0_bulan" class="block text-sm font-medium text-gray-700">BCG</label>
                            <select name="bcg_0_bulan" id="bcg_0_bulan" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                <option value="Ya" {{ old('bcg_0_bulan', $kunjunganBayi->bcg_0_bulan) == 'Ya' ? 'selected' : '' }}>Ya</option>
                                <option value="Tidak" {{ old('bcg_0_bulan', $kunjunganBayi->bcg_0_bulan) == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                            </select>
                        </div>
                        <div>
                            <label for="polio_tetes_1_0_bulan" class="block text-sm font-medium text-gray-700">Polio Tetes 1</label>
                            <select name="polio_tetes_1_0_bulan" id="polio_tetes_1_0_bulan" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                <option value="Ya" {{ old('polio_tetes_1_0_bulan', $kunjunganBayi->polio_tetes_1_0_bulan) == 'Ya' ? 'selected' : '' }}>Ya</option>
                                <option value="Tidak" {{ old('polio_tetes_1_0_bulan', $kunjunganBayi->polio_tetes_1_0_bulan) == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                            </select>
                        </div>
                    </div>

                    <!-- 18. Waktu Kunjungan dan 19. Tanggal Kunjungan (Satu Baris) -->
                    <div class="grid grid-cols-2 gap-4 mb-4">
                      
                        <div>
                            <label for="tanggal_kunjungan" class="block text-sm font-medium text-gray-700">19. Tanggal Kunjungan</label>
                            <input type="date" name="tanggal_kunjungan" id="tanggal_kunjungan" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-blue-500 focus:border-blue-500 sm:text-sm" value="{{ old('tanggal_kunjungan', $kunjunganBayi->tanggal_kunjungan) }}">
                        </div>
                    </div>

                    <!-- 20. Napas, 21. Aktivitas, 22. Warna Kulit (Satu Baris) -->
                    <div class="grid grid-cols-3 gap-4 mb-4">
                        <div>
                            <label for="napas" class="block text-sm font-medium text-gray-700">20. Napas</label>
                            <select name="napas" id="napas" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                <option value="Ya" {{ old('napas', $kunjunganBayi->napas) == 'Ya' ? 'selected' : '' }}>Ya</option>
                                <option value="Tidak" {{ old('napas', $kunjunganBayi->napas) == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                            </select>
                        </div>
                        <div>
                            <label for="aktifitas" class="block text-sm font-medium text-gray-700">21. Aktivitas</label>
                            <select name="aktifitas" id="aktifitas" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                <option value="Ya" {{ old('aktifitas', $kunjunganBayi->aktifitas) == 'Ya' ? 'selected' : '' }}>Ya</option>
                                <option value="Tidak" {{ old('aktifitas', $kunjunganBayi->aktifitas) == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                            </select>
                        </div>
                        <div>
                            <label for="warna_kulit" class="block text-sm font-medium text-gray-700">22. Warna Kulit</label>
                            <select name="warna_kulit" id="warna_kulit" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                <option value="Ya" {{ old('warna_kulit', $kunjunganBayi->warna_kulit) == 'Ya' ? 'selected' : '' }}>Ya</option>
                                <option value="Tidak" {{ old('warna_kulit', $kunjunganBayi->warna_kulit) == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                            </select>
                        </div>
                    </div>

                    <!-- 23. Hisapan Bayi, 24. Kejang, 25. Suhu Tubuh (Satu Baris) -->
                    <div class="grid grid-cols-3 gap-4 mb-4">
                        <div>
                            <label for="hisapan_bayi" class="block text-sm font-medium text-gray-700">23. Hisapan Bayi</label>
                            <select name="hisapan_bayi" id="hisapan_bayi" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                <option value="Ya" {{ old('hisapan_bayi', $kunjunganBayi->hisapan_bayi) == 'Ya' ? 'selected' : '' }}>Ya</option>
                                <option value="Tidak" {{ old('hisapan_bayi', $kunjunganBayi->hisapan_bayi) == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                            </select>
                        </div>
                        <div>
                            <label for="kejang" class="block text-sm font-medium text-gray-700">24. Kejang</label>
                            <select name="kejang" id="kejang" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                <option value="Ya" {{ old('kejang', $kunjunganBayi->kejang) == 'Ya' ? 'selected' : '' }}>Ya</option>
                                <option value="Tidak" {{ old('kejang', $kunjunganBayi->kejang) == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                            </select>
                        </div>
                        <div>
                            <label for="suhu_tubuh_tanda_bahaya" class="block text-sm font-medium text-gray-700">25. Suhu Tubuh</label>
                            <select name="suhu_tubuh_tanda_bahaya" id="suhu_tubuh_tanda_bahaya" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                <option value="Ya" {{ old('suhu_tubuh_tanda_bahaya', $kunjunganBayi->suhu_tubuh_tanda_bahaya) == 'Ya' ? 'selected' : '' }}>Ya</option>
                                <option value="Tidak" {{ old('suhu_tubuh_tanda_bahaya', $kunjunganBayi->suhu_tubuh_tanda_bahaya) == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                            </select>
                        </div>
                    </div>

                    <!-- 26. Buang Air Besar (BAB), 27. Jumlah dan Warna Air Kencing, 28. Tali Pusat (Satu Baris) -->
                    <div class="grid grid-cols-3 gap-4 mb-4">
                        <div>
                            <label for="bab" class="block text-sm font-medium text-gray-700">26. Buang Air Besar (BAB)</label>
                            <select name="bab" id="bab" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                <option value="Ya" {{ old('bab', $kunjunganBayi->bab) == 'Ya' ? 'selected' : '' }}>Ya</option>
                                <option value="Tidak" {{ old('bab', $kunjunganBayi->bab) == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                            </select>
                        </div>
                        <div>
                            <label for="jumlah_warna_air_kencing" class="block text-sm font-medium text-gray-700">27. Jumlah dan Warna Air Kencing</label>
                            <select name="jumlah_warna_air_kencing" id="jumlah_warna_air_kencing" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                <option value="Ya" {{ old('jumlah_warna_air_kencing', $kunjunganBayi->jumlah_warna_air_kencing) == 'Ya' ? 'selected' : '' }}>Ya</option>
                                <option value="Tidak" {{ old('jumlah_warna_air_kencing', $kunjunganBayi->jumlah_warna_air_kencing) == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                            </select>
                        </div>
                        <div>
                            <label for="tali_pusat" class="block text-sm font-medium text-gray-700">28. Tali Pusat</label>
                            <select name="tali_pusat" id="tali_pusat" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                <option value="Ya" {{ old('tali_pusat', $kunjunganBayi->tali_pusat) == 'Ya' ? 'selected' : '' }}>Ya</option>
                                <option value="Tidak" {{ old('tali_pusat', $kunjunganBayi->tali_pusat) == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                            </select>
                        </div>
                    </div>

                    <!-- 29. Mata, 30. Kulit, 31. Imunisasi (Satu Baris) -->
                    <div class="grid grid-cols-3 gap-4 mb-4">
                        <div>
                            <label for="mata" class="block text-sm font-medium text-gray-700">29. Mata</label>
                            <select name="mata" id="mata" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                <option value="Ya" {{ old('mata', $kunjunganBayi->mata) == 'Ya' ? 'selected' : '' }}>Ya</option>
                                <option value="Tidak" {{ old('mata', $kunjunganBayi->mata) == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                            </select>
                        </div>
                        <div>
                            <label for="kulit" class="block text-sm font-medium text-gray-700">30. Kulit</label>
                            <select name="kulit_tanda_bahaya" id="kulit_tanda_bahaya" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                <option value="Ya" {{ old('kulit_tanda_bahaya', $kunjunganBayi->kulit_tanda_bahaya) == 'Ya' ? 'selected' : '' }}>Ya</option>
                                <option value="Tidak" {{ old('kulit_tanda_bahaya', $kunjunganBayi->kulit_tanda_bahaya) == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                            </select>
                        </div>
                        <div>
                            <label for="imunisasi" class="block text-sm font-medium text-gray-700">31. Imunisasi</label>
                            <select name="imunisasi_tanda_bahaya" id="imunisasi_tanda_bahaya" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                <option value="Ya" {{ old('imunisasi_tanda_bahaya', $kunjunganBayi->imunisasi_tanda_bahaya) == 'Ya' ? 'selected' : '' }}>Ya</option>
                                <option value="Tidak" {{ old('imunisasi_tanda_bahaya', $kunjunganBayi->imunisasi_tanda_bahaya) == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                            </select>
                        </div>
                    </div>

                    <!-- 32. Mengingatkan Periksa ke Pustu/Posyandu, 33. Melaporkan ke Nakes (Satu Baris) -->
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="mengingatkan_periksa_pustu" class="block text-sm font-medium text-gray-700">32. Mengingatkan Periksa ke Pustu/Posyandu</label>
                            <select name="mengingatkan_periksa_pustu" id="mengingatkan_periksa_pustu" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                <option value="Ya" {{ old('mengingatkan_periksa_pustu', $kunjunganBayi->mengingatkan_periksa_pustu) == 'Ya' ? 'selected' : '' }}>Ya</option>
                                <option value="Tidak" {{ old('mengingatkan_periksa_pustu', $kunjunganBayi->mengingatkan_periksa_pustu) == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                            </select>
                        </div>
                        <div>
                            <label for="melaporkan_ke_nakes" class="block text-sm font-medium text-gray-700">33. Melaporkan ke Nakes</label>
                            <input type="date" name="melaporkan_ke_nakes" id="melaporkan_ke_nakes" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-blue-500 focus:border-blue-500 sm:text-sm" value="{{ old('melaporkan_ke_nakes', $kunjunganBayi->melaporkan_ke_nakes) }}">
                        </div>
                    </div>


                    <!-- Tombol Submit -->
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
