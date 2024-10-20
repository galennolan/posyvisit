<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Daftar Keluarga dan Anggota Keluarga') }}
        </h2>
        <nav class="breadcrumb">
                <ol class="list-reset flex text-sm"> <!-- Perkecil font dengan text-sm -->
                    <li><a href="/dashboard" class="text-blue-600 hover:text-blue-800">Home </a></li>
                    <li><span class="mx-2">/ </span></li>
                    <!-- Tambahkan warna biru pada item yang dikunjungi -->
                    <li class="text-blue-600 font-semibold"><a href="/keluarga/create" class="text-blue-600 hover:text-blue-800">Form Kunjungan </a> </li> 
                </ol>
            </nav>
        
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-lg rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-700 mb-4">Daftar Keluarga</h3>
                <div class="flex space-x-4 mb-4">

                <!-- Form Filter Tanggal -->
                <form method="POST" action="{{ route('keluarga.filter') }}" class="mb-4 flex space-x-4">
                @csrf <!-- Token CSRF -->
                    <div class="flex space-x-4 mb-4">
                        <!-- Tanggal Mulai -->
                        <div>
                            <label for="tanggalMulai" class="block text-sm font-medium text-gray-700">Tanggal Mulai</label>
                            <input type="date" id="tanggalMulai" name="tanggal_mulai" 
                                value="{{ old('tanggal_mulai', isset($tanggalMulai) ? $tanggalMulai : '') }}" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <!-- Tanggal Akhir -->
                        <div>
                            <label for="tanggalAkhir" class="block text-sm font-medium text-gray-700">Tanggal Akhir</label>
                            <input type="date" id="tanggalAkhir" name="tanggal_akhir" 
                                value="{{ old('tanggal_akhir', isset($tanggalAkhir) ? $tanggalAkhir : '') }}" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <!-- Tombol Filter -->
                        <div class="flex items-end">
                            <button type="submit" id="filterButton" class="ml-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded shadow">
                                Filter
                            </button>
                        </div>
                    </div>
                </form>
            </div>

                <div class="table-responsive overflow-x-auto bg-white shadow sm:rounded-lg p-4">
                    <table id="keluargaTable" class="min-w-full divide-y divide-gray-200 table-auto">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                <th scope="col" class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Kepala Keluarga</th>
                                <th scope="col" class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Alamat</th>
                                <th scope="col" class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No Handphone</th>
                                <th scope="col" class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Anggota Keluarga</th>
                                <th scope="col" class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th> <!-- Tombol Aksi -->
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($keluargas as $index => $keluarga)
                                <tr class="hover:bg-gray-50 transition duration-200">
                                    <td class="px-4 py-2 text-sm text-gray-500">{{ $index + 1 }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-700">@php
                                        $anggota = $keluarga->anggotaKeluarga->firstWhere('hubungan_kk', 1);
                                    @endphp
                                    {{ $anggota ? $anggota->nama_lengkap : '-' }}</td>
                                    <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-700">{{ \Illuminate\Support\Str::limit($keluarga->alamat, 35, '...') }}</td>
                                    <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-700">{{ $keluarga->no_handphone }}</td>
                                    <td class="px-4 py-2 whitespace-normal text-sm text-gray-700">
                                         <ul class="list-disc pl-5 space-y-2">
                                            
                                        @foreach($keluarga->anggotaKeluarga as $anggota)
                                        <li>
                                        @if($anggota->kelompok_sasaran === 'Ibu Hamil')
                                            @php
                                                // Cek apakah anggota ini memiliki data kunjungan Ibu Hamil
                                                $kunjunganHamil = $anggota->kunjunganIbuHamil ?? null;
                                            @endphp
                                            {{ $anggota->nama_lengkap }} ({{ $anggota->nik }},
                                            @if($kunjunganHamil)
                                                <!-- Jika data kunjungan Ibu Hamil ada, arahkan ke halaman edit -->
                                                <a href="{{ route('kunjungan.edit', ['kunjungan' => $kunjunganHamil->id]) }}" class="text-blue-600 hover:text-blue-800">
                                                    {{ $anggota->kelompok_sasaran }}
                                                </a>)
                                            @else
                                                <!-- Jika data kunjungan Ibu Hamil tidak ada, arahkan ke halaman create -->
                                                <a href="{{ route('kunjungan.create', ['anggota_keluarga_id' => $anggota->id]) }}" class="text-blue-600 hover:text-blue-800">
                                                    {{ $anggota->kelompok_sasaran }}
                                                </a>)
                                            @endif

                                        @elseif($anggota->kelompok_sasaran === 'Ibu Bersalin & Nifas')
                                            @php
                                                // Cek apakah anggota ini memiliki data kunjungan Ibu Bersalin & Nifas
                                                $kunjunganBersalin = $anggota->kunjunganIbuBersalinNifas ?? null;
                                            @endphp
                                            {{ $anggota->nama_lengkap }} ({{ $anggota->nik }},
                                            @if($kunjunganBersalin)
                                                <!-- Jika data kunjungan Ibu Bersalin & Nifas ada, arahkan ke halaman edit -->
                                                <a href="{{ route('kunjungan-ibu-bersalin.edit', ['kunjungan_ibu_bersalin' => $kunjunganBersalin->id]) }}" class="text-blue-600 hover:text-blue-800">
                                                    {{ $anggota->kelompok_sasaran }}
                                                </a>)
                                            @else
                                                <!-- Jika data kunjungan Ibu Bersalin & Nifas tidak ada, arahkan ke halaman create -->
                                                <a href="{{ route('kunjungan-ibu-bersalin.create', ['anggota_keluarga_id' => $anggota->id]) }}" class="text-blue-600 hover:text-blue-800">
                                                    {{ $anggota->kelompok_sasaran }}
                                                </a>)
                                            @endif

                                        @elseif($anggota->kelompok_sasaran === 'Bayi - Balita (0-6 bulan)')
                                            @php
                                                // Cek apakah anggota ini memiliki data kunjungan Bayi
                                                $kunjunganBayi = $anggota->kunjunganBayi ?? null;
                                            @endphp
                                            {{ $anggota->nama_lengkap }} ({{ $anggota->nik }},
                                            @if($kunjunganBayi)
                                                <!-- Jika data kunjungan Bayi ada, arahkan ke halaman edit -->
                                                <a href="{{ route('kunjungan-bayi.edit', ['kunjungan_bayi' => $kunjunganBayi->id]) }}" class="text-blue-600 hover:text-blue-800">
                                                    {{ $anggota->kelompok_sasaran }}
                                                </a>)
                                            @else
                                                <!-- Jika data kunjungan Bayi tidak ada, arahkan ke halaman create -->
                                                <a href="{{ route('kunjungan-bayi.create', ['anggota_keluarga_id' => $anggota->id]) }}" class="text-blue-600 hover:text-blue-800">
                                                    {{ $anggota->kelompok_sasaran }}
                                                </a>)
                                            @endif

                                            @elseif($anggota->kelompok_sasaran === 'Balita dan Apras (6 - 71 bulan)')
                                            @php
                                                // Ambil data kunjungan balita apras
                                                $kunjunganBalitaApras = $anggota->kunjunganRumahBalitaApras;
                                            @endphp
                                            {{ $anggota->nama_lengkap }} ({{ $anggota->nik }},
                                            @if($kunjunganBalitaApras)
                                                <!-- Jika data kunjungan Balita Apras ada, arahkan ke halaman edit -->
                                                <a href="{{ route('kunjungan-rumah-balita-apras.edit', ['kunjungan_rumah_balita_apra' => $kunjunganBalitaApras->id]) }}" class="text-blue-600 hover:text-blue-800">
                                                    {{ $anggota->kelompok_sasaran }}
                                                </a>)
                                            @else
                                                <!-- Jika data kunjungan Balita Apras tidak ada, arahkan ke halaman create -->
                                                <a href="{{ route('kunjungan-rumah-balita-apras.create', ['anggota_keluarga_id' => $anggota->id]) }}" class="text-blue-600 hover:text-blue-800">
                                                    {{ $anggota->kelompok_sasaran }}
                                                </a>)
                                            @endif
                                            @elseif($anggota->kelompok_sasaran === 'Usia Sekolah & Remaja')
                                            @php
                                                // Ambil data kunjungan-remaja
                                                $kunjunganRemaja = $anggota->kunjunganRemaja;
                                            @endphp
                                            {{ $anggota->nama_lengkap }} ({{ $anggota->nik }},
                                            @if($kunjunganRemaja)
                                                <!-- Jika data kunjungan-remaja ada, arahkan ke halaman edit -->
                                                <a href="{{ route('kunjungan-rumah-usia-remaja.edit', ['kunjungan_rumah_usia_remaja' => $kunjunganRemaja->id]) }}" class="text-blue-600 hover:text-blue-800">
                                                    {{ $anggota->kelompok_sasaran }}
                                                </a>)
                                            @else
                                                <!-- Jika data kunjungan-remaja tidak ada, arahkan ke halaman create -->
                                                <a href="{{ route('kunjungan-rumah-usia-remaja.create', ['anggota_keluarga_id' => $anggota->id]) }}" class="text-blue-600 hover:text-blue-800">
                                                    {{ $anggota->kelompok_sasaran }}
                                                </a>)
                                            @endif
                                            @elseif($anggota->kelompok_sasaran === 'Usia Dewasa (18-59 tahun)')
                                            @php
                                                // Ambil data kunjungan-usia-dewasa
                                                $kunjunganDewasa = $anggota->kunjunganUsiaDewasa;
                                            @endphp
                                            {{ $anggota->nama_lengkap }} ({{ $anggota->nik }},
                                            @if($kunjunganDewasa)
                                                <!-- Jika data kunjungan-usia-dewasa ada, arahkan ke halaman edit -->
                                                <a href="{{ route('kunjungan-usia-dewasa.edit', ['kunjungan_usia_dewasa' => $kunjunganDewasa->id]) }}" class="text-blue-600 hover:text-blue-800">
                                                    {{ $anggota->kelompok_sasaran }}
                                                </a>)
                                            @else
                                                <!-- Jika data kunjungan-usia-dewasa tidak ada, arahkan ke halaman create -->
                                                <a href="{{ route('kunjungan-usia-dewasa.create', ['anggota_keluarga_id' => $anggota->id]) }}" class="text-blue-600 hover:text-blue-800">
                                                    {{ $anggota->kelompok_sasaran }}
                                                </a>)
                                            @endif

                                        @elseif($anggota->kelompok_sasaran === 'TBC')
                                            @php
                                                // Ambil data kunjungan-tbc
                                                $kunjunganTBC = $anggota->kunjunganTBC;
                                            @endphp
                                            {{ $anggota->nama_lengkap }} ({{ $anggota->nik }},
                                            @if($kunjunganTBC)
                                                <!-- Jika data kunjungan-tbc ada, arahkan ke halaman edit -->
                                                <a href="{{ route('kunjungan-tbc.edit', ['kunjungan_tbc' => $kunjunganTBC->id]) }}" class="text-blue-600 hover:text-blue-800">
                                                    {{ $anggota->kelompok_sasaran }}
                                                </a>)
                                            @else
                                                <!-- Jika data kunjungan-tbc tidak ada, arahkan ke halaman create -->
                                                <a href="{{ route('kunjungan-tbc.create', ['anggota_keluarga_id' => $anggota->id]) }}" class="text-blue-600 hover:text-blue-800">
                                                    {{ $anggota->kelompok_sasaran }}
                                                </a>)
                                            @endif

                                        @elseif($anggota->kelompok_sasaran === 'Lansia (≥60 tahun)')
                                            @php
                                                // Ambil data kunjungan-lansia
                                                $kunjunganLansia = $anggota->kunjunganLansia;
                                            @endphp
                                            {{ $anggota->nama_lengkap }} ({{ $anggota->nik }},
                                            @if($kunjunganLansia)
                                                <!-- Jika data kunjungan-lansia ada, arahkan ke halaman edit -->
                                                <a href="{{ route('kunjungan-lansia.edit', $kunjunganLansia->id) }}" class="text-blue-600 hover:text-blue-800">
                                                    {{ $anggota->kelompok_sasaran }}
                                                </a>
                                                                                       
                                            @else
                                                <!-- Jika data kunjungan-lansia tidak ada, arahkan ke halaman create -->
                                                <a href="{{ route('kunjungan-lansia.create', ['anggota_keluarga_id' => $anggota->id]) }}" class="text-blue-600 hover:text-blue-800">
                                                    {{ $anggota->kelompok_sasaran }}
                                                </a>)
                                            @endif
                                        @else
                                            <!-- Jika bukan kelompok sasaran Ibu Hamil, Ibu Bersalin & Nifas, atau Bayi - Balita, tampilkan tanpa tautan -->
                                            {{ $anggota->nama_lengkap }} ({{ $anggota->nik }}, {{ $anggota->kelompok_sasaran }})
                                        @endif
                                        </li>
                                    @endforeach




                                        </ul>
                                    </td>
                                    <td class="px-4 py-2 flex justify-center items-center space-x-2">
                                            <!-- Tombol untuk menampilkan modal detail (ikon kaca pembesar) -->
                                            <!-- Tombol untuk menampilkan modal detail (ikon kaca pembesar) -->
                                            <button class="text-blue-500 hover:text-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 rounded-full p-2" 
                                                    onclick="showKeluargaDetail({{ $keluarga->id }})" title="Lihat Detail Keluarga">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6 sm:w-8 sm:h-8">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a4 4 0 11-8 0 4 4 0 018 0zM21 21l-4.35-4.35" />
                                                </svg>
                                            </button>


                                           <!-- Tombol untuk mengedit keluarga -->
                                            <a href="{{ route('keluarga.edit', $keluarga->id) }}" class="text-yellow-500 hover:text-yellow-700" title="Edit Keluarga">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 4H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 113 3l-9.5 9.5-4 1 1-4 9.5-9.5z" />
                                                </svg>
                                            </a>


                                        <!-- Tombol untuk ikon cetak ke Excel berdasarkan ID -->
                                            <a href="{{ route('keluarga.export', ['id' => $keluarga->id]) }}" class="text-green-500 hover:text-green-700"  title="Cetak ke Excel">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v16a1 1 0 01-1 1H4a1 1 0 01-1-1V4zm10 2v12m-2-2H8m2-4H8m2-4H8m8 8h-2m2-4h-2m2-4h-2" />
                                                </svg>
                                            </a>

                                              <!-- Tombol Hapus -->
                                            <form action="{{ route('keluarga.destroy', ['id' => $keluarga->id]) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:text-red-700" title="Hapus Keluarga">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                    </svg>
                                                </button>
                                            </form>
                                          
                                        </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal untuk menampilkan detail keluarga -->
    <div id="keluargaDetailModal" class="fixed z-10 inset-0 overflow-y-auto hidden">
        <div class="flex items-center justify-center min-h-screen px-4 text-center">
            <div class="bg-white rounded-lg shadow-xl overflow-hidden transform transition-all sm:max-w-lg w-full relative">
                <!-- Tombol Close (X) di sudut kanan atas -->
                <button class="absolute top-2 right-2 text-gray-600 hover:text-gray-900" onclick="closeModal()">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>

                <div class="bg-blue-500 p-4 text-white text-left">
                    <h3 class="text-lg font-semibold" id="modalTitle">Detail Keluarga</h3>
                </div>
                <div class="p-6" id="modalContent">
                    <!-- Konten Detail Keluarga akan diisi di sini oleh AJAX -->
                </div>
                <div class="p-4 text-right">
                    <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="closeModal()">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Import jQuery untuk AJAX -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        // Function untuk menampilkan detail keluarga dalam modal
        function showKeluargaDetail(keluargaId) {
            $.ajax({
                url: '/keluarga/' + keluargaId,  // Route untuk mengambil data keluarga
                type: 'GET',
                success: function(data) {
                    $('#modalContent').html(data); // Isi konten modal dengan data keluarga
                    $('#keluargaDetailModal').removeClass('hidden'); // Tampilkan modal
                },
                error: function() {
                    alert('Gagal mengambil data keluarga');
                }
            });
        }

        // Function untuk menutup modal
        function closeModal() {
            $('#keluargaDetailModal').addClass('hidden');
        }

        // Function untuk mencetak halaman
        function printPage() {
            window.print();
        }
    </script>

<script>
       $(document).ready(function() {
        $('#filterForm').submit(function(e) {
            e.preventDefault(); // Mencegah form dikirim secara default

            let tanggalMulai = $('#tanggalMulai').val();
            let tanggalAkhir = $('#tanggalAkhir').val();

            if (tanggalMulai && tanggalAkhir) {
                $.ajax({
                    url: '{{ route('keluarga.filter') }}',  // Pastikan URL ini sesuai dengan route
                    type: 'GET',
                    data: {
                        tanggal_mulai: tanggalMulai,
                        tanggal_akhir: tanggalAkhir
                    },
                    success: function(data) {
                        $('#keluargaTable tbody').html(data); // Update tabel dengan data baru
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('Error:', textStatus, errorThrown);
                        alert('Gagal mengambil data berdasarkan filter tanggal');
                    }
                });
            } else {
                alert('Silakan pilih Tanggal Mulai dan Tanggal Akhir');
            }
        });
    });

    </script>

</x-app-layout>
