<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Edit Kunjungan Ibu Hamil') }}
        </h2>
        <nav class="breadcrumb">
            <ol class="list-reset flex text-sm">
                <li><a href="/dashboard" class="text-blue-600 hover:text-blue-800">Home</a></li>
                <li><span class="mx-2">/</span></li>
                <li class="text-blue-600 font-semibold"><a href="{{ route('kunjungan.index') }}" class="text-blue-600 hover:text-blue-800">Data Kunjungan</a></li>
                <li><span class="mx-2">/</span></li>
                <li>Edit Kunjungan</li>
            </ol>
        </nav>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-lg rounded-lg p-6">
                <form action="{{ route('kunjungan.update', $kunjungan->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <!-- Bagian Informasi Dasar -->
                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Informasi Dasar Ibu Hamil</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Nama Ibu -->
                            <div>
                                <label for="anggota_keluarga_id" class="block text-sm font-medium text-gray-700">Nama Ibu (sesuai KTP)</label>
                                @if(isset($kunjungan->anggotaKeluarga))
                                    <input type="hidden" name="anggota_keluarga_id" value="{{ $kunjungan->anggotaKeluarga->id }}">
                                    <p class="mt-1 text-sm text-gray-800 bg-gray-100 p-2 rounded">{{ $kunjungan->anggotaKeluarga->nama_lengkap }}</p>
                                @else
                                    <p class="mt-1 text-sm text-gray-800 bg-gray-100 p-2 rounded">-</p>
                                @endif
                            </div>

                            <!-- Umur -->
                            <div>
                                <label for="umur" class="block text-sm font-medium text-gray-700">Umur</label>
                                <input type="number" id="umur" name="umur" value="{{ old('umur', $kunjungan->umur) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                            </div>

                            <!-- Kehamilan Anak Ke -->
                            <div>
                                <label for="kehamilan_ke" class="block text-sm font-medium text-gray-700">Kehamilan Anak Ke</label>
                                <input type="number" id="kehamilan_ke" name="kehamilan_ke" value="{{ old('kehamilan_ke', $kunjungan->kehamilan_ke) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                            </div>

                            <!-- Jarak Kehamilan -->
                            <div>
                                <label for="jarak_kehamilan" class="block text-sm font-medium text-gray-700">Jarak Kehamilan (tahun/bulan)</label>
                                <input type="text" id="jarak_kehamilan" name="jarak_kehamilan" value="{{ old('jarak_kehamilan', $kunjungan->jarak_kehamilan) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            </div>
                        </div>
                    </div>

                    <!-- Bagian Informasi Kunjungan -->
                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Informasi Kunjungan</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="waktu_kunjungan" class="block text-sm font-medium text-gray-700">Waktu Kunjungan</label>
                                <input type="date" id="waktu_kunjungan" name="waktu_kunjungan" value="{{ old('waktu_kunjungan', $kunjungan->waktu_kunjungan) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div>
                                <label for="tanggal_kunjungan" class="block text-sm font-medium text-gray-700">Tanggal Kunjungan</label>
                                <input type="date" id="tanggal_kunjungan" name="tanggal_kunjungan" value="{{ old('tanggal_kunjungan', $kunjungan->tanggal_kunjungan) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div>
                                <label for="suhu_tubuh" class="block text-sm font-medium text-gray-700">Pemantauan Suhu Tubuh (°C)</label>
                                <input type="number" step="0.1" id="suhu_tubuh" name="suhu_tubuh" value="{{ old('suhu_tubuh', $kunjungan->suhu_tubuh) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div>
                                <label for="buku_kia" class="block text-sm font-medium text-gray-700">Ada Buku KIA</label>
                                <select id="buku_kia" name="buku_kia" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    <option value="Ya" {{ old('buku_kia', $kunjungan->buku_kia) == 'Ya' ? 'selected' : '' }}>Ya</option>
                                    <option value="Tidak" {{ old('buku_kia', $kunjungan->buku_kia) == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Pemeriksaan Kehamilan (K1-K6) -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @for ($i = 1; $i <= 6; $i++)
                        <div>
                            <h4 class="text-md font-semibold text-gray-800 mb-2">K{{ $i }} (Trimester {{ $i <= 3 ? 'I/II' : 'III' }})</h4>
                            <div class="grid grid-cols-1 gap-4">
                                <div class="flex gap-4">
                                    <div class="w-1/3">
                                        <label for="k{{ $i }}_tanggal" class="block text-sm font-medium text-gray-700">Tanggal</label>
                                        <input type="date" id="k{{ $i }}_tanggal" name="k{{ $i }}_tanggal" value="{{ old('k'.$i.'_tanggal', $kunjungan->{'k'.$i}['tanggal'] ?? '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div class="w-1/3">
                                        <label for="k{{ $i }}_tempat" class="block text-sm font-medium text-gray-700">Tempat</label>
                                        <input type="text" id="k{{ $i }}_tempat" name="k{{ $i }}_tempat" placeholder="Tempat" value="{{ old('k'.$i.'_tempat', $kunjungan->{'k'.$i}['tempat'] ?? '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div class="w-1/3">
                                        <label for="k{{ $i }}_petugas" class="block text-sm font-medium text-gray-700">Petugas</label>
                                        <input type="text" id="k{{ $i }}_petugas" name="k{{ $i }}_petugas" placeholder="Petugas" value="{{ old('k'.$i.'_petugas', $kunjungan->{'k'.$i}['petugas'] ?? '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endfor
                    </div>

                   
                    <!-- Informasi Tambahan -->
                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Informasi Tambahan</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- 11. Isi Piringku -->
                            <div>
                                <label for="isi_piringku" class="block text-sm font-medium text-gray-700">Isi Piringku Ibu Hamil</label>
                                <select id="isi_piringku" name="isi_piringku" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    <option value="Ya" {{ old('isi_piringku', $kunjungan->isi_piringku) == 'Ya' ? 'selected' : '' }}>Ya</option>
                                    <option value="Tidak" {{ old('isi_piringku', $kunjungan->isi_piringku) == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                                </select>
                            </div>

                            <!-- 12-13. TTD -->
                            <div>
                                <label for="ttd" class="block text-sm font-medium text-gray-700">Tablet Tambah Darah (TTD)</label>
                                <select id="ttd" name="ttd" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    <option value="Ya" {{ old('ttd', $kunjungan->ttd) == 'Ya' ? 'selected' : '' }}>Ya</option>
                                    <option value="Tidak" {{ old('ttd', $kunjungan->ttd) == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                                </select>
                            </div>
                            <div>
                                <label for="ttd_dikonsumsi" class="block text-sm font-medium text-gray-700">Minum TTD Hari Ini/Dalam 24 Jam Terakhir</label>
                                <select id="ttd_dikonsumsi" name="ttd_dikonsumsi" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    <option value="Ya" {{ old('ttd_dikonsumsi', $kunjungan->ttd_dikonsumsi) == 'Ya' ? 'selected' : '' }}>Ya</option>
                                    <option value="Tidak" {{ old('ttd_dikonsumsi', $kunjungan->ttd_dikonsumsi) == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                                </select>
                            </div>

                            <!-- 14. LiLA -->
                            <div>
                                <label for="lila" class="block text-sm font-medium text-gray-700">Lingkar Lengan Atas (LiLA) < 23.5 cm</label>
                                <select id="lila" name="lila" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    <option value="Ya" {{ old('lila', $kunjungan->lila) == 'Ya' ? 'selected' : '' }}>Ya</option>
                                    <option value="Tidak" {{ old('lila', $kunjungan->lila) == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                                </select>
                            </div>

                            <!-- 15. PMT Bumil KEK -->
                            <div>
                                <label for="pmt_bumil_kek" class="block text-sm font-medium text-gray-700">Pemberian PMT Bumil KEK</label>
                                <select id="pmt_bumil_kek" name="pmt_bumil_kek" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    <option value="Ya" {{ old('pmt_bumil_kek', $kunjungan->pmt_bumil_kek) == 'Ya' ? 'selected' : '' }}>Ya</option>
                                    <option value="Tidak" {{ old('pmt_bumil_kek', $kunjungan->pmt_bumil_kek) == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                                </select>
                            </div>

                           <!-- 16. Kelas Ibu Hamil -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Kelas Ibu Hamil</label>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    @php
                                        $kelas = json_decode($kunjungan->kelas_ibu_hamil, true) ?? [];
                                    @endphp
                                    <div>
                                        <label for="kelas_tanggal" class="block text-sm text-gray-600">Tanggal</label>
                                        <input type="date" id="kelas_tanggal" name="kelas_tanggal" value="{{ old('kelas_tanggal', $kelas['tanggal'] ?? '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label for="kelas_tempat" class="block text-sm text-gray-600">Tempat</label>
                                        <input type="text" id="kelas_tempat" name="kelas_tempat" placeholder="Masukkan Tempat" value="{{ old('kelas_tempat', $kelas['tempat'] ?? '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label for="kelas_pendamping" class="block text-sm text-gray-600">Pendamping</label>
                                        <input type="text" id="kelas_pendamping" name="kelas_pendamping" placeholder="Nama Pendamping" value="{{ old('kelas_pendamping', $kelas['pendamping'] ?? '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                </div>
                            </div>

                            <!-- 17. Skrining Kesehatan Jiwa -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Skrining Kesehatan Jiwa</label>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    @php
                                        $skrining = json_decode($kunjungan->skrining_jiwa, true) ?? [];
                                    @endphp
                                    <div>
                                        <label for="skrining_tanggal" class="block text-sm text-gray-600">Tanggal</label>
                                        <input type="date" id="skrining_tanggal" name="skrining_tanggal" value="{{ old('skrining_tanggal', $skrining['tanggal'] ?? '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label for="skrining_tempat" class="block text-sm text-gray-600">Tempat</label>
                                        <input type="text" id="skrining_tempat" name="skrining_tempat" placeholder="Masukkan Tempat" value="{{ old('skrining_tempat', $skrining['tempat'] ?? '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label for="skrining_petugas" class="block text-sm text-gray-600">Petugas</label>
                                        <input type="text" id="skrining_petugas" name="skrining_petugas" placeholder="Nama Petugas" value="{{ old('skrining_petugas', $skrining['petugas'] ?? '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                </div>
                            </div>

                            <!-- 18. Edukasi -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Pemberian Edukasi/Kunjungan Nakes</label>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    @php
                                        $edukasi = json_decode($kunjungan->edukasi, true) ?? [];
                                    @endphp
                                    <div>
                                        <label for="edukasi_tanggal" class="block text-sm text-gray-600">Tanggal</label>
                                        <input type="date" id="edukasi_tanggal" name="edukasi_tanggal" value="{{ old('edukasi_tanggal', $edukasi['tanggal'] ?? '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label for="edukasi_materi" class="block text-sm text-gray-600">Materi</label>
                                        <input type="text" id="edukasi_materi" name="edukasi_materi" placeholder="Masukkan Materi" value="{{ old('edukasi_materi', $edukasi['materi'] ?? '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                </div>
                            </div>


                            <!-- 19. Paraf Ibu Hamil -->
                            <div>
                                <label for="paraf" class="block text-sm font-medium text-gray-700">Paraf Ibu Hamil</label>
                                <select id="paraf" name="paraf" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    <option value="Ya" {{ old('paraf', $kunjungan->paraf) == 'Ya' ? 'selected' : '' }}>Ya</option>
                                    <option value="Tidak" {{ old('paraf', $kunjungan->paraf) == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                                </select>
                            </div>
                        </div>
                    </div>


                    <!-- Tombol Simpan -->
                    <div class="mt-6">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded shadow">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
