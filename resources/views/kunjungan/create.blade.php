<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Tambah Kunjungan Ibu Hamil') }}
        </h2>
        <nav class="breadcrumb">
            <ol class="list-reset flex text-sm">
                <li><a href="/dashboard" class="text-blue-600 hover:text-blue-800">Home</a></li>
                <li><span class="mx-2">/</span></li>
                <li class="text-blue-600 font-semibold"><a href="{{ route('kunjungan.index') }}" class="text-blue-600 hover:text-blue-800">Data Kunjungan</a></li>
                <li><span class="mx-2">/</span></li>
                <li>Tambah Kunjungan</li>
            </ol>
        </nav>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-lg rounded-lg p-6">
                <form action="{{ route('kunjungan.store') }}" method="POST">
                    @csrf
                    <!-- Bagian Informasi Dasar -->
                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Informasi Dasar Ibu Hamil</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Nama Ibu -->
                            <div>
                                <label for="anggota_keluarga_id" class="block text-sm font-medium text-gray-700">Nama Ibu (sesuai KTP)</label>
                                @if(isset($anggotaKeluarga))
                                    <input type="hidden" name="anggota_keluarga_id" value="{{ $anggotaKeluarga->id }}">
                                    <p class="mt-1 text-sm text-gray-800 bg-gray-100 p-2 rounded">{{ $anggotaKeluarga->nama_lengkap }}</p>
                                @else
                                    <p class="mt-1 text-sm text-gray-800 bg-gray-100 p-2 rounded">-</p>
                                @endif
                            </div>

                            <!-- Umur -->
                            <div>
                                <label for="umur" class="block text-sm font-medium text-gray-700">Umur</label>
                                @if(isset($anggotaKeluarga) && $anggotaKeluarga->tanggal_lahir)
                                    @php
                                        $tanggalLahir = \Carbon\Carbon::parse($anggotaKeluarga->tanggal_lahir);
                                        $umur = $tanggalLahir->age;
                                    @endphp
                                    <input type="number" id="umur" name="umur" value="{{ $umur }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 bg-gray-100" readonly>
                                @else
                                    <input type="number" id="umur" name="umur" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                                @endif
                            </div>

                            <!-- Kehamilan Anak Ke -->
                            <div>
                                <label for="kehamilan_ke" class="block text-sm font-medium text-gray-700">Kehamilan Anak Ke</label>
                                <input type="number" id="kehamilan_ke" name="kehamilan_ke" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                            </div>

                            <!-- Jarak Kehamilan -->
                            <div>
                                <label for="jarak_kehamilan" class="block text-sm font-medium text-gray-700">Jarak Kehamilan (tahun/bulan)</label>
                                <input type="text" id="jarak_kehamilan" name="jarak_kehamilan" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            </div>
                        </div>
                    </div>

                    <!-- Bagian Informasi Kunjungan -->
                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Informasi Kunjungan</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="waktu_kunjungan" class="block text-sm font-medium text-gray-700">Waktu Kunjungan</label>
                                <input type="date" id="waktu_kunjungan" name="waktu_kunjungan" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div>
                                <label for="tanggal_kunjungan" class="block text-sm font-medium text-gray-700">Tanggal Kunjungan</label>
                                <input type="date" id="tanggal_kunjungan" name="tanggal_kunjungan" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div>
                                <label for="suhu_tubuh" class="block text-sm font-medium text-gray-700">Pemantauan Suhu Tubuh (°C)</label>
                                <input type="number" step="0.1" id="suhu_tubuh" name="suhu_tubuh" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div>
                                <label for="buku_kia" class="block text-sm font-medium text-gray-700">Ada Buku KIA</label>
                                <select id="buku_kia" name="buku_kia" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    <option value="Ya">Ya</option>
                                    <option value="Tidak">Tidak</option>
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
                                    <input type="date" id="k{{ $i }}_tanggal" name="k{{ $i }}_tanggal" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                </div>
                                <div class="w-1/3">
                                    <label for="k{{ $i }}_tempat" class="block text-sm font-medium text-gray-700">Tempat</label>
                                    <input type="text" id="k{{ $i }}_tempat" name="k{{ $i }}_tempat" placeholder="Tempat" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                </div>
                                <div class="w-1/3">
                                    <label for="k{{ $i }}_petugas" class="block text-sm font-medium text-gray-700">Petugas</label>
                                    <input type="text" id="k{{ $i }}_petugas" name="k{{ $i }}_petugas" placeholder="Petugas" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
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
                                <option value="Ya">Ya</option>
                                <option value="Tidak">Tidak</option>
                            </select>
                        </div>

                        <!-- 12-13. TTD -->
                        <div>
                            <label for="ttd" class="block text-sm font-medium text-gray-700">Tablet Tambah Darah (TTD)</label>
                            <select id="ttd" name="ttd" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                <option value="Ya">Ya</option>
                                <option value="Tidak">Tidak</option>
                            </select>
                        </div>
                        <div>
                            <label for="ttd_dikonsumsi" class="block text-sm font-medium text-gray-700">Minum TTD Hari Ini/Dalam 24 Jam Terakhir</label>
                            <select id="ttd_dikonsumsi" name="ttd_dikonsumsi" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                <option value="Ya">Ya</option>
                                <option value="Tidak">Tidak</option>
                            </select>
                        </div>

                        <!-- 14. LiLA -->
                        <div>
                            <label for="lila" class="block text-sm font-medium text-gray-700">Lingkar Lengan Atas (LiLA) < 23.5 cm</label>
                            <select id="lila" name="lila" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                <option value="Ya">Ya</option>
                                <option value="Tidak">Tidak</option>
                            </select>
                        </div>
                           
                      <!-- 15. PMT Bumil KEK -->
                      <div>
                            <label for="pmt_bumil_kek" class="block text-sm font-medium text-gray-700">Pemberian PMT Bumil KEK</label>
                            <select id="pmt_bumil_kek" name="pmt_bumil_kek" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                <option value="Ya">Ya</option>
                                <option value="Tidak">Tidak</option>
                            </select>
                        </div>

                        <!-- 16. Kelas Ibu Hamil -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Kelas Ibu Hamil</label>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div>
                                    <label for="kelas_tanggal" class="block text-sm text-gray-600">Tanggal</label>
                                    <input type="date" id="kelas_tanggal" name="kelas_tanggal" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                </div>
                                <div>
                                    <label for="kelas_tempat" class="block text-sm text-gray-600">Tempat</label>
                                    <input type="text" id="kelas_tempat" name="kelas_tempat" placeholder="Masukkan Tempat" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                </div>
                                <div>
                                    <label for="kelas_pendamping" class="block text-sm text-gray-600">Pendamping</label>
                                    <input type="text" id="kelas_pendamping" name="kelas_pendamping" placeholder="Nama Pendamping" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                </div>
                            </div>
                        </div>

                        <!-- 17. Skrining Kesehatan Jiwa -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Skrining Kesehatan Jiwa</label>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div>
                                    <label for="skrining_tanggal" class="block text-sm text-gray-600">Tanggal</label>
                                    <input type="date" id="skrining_tanggal" name="skrining_tanggal" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                </div>
                                <div>
                                    <label for="skrining_tempat" class="block text-sm text-gray-600">Tempat</label>
                                    <input type="text" id="skrining_tempat" name="skrining_tempat" placeholder="Masukkan Tempat" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                </div>
                                <div>
                                    <label for="skrining_petugas" class="block text-sm text-gray-600">Petugas</label>
                                    <input type="text" id="skrining_petugas" name="skrining_petugas" placeholder="Nama Petugas" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                </div>
                            </div>
                        </div>

                        <!-- 18. Edukasi -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Pemberian Edukasi/Kunjungan Nakes</label>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="edukasi_tanggal" class="block text-sm text-gray-600">Tanggal</label>
                                    <input type="date" id="edukasi_tanggal" name="edukasi_tanggal" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                </div>
                                <div>
                                    <label for="edukasi_materi" class="block text-sm text-gray-600">Materi</label>
                                    <input type="text" id="edukasi_materi" name="edukasi_materi" placeholder="Masukkan Materi" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                </div>
                            </div>
                        </div>

                        <!-- 19. Paraf Ibu Hamil -->
                        <div>
                            <label for="paraf" class="block text-sm font-medium text-gray-700">Paraf Ibu Hamil</label>
                            <select id="paraf" name="paraf" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                <option value="Ya">Ya</option>
                                <option value="Tidak">Tidak</option>
                            </select>
                        </div>
                    </div>

                    <!-- Tombol Simpan -->
                    <div class="mt-6">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded shadow">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

                       