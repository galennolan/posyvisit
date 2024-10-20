<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard Posyandu') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 space-y-4">
                    <!-- Informasi Posyandu atau Kecamatan -->
                    @if(Auth::user()->hasRole('Kader'))
                        <div class="bg-yellow-100 p-4 rounded-lg shadow">
                            <h2 class="font-bold">Posyandu: {{ Auth::user()->nama_posyandu }}</h2>
                        </div>
                    @endif

                    @if(Auth::user()->hasRole('PetugasKesehatan'))
                        <div class="bg-yellow-100 p-4 rounded-lg shadow">
                            <h2 class="font-bold">Kecamatan: {{ Auth::user()->kecamatan }}</h2>
                        </div>
                    @endif

                    <!-- Statistik Utama: Baris Pertama -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <!-- Jumlah Keluarga -->
                        <div class="bg-green-100 p-6 rounded-lg shadow-lg text-center">
                            <h2 class="font-bold text-3xl">Jumlah Keluarga</h2>
                            <p class="text-6xl font-bold">{{ $jumlahKeluarga }}</p>
                            <p class="text-lg">{{ number_format($persentaseKeluarga) }}% dari total</p>
                        </div>

                        <!-- Jumlah Anggota Keluarga -->
                        <div class="bg-blue-100 p-6 rounded-lg shadow-lg text-center">
                            <h2 class="font-bold text-3xl">Jumlah Anggota Keluarga</h2>
                            <p class="text-6xl font-bold">{{ $jumlahAnggotaKeluarga }}</p>
                            <p class="text-lg">{{ number_format($persentaseAnggotaKeluarga) }}% dari total</p>
                        </div>
                    </div>
                    <!-- Semua Kategori dalam Satu Card -->
                    <div class="bg-orange-100 p-4 rounded-lg shadow text-center">
                        <h2 class="font-bold text-xl mb-2">Statistik Kategori Keluarga</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-2 mt-2">
                            <!-- Ibu Bersalin & Nifas -->
                            <div class="text-sm">
                                <h3 class="font-semibold bg-yellow-300 text-black py-1 px-2 rounded-md inline-block">Ibu Bersalin & Nifas</h3>
                                <p class="text-2xl font-bold">{{ $jumlahIbuBersalinNifas }}</p>
                                <p class="text-base">{{ number_format($persentaseIbuBersalinNifas) }}% dari total</p>
                            </div>
                            
                            <!-- Bayi - Balita (0-6 tahun) -->
                            <div class="text-sm">
                                <h3 class="font-semibold bg-yellow-300 text-black py-1 px-2 rounded-md inline-block">Bayi - Balita (0-6 tahun)</h3>
                                <p class="text-2xl font-bold">{{ $jumlahBayiBalita }}</p>
                                <p class="text-base">{{ number_format($persentaseBayiBalita) }}% dari total</p>
                            </div>
                            
                            <!-- Bayi Apras (≥6 - 71 bulan) -->
                            <div class="text-sm">
                                <h3 class="font-semibold bg-yellow-300 text-black py-1 px-2 rounded-md inline-block">Bayi Apras (≥6 - 71 bulan)</h3>
                                <p class="text-2xl font-bold">{{ $jumlahBayiApras }}</p>
                                <p class="text-base">{{ number_format($persentaseBayiApras) }}% dari total</p>
                            </div>
                            
                            <!-- Usia Sekolah & Remaja (≥6 - <18 tahun) -->
                            <div class="text-sm">
                                <h3 class="font-semibold bg-yellow-300 text-black py-1 px-2 rounded-md inline-block">Usia Sekolah & Remaja</h3>
                                <p class="text-2xl font-bold">{{ $jumlahUsiaSekolahRemaja }}</p>
                                <p class="text-base">{{ number_format($persentaseUsiaSekolahRemaja) }}% dari total</p>
                            </div>
                            
                            <!-- Usia Dewasa (≥18-59 tahun) -->
                            <div class="text-sm">
                                <h3 class="font-semibold bg-yellow-300 text-black py-1 px-2 rounded-md inline-block">Usia Dewasa (≥18-59 tahun)</h3>
                                <p class="text-2xl font-bold">{{ $jumlahUsiaDewasa }}</p>
                                <p class="text-base">{{ number_format($persentaseUsiaDewasa) }}% dari total</p>
                            </div>
                            
                            <!-- Lansia (≥60 tahun) -->
                            <div class="text-sm">
                                 <h3 class="font-semibold bg-yellow-300 text-black py-1 px-2 rounded-md inline-block">Lansia (≥60 tahun)</h3>
                                <p class="text-2xl font-bold">{{ $jumlahLansia }}</p>
                                <p class="text-base">{{ number_format($persentaseLansia) }}% dari total</p>
                            </div>

                            <!-- Ibu Hamil -->
                            <div class="text-sm">
                                 <h3 class="font-semibold bg-yellow-300 text-black py-1 px-2 rounded-md inline-block">Ibu Hamil</h3>
                                <p class="text-2xl font-bold">{{ $jumlahIbuHamil }}</p>
                                <p class="text-base">{{ number_format($persentaseIbuHamil) }}% dari total</p>
                            </div>
                        </div>
                    </div>

                   
            </div>
        </div>
    </div>
</x-app-layout>
