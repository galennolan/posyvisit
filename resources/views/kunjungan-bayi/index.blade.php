<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Data Kunjungan Bayi') }}
        </h2>
        <nav class="breadcrumb">
            <ol class="list-reset flex text-sm">
                <li><a href="/dashboard" class="text-blue-600 hover:text-blue-800">Home</a></li>
                <li><span class="mx-2">/</span></li>
                <li class="text-blue-600 font-semibold"><a href="{{ route('kunjungan-bayi.index') }}" class="text-blue-600 hover:text-blue-800">Kunjungan Bayi</a></li>
            </ol>
        </nav>
    </x-slot>

    <div class="py-12" x-data="modalHandler()">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-lg rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-700 mb-4">Daftar Kunjungan Bayi</h3>
                
                <!-- Form Pencarian -->
                <form method="GET" action="{{ route('kunjungan-bayi.index') }}" class="mb-4">
                    <div class="flex">
                        <input type="text" name="search" value="{{ request('search') }}" class="border border-gray-300 rounded-md py-2 px-4" placeholder="Cari Tanggal Kunjungan...">
                        <button type="submit" class="ml-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded">Cari</button>
                    </div>
                </form>
                
                <!-- Tabel Daftar Kunjungan Bayi -->
                <div class="table-responsive">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-500">No</th>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-500">Nama</th>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-500">Tanggal Kunjungan</th>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-500">Suhu Tubuh</th>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-500">ASI Eksklusif</th>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-500">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($kunjungan_bayi as $index => $kunjungan)
                                <tr class="hover:bg-gray-50 transition duration-200">
                                    <td class="px-4 py-2 text-sm text-gray-500">{{ $kunjungan_bayi->firstItem() + $index }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-700">{{ $kunjungan->anggotaKeluarga->nama_lengkap }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-700">{{ \Carbon\Carbon::parse($kunjungan->tanggal_kunjungan)->format('d/m/Y') }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-700">{{ $kunjungan->pemantauan_suhu_tubuh }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-700">{{ $kunjungan->asi_eksklusif }}</td>
                                    <td class="px-4 py-2 flex space-x-2">
                                        <!-- Tombol Lihat -->
                                        <button class="text-blue-500 hover:text-blue-700" @click="openModal({{ $kunjungan->id }})">
                                            Lihat
                                        </button>
                                        <a href="{{ route('kunjungan-bayi.edit', $kunjungan->id) }}" class="text-yellow-500 hover:text-yellow-700">Edit</a>
                                        <form action="{{ route('kunjungan-bayi.destroy', $kunjungan->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-700">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-gray-500">Tidak ada data yang ditemukan</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <!-- Link Pagination -->
                    <div class="mt-4">
                        {{ $kunjungan_bayi->appends(request()->input())->links() }}
                    </div>

                    <!-- Modal -->
                    <div 
                        x-show="isOpen" 
                        class="fixed inset-0 flex items-center justify-center bg-gray-500 bg-opacity-75 z-50" 
                        style="display: none;" 
                        @keydown.window.escape="closeModal()"
                    >
                        <div class="bg-white p-6 rounded-lg shadow-lg max-w-lg w-full relative">
                            <!-- Tombol Tutup Modal di Sudut Kanan Atas -->
                            <button 
                                class="absolute top-3 right-3 text-gray-500 hover:text-gray-700" 
                                @click="closeModal()"
                                aria-label="Close"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>

                            <!-- Konten Modal -->
                            <h3 class="text-lg font-semibold text-gray-700 mb-4">Detail Kunjungan Bayi</h3>
                            <div x-html="modalContent"></div>
                        </div>
                    </div>

                    <script>
                        function modalHandler() {
                            return {
                                isOpen: false,
                                modalContent: '',
                                openModal(id) {
                                    this.isOpen = true;
                                    // Menggunakan AJAX untuk mendapatkan data detail kunjungan
                                    fetch(`/kunjungan_bayi/${id}`)
                                        .then(response => response.text())
                                        .then(html => {
                                            this.modalContent = html; // Menampilkan konten di dalam modal
                                        });
                                },
                                closeModal() {
                                    this.isOpen = false;
                                    this.modalContent = ''; // Kosongkan konten modal saat ditutup
                                }
                            };
                        }
                    </script>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
