<x-app-layout>
    <x-slot name="header">
        
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('FORM CHEKLIST KUNJUNGAN RUMAH') }}
            </h2>
            <nav class="breadcrumb">
                <ol class="list-reset flex text-sm"> <!-- Perkecil font dengan text-sm -->
                    <li><a href="/dashboard" class="text-blue-600 hover:text-blue-800">Home </a></li>
                    <li><span class="mx-2">/ </span></li>
                    <!-- Tambahkan warna biru pada item yang dikunjungi -->
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


            <form action="{{ route('keluarga.store') }}" method="POST" class="p-6 space-y-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Tanggal Pengumpulan Data -->
                    <div class="col-span-1">
                        <label for="tanggal_pengumpulan_data" class="block text-sm font-medium text-gray-700">Tanggal Pengumpulan Data</label>
                        <input type="date" id="tanggal_pengumpulan_data" name="tanggal_pengumpulan_data" value="{{ old('tanggal_pengumpulan_data') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('tanggal_pengumpulan_data') border-red-500 @enderror">
                        @error('tanggal_pengumpulan_data')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Alamat -->
                    <div class="col-span-1">
                        <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
                       <input type="text" id="alamat" name="alamat" value="{{ old('alamat') }}" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:text-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('alamat') border-red-500 @enderror">

                        @error('alamat')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- No Handphone -->
                    <div class="col-span-1">
                        <label for="no_handphone" class="block text-sm font-medium text-gray-700">No Handphone KK / salah satu anggota keluarga</label>
                        <input type="text" id="no_handphone" name="no_handphone" value="{{ old('no_handphone') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('no_handphone') border-red-500 @enderror">
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
                            <option selected disabled>Pilih Kecamatan</option>
                            <option value="Banjarsari">Banjarsari</option>
                            <option value="Jebres">Jebres</option>
                            <option value="Laweyan">Laweyan</option>
                            <option value="Pasar Kliwon">Pasar Kliwon</option>
                            <option value="Serengan">Serengan</option>
                        </select>
                    </div>

                    <!-- Kelurahan -->
                    <div class="col-span-1">
                        <label for="kelurahan" class="block text-sm font-medium text-gray-700">Kelurahan</label>
                        <select id="kelurahan" name="kelurahan" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            <option selected disabled>Pilih Kelurahan</option>
                        </select>
                    </div>


                    <!-- Puskesmas -->
                    <div class="col-span-1">
                        <label for="puskesmas" class="block text-sm font-medium text-gray-700">Puskesmas</label>
                        <input type="text" id="puskesmas" name="puskesmas" value="{{ old('puskesmas') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('puskesmas') border-red-500 @enderror">
                        @error('puskesmas')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Pustu / Posyandu Prima -->
                    <div class="col-span-1">
                        <label for="pustu" class="block text-sm font-medium text-gray-700">Pustu/Posyandu Prima</label>
                        <input type="text" id="pustu" name="pustu" value="{{ old('pustu', Auth::user()->nama_posyandu ?? '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('pustu') border-red-500 @enderror">
                        @error('pustu')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Provinsi -->
                    <div class="col-span-1">
                        <label for="provinsi" class="block text-sm font-medium text-gray-700">Provinsi</label>
                        <input type="text" id="provinsi" name="provinsi" value="{{ old('provinsi') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('provinsi') border-red-500 @enderror">
                        @error('provinsi')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <!-- JKN -->
                    <div class="col-span-1">
                        <label for="jkn" class="block text-sm font-medium text-gray-700">Apakah memiliki Jaminan Kesehatan Nasional (JKN) / Jaminan
                        Kesehatan Daerah (Jamkesda) / Asuransi Kesehatan?</label>
                        <select id="jkn" name="jkn" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('jkn') border-red-500 @enderror">
                            <option selected disabled>Pilih Status</option>
                            <option value="Ya" {{ old('jkn') == 'Ya' ? 'selected' : '' }}>Ya</option>
                            <option value="Tidak" {{ old('jkn') == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                        </select>
                        @error('jkn')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Sarana Air Bersih -->
                    <div class="col-span-1">
                        <label for="sarana_air_bersih" class="block text-sm font-medium text-gray-700">Apakah tersedia sarana air bersih di lingkungan rumah?</label>
                        <select id="sarana_air_bersih" name="sarana_air_bersih" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('sarana_air_bersih') border-red-500 @enderror">
                            <option selected disabled>Pilih Status</option>
                            <option value="Ya" {{ old('sarana_air_bersih') == 'Ya' ? 'selected' : '' }}>Ya</option>
                            <option value="Tidak" {{ old('sarana_air_bersih') == 'Tidak' ? 'selected' : '' }}>Tidak</option>
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
                            <option value="Terlindung" {{ old('jenis_sumber_air') == 'Terlindung' ? 'selected' : '' }}>Terlindung</option>
                            <option value="Tidak_Terlindung" {{ old('jenis_sumber_air') == 'Tidak_Terlindung' ? 'selected' : '' }}>Tidak Terlindung</option>
                        </select>
                        @error('jenis_sumber_air')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Jamban Keluarga -->
                    <div class="col-span-1">
                        <label for="jamban_keluarga" class="block text-sm font-medium text-gray-700">Apakah tersedia jamban keluarga ?</label>
                        <select id="jamban_keluarga" name="jamban_keluarga" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('jamban_keluarga') border-red-500 @enderror">
                            <option selected disabled>Pilih Status</option>
                            <option value="Ya" {{ old('jamban_keluarga') == 'Ya' ? 'selected' : '' }}>Ya</option>
                            <option value="Tidak" {{ old('jamban_keluarga') == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                        </select>
                        @error('jamban_keluarga')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Jenis Jamban -->
                    <div class="col-span-1">
                        <label for="jenis_jamban" class="block text-sm font-medium text-gray-700">apakan jenis jambannya saniter ?</label>
                        <select id="jenis_jamban" name="jenis_jamban" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('jenis_jamban') border-red-500 @enderror">
                            <option selected disabled>Pilih Jenis</option>
                            <option value="Saniter" {{ old('jenis_jamban') == 'Saniter' ? 'selected' : '' }}>Saniter</option>
                            <option value="Tidak_Saniter" {{ old('jenis_jamban') == 'Tidak_Saniter' ? 'selected' : '' }}>Tidak Saniter</option>
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
                            <option value="Ya" {{ old('ventilasi') == 'Ya' ? 'selected' : '' }}>Ya</option>
                            <option value="Tidak" {{ old('ventilasi') == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                        </select>
                        @error('ventilasi')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Gangguan Jiwa -->
                    <div class="col-span-1">
                        <label for="gangguan_jiwa" class="block text-sm font-medium text-gray-700">Apakah ada anggota keluarga yang mengalami gangguan jiwa ?</label>
                        <select id="gangguan_jiwa" name="gangguan_jiwa" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('gangguan_jiwa') border-red-500 @enderror">
                            <option selected disabled>Pilih Status</option>
                            <option value="Ya" {{ old('gangguan_jiwa') == 'Ya' ? 'selected' : '' }}>Ya</option>
                            <option value="Tidak" {{ old('gangguan_jiwa') == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                        </select>
                        @error('gangguan_jiwa')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Terdiagnosis Penyakit -->
                    <div class="col-span-1">
                        <label for="terdiagnosis_penyakit" class="block text-sm font-medium text-gray-700">Apakah ada anggota keluarga yang terdiagnosis penyakit berikut?
                        (TBC, Hipertensi, Diabetes Melitus)?</label>
                        <select id="terdiagnosis_penyakit" name="terdiagnosis_penyakit" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('terdiagnosis_penyakit') border-red-500 @enderror">
                            <option selected disabled>Pilih Status</option>
                            <option value="Ya" {{ old('terdiagnosis_penyakit') == 'Ya' ? 'selected' : '' }}>Ya</option>
                            <option value="Tidak" {{ old('terdiagnosis_penyakit') == 'Tidak' ? 'selected' : '' }}>Tidak</option>
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
                    </div>

                    <button type="button" id="addAnggotaButton" class="mt-3 inline-flex items-center px-4 py-2 border border-blue-600 rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Tambah Anggota
                    </button>

                </div>

                <div class="flex justify-end mt-6">
               
                <button type="submit" class="ml-2 bg-gray-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded shadow">
                    Submit
                </button>

                <button type="reset" class="ml-2 bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded shadow">
                    Reset
                </button>

                </div>
            </form>
        </div>
    </div>

    <!-- Import jQuery for dynamic fields -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
$(document).ready(function() {
    $('#kecamatan').on('change', function() {
        var kecamatan = $(this).val();
        if(kecamatan) {
            $.ajax({
                url: '/getKelurahan/'+kecamatan,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#kelurahan').empty();
                    $('#kelurahan').append('<option selected disabled>Pilih Kelurahan</option>'); 
                    $.each(data, function(key, value) {
                        $('#kelurahan').append('<option value="'+ value +'">'+ value +'</option>');
                    });
                }
            });
        } else {
            $('#kelurahan').empty();
            $('#kelurahan').append('<option selected disabled>Pilih Kelurahan</option>'); 
        }
    });
});
</script>

    <!-- Script untuk menambahkan anggota keluarga -->
        <script>
    $(document).ready(function() {
        let anggotaCount = {{ old('anggota') ? count(old('anggota')) : 0 }};

    function addAnggotaForm(index, data = {}) {
            anggotaCount++;
            let anggotaForm = `
                <div class="grid  gap-4 p-5 bg-white rounded-md shadow-md border border-gray-200" id="anggota_${anggotaCount}">
                    <div class="col-span-2 flex justify-between items-center">
                        <h5 class="font-semibold">Anggota Keluarga ${anggotaCount}</h5>
                        <button type="button" class="text-red-600 hover:text-red-800" onclick="removeAnggota(${anggotaCount})">Hapus Anggota</button>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                    <!-- Nama Lengkap -->
                    <div class="col-span-1">
                        <label for="nama_lengkap_${anggotaCount}" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                        <input type="text" id="nama_lengkap_${anggotaCount}" name="anggota[${anggotaCount}][nama_lengkap]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                    </div>

                    <!-- NIK -->
                    <div class="col-span-1">
                        <label for="nik_${anggotaCount}" class="block text-sm font-medium text-gray-700">NIK</label>
                        <input type="text" id="nik_${anggotaCount}" name="anggota[${anggotaCount}][nik]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                    </div>

                    <!-- Tanggal Lahir -->
                    <div class="col-span-1">
                        <label for="tanggal_lahir_${anggotaCount}" class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                        <input type="date" id="tanggal_lahir_${anggotaCount}" name="anggota[${anggotaCount}][tanggal_lahir]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                    </div>

                    <!-- Jenis Kelamin -->
                    <div class="col-span-1">
                        <label for="jenis_kelamin_${anggotaCount}" class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                        <select id="jenis_kelamin_${anggotaCount}" name="anggota[${anggotaCount}][jenis_kelamin]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                            <option value="Laki-Laki">Laki-Laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>

                    <!-- Hubungan KK -->
                    <div>
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

                    <!-- Status Perkawinan -->
                    <div>
                        <label for="status_perkawinan_${anggotaCount}" class="block text-sm font-medium text-gray-700">Status Perkawinan</label>
                        <select id="status_perkawinan_${anggotaCount}" name="anggota[${anggotaCount}][status_perkawinan]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                            <option value="1">Belum Menikah</option>
                            <option value="2">Menikah</option>
                            <option value="3">Cerai Hidup</option>
                            <option value="4">Cerai Mati</option>
                        </select>
                    </div>

                    <!-- Pendidikan Terakhir -->
                    <div>
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

                    <!-- Pekerjaan -->
                    <div>
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

                    <!-- Kelompok Sasaran -->
                    <div>
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
                    </div>
                </div>`;
            
                $('#anggotaKeluargaContainer').append(anggotaForm);

                // Validasi NIK: Hanya izinkan input dengan 16 digit
                $(`[name="anggota[${index}][nik]"]`).on('input', function() {
                    const nikValue = $(this).val();
                    if (nikValue.length !== 16) {
                        this.setCustomValidity('NIK harus 16 digit');
                    } else {
                        this.setCustomValidity('');
                    }
                    this.reportValidity();
                });
                }

                // Load old data jika ada validasi yang gagal
                @if(old('anggota'))
                @foreach(old('anggota') as $index => $anggota)
                    addAnggotaForm({{ $index }}, @json($anggota));
                @endforeach
                @else
                // Jika tidak ada data lama, tambahkan minimal satu form kosong
                addAnggotaForm(0);
                @endif

                // Tambahkan anggota baru saat tombol "Tambah Anggota" diklik
                $('#addAnggotaButton').click(function() {
                addAnggotaForm(anggotaCount);
                anggotaCount++;
                });

                // Function untuk menghapus form anggota keluarga
                window.removeAnggota = function(index) {
                $('#anggota_' + index).remove();
                };
                });
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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