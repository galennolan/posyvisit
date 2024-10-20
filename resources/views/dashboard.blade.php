<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100 flex flex-col space-y-4">
                <h1 class="text-2xl font-bold">Dashboard Posyandu</h1>
                
                @if(Auth::user()->hasRole('Kader') && $namaPosyandu)
                    <div class="bg-yellow-100 p-4 rounded-lg shadow">
                        <h2 class="font-bold">Nama Posyandu</h2>
                        <p class="text-lg">{{ $namaPosyandu }}</p>
                    </div>
                @endif
                
                @if(Auth::user()->hasRole('PetugasKesehatan') && $kecamatan)
                    <div class="bg-yellow-100 p-4 rounded-lg shadow">
                        <h2 class="font-bold">Kecamatan</h2>
                        <p class="text-lg">{{ $kecamatan }}</p>
                    </div>
                @endif
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <!-- Kartu Jumlah Keluarga -->
                    <div class="bg-green-100 p-4 rounded-lg shadow">
                        <h2 class="font-bold">Jumlah Keluarga</h2>
                        <p class="text-3xl">{{ $jumlahKeluarga }}</p>
                        <p class="text-lg">{{ number_format($persentaseKeluarga, 2) }}%</p>
                    </div>

                    <!-- Kartu Jumlah Anggota Keluarga -->
                    <div class="bg-blue-100 p-4 rounded-lg shadow">
                        <h2 class="font-bold">Jumlah Anggota Keluarga</h2>
                        <p class="text-3xl">{{ $jumlahAnggotaKeluarga }}</p>
                        <p class="text-lg">{{ number_format($persentaseAnggotaKeluarga, 2) }}%</p>
                    </div>

                    <!-- Dashboard dengan Kategori Kelompok Sasaran -->

                    <div class="grid grid-cols-3 gap-4">
                        <!-- Ibu Hamil -->
                        <div class="bg-blue-100 p-4 rounded-lg shadow">
                            <h2 class="font-bold">Ibu Hamil</h2>
                            <p class="text-3xl">{{ $jumlahIbuHamil }}</p>
                            <p class="text-lg">{{ number_format($persentaseIbuHamil, 2) }}%</p>
                        </div>

                        <!-- Ibu Bersalin & Nifas -->
                        <div class="bg-yellow-100 p-4 rounded-lg shadow">
                            <h2 class="font-bold">Ibu Bersalin & Nifas</h2>
                            <p class="text-3xl">{{ $jumlahIbuBersalinNifas }}</p>
                            <p class="text-lg">{{ number_format($persentaseIbuBersalinNifas, 2) }}%</p>
                        </div>

                        <!-- Bayi - Balita (0-6 tahun) -->
                        <div class="bg-green-100 p-4 rounded-lg shadow">
                            <h2 class="font-bold">Bayi - Balita (0-6 tahun)</h2>
                            <p class="text-3xl">{{ $jumlahBayiBalita }}</p>
                            <p class="text-lg">{{ number_format($persentaseBayiBalita, 2) }}%</p>
                        </div>

                        <!-- Usia Sekolah & Remaja (≥6 - <18 tahun) -->
                        <div class="bg-purple-100 p-4 rounded-lg shadow">
                            <h2 class="font-bold">Usia Sekolah & Remaja (≥6 - <18 tahun)</h2>
                            <p class="text-3xl">{{ $jumlahUsiaSekolahRemaja }}</p>
                            <p class="text-lg">{{ number_format($persentaseUsiaSekolahRemaja, 2) }}%</p>
                        </div>

                        <!-- Usia Dewasa (≥18-59 tahun) -->
                        <div class="bg-pink-100 p-4 rounded-lg shadow">
                            <h2 class="font-bold">Usia Dewasa (≥18-59 tahun)</h2>
                            <p class="text-3xl">{{ $jumlahUsiaDewasa }}</p>
                            <p class="text-lg">{{ number_format($persentaseUsiaDewasa, 2) }}%</p>
                        </div>

                        <!-- Lansia (≥60 tahun) -->
                        <div class="bg-red-100 p-4 rounded-lg shadow">
                            <h2 class="font-bold">Lansia (≥60 tahun)</h2>
                            <p class="text-3xl">{{ $jumlahLansia }}</p>
                            <p class="text-lg">{{ number_format($persentaseLansia, 2) }}%</p>
                        </div>
                    </div>


             
                </div>
            </div>
        </div>
    </div>
</div>


</x-app-layout>
