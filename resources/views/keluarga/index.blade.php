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
            
                <div class="table-responsive">
                    <table id="keluargaTable" class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-500">No</th>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-500">Nama Kepala Keluarga</th>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-500">Alamat</th>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-500">No Handphone</th>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-500">Anggota Keluarga</th>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-500">Aksi</th> <!-- Tombol Aksi -->
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($keluargas as $index => $keluarga)
                                <tr class="hover:bg-gray-50 transition duration-200">
                                    <td class="px-4 py-2 text-sm text-gray-500">{{ $index + 1 }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-700">{{ $keluarga->anggotaKeluarga->first()->nama_lengkap ?? '-' }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-700">{{ \Illuminate\Support\Str::limit($keluarga->alamat, 35, '...') }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-700">{{ $keluarga->no_handphone }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-700">
                                        <ul class="list-disc pl-5">
                                            @foreach($keluarga->anggotaKeluarga as $anggota)
                                                <li>{{ $anggota->nama_lengkap }} ({{ $anggota->nik }})</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td class="px-4 py-2 flex justify-center items-center space-x-2">
                                            <!-- Tombol untuk menampilkan modal detail (ikon kaca pembesar) -->
                                            <button class="text-blue-500 hover:text-blue-700" onclick="showKeluargaDetail({{ $keluarga->id }})">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a4 4 0 11-8 0 4 4 0 018 0zM21 21l-4.35-4.35" />
                                                </svg>
                                            </button>

                                           <!-- Tombol untuk ikon cetak ke Excel berdasarkan ID -->
                                            <a href="{{ route('keluarga.export', ['id' => $keluarga->id]) }}" class="text-blue-500 hover:text-blue-700" title="Cetak ke Excel">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7V4a2 2 0 00-2-2H7a2 2 0 00-2 2v3M5 10h14a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2zm4 5h6" />
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


</x-app-layout>
