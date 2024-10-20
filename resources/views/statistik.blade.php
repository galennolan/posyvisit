<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Statistik Kategori Keluarga') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Filter Rekapitulasi -->
                    <div class="bg-white p-4 rounded-lg shadow mt-8">
                        <h2 class="font-bold text-2xl mb-4">Filter Rekapitulasi</h2>
                        <form method="GET" action="{{ route('statistik') }}" class="space-y-4">
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                            <!-- Pilihan Kecamatan -->
                            <div class="flex flex-col">
                                <label for="kecamatan" class="block text-sm font-medium text-gray-700">Kecamatan</label>
                                <select id="kecamatan" name="kecamatan" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                    @if(Auth::user()->hasRole('PetugasKesehatan'))
                                        <option value="{{ Auth::user()->kecamatan }}" {{ request('kecamatan') == Auth::user()->kecamatan ? 'selected' : '' }}>
                                            {{ Auth::user()->kecamatan }}
                                        </option>
                                    @else
                                        <option value="all" {{ request('kecamatan') == 'all' ? 'selected' : '' }}>Semua Kecamatan</option>
                                        <option value="Banjarsari" {{ request('kecamatan') == 'Banjarsari' ? 'selected' : '' }}>Banjarsari</option>
                                        <option value="Jebres" {{ request('kecamatan') == 'Jebres' ? 'selected' : '' }}>Jebres</option>
                                        <option value="Laweyan" {{ request('kecamatan') == 'Laweyan' ? 'selected' : '' }}>Laweyan</option>
                                        <option value="Pasar Kliwon" {{ request('kecamatan') == 'Pasar Kliwon' ? 'selected' : '' }}>Pasar Kliwon</option>
                                        <option value="Serengan" {{ request('kecamatan') == 'Serengan' ? 'selected' : '' }}>Serengan</option>
                                    @endif
                                </select>
                            </div>


                            <!-- Pilihan Kelurahan -->
                            <div class="flex flex-col">
                                <label for="kelurahan" class="block text-sm font-medium text-gray-700">Kelurahan</label>
                                <select id="kelurahan" name="kelurahan" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                    <option value="all" {{ request('kelurahan') == 'all' ? 'selected' : '' }}>Semua Kelurahan</option>
                                </select>
                            </div>

                            <!-- Pilihan Posyandu -->
                            <div class="flex flex-col">
                                <label for="posyandu" class="block text-sm font-medium text-gray-700">Posyandu</label>
                                <select id="posyandu" name="posyandu" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                    @if(Auth::user()->hasRole('KetuaPosyandu'))
                                        <option value="{{ Auth::user()->nama_posyandu }}" {{ request('posyandu') == Auth::user()->nama_posyandu ? 'selected' : '' }}>
                                            {{ Auth::user()->nama_posyandu }}
                                        </option>
                                    @else
                                        <option value="all" {{ request('posyandu') == 'all' ? 'selected' : '' }}>Semua Posyandu</option>
                                        @foreach($posyandus as $posyanduOption)
                                            <option value="{{ $posyanduOption }}" {{ request('posyandu') == $posyanduOption ? 'selected' : '' }}>
                                                {{ $posyanduOption }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>

                        </div>

                        <!-- Tombol Filter -->
                        <div class="flex justify-end mt-4">
                            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                                Filter Data
                            </button>
                        </div>
                    </form>

                    </div>

                    <!-- Tampilkan Statistik -->
                    @if(isset($statistik))
                        <div class="mt-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            <!-- Rekapitulasi Keluarga -->
                            <div class="bg-green-100 p-6 rounded-lg shadow-lg text-center">
                            <h2 class="font-bold text-xl mb-2">
                                    <!-- Jika user adalah admin atau memilih kecamatan, tampilkan nama kecamatan -->
                                    @if(Auth::user()->hasRole('admin'))
                                        {{ request('kecamatan') && request('kecamatan') != 'all' ? request('kecamatan') : 'Semua Kecamatan' }}
                                    @elseif(Auth::user()->hasRole('PetugasKesehatan'))
                                        <!-- Jika user adalah PetugasKesehatan, tampilkan kecamatannya -->
                                        {{ Auth::user()->kecamatan }}
                                    @else
                                        <!-- Tampilkan kecamatan yang dipilih -->
                                        {{ request('kecamatan') && request('kecamatan') != 'all' ? request('kecamatan') : 'Semua Kecamatan' }}
                                    @endif
                                </h2>  
                            </div>
                            <div class="bg-teal-100 p-6 rounded-lg shadow-lg text-center">
                                <h2 class="font-bold text-xl mb-2">{{ request('kelurahan') && request('kelurahan') != 'all' ? request('kelurahan') : 'Semua Kelurahan' }}</h2>
                               
                            </div>
                            <div class="bg-orange-100 p-6 rounded-lg shadow-lg text-center">
                                <h2 class="font-bold text-xl mb-2">  <!-- Jika user adalah KetuaPosyandu, tampilkan nama posyandu -->
                                    @if(Auth::user()->hasRole('KetuaPosyandu'))
                                        {{ Auth::user()->nama_posyandu }}
                                    @else
                                        <!-- Tampilkan posyandu yang dipilih -->
                                        {{ request('posyandu') && request('posyandu') != 'all' ? request('posyandu') : 'Semua Posyandu' }}
                                    @endif
                                </h2>
                            </div>

                            <!-- Statistik Jumlah Keluarga dan Anggota Keluarga -->
                            <div class="bg-blue-100 p-6 rounded-lg shadow-lg text-center">
                                <h2 class="font-bold text-xl mb-2">Jumlah Keluarga</h2>
                                <p class="text-5xl font-bold">{{ $statistik['jumlahKeluarga'] }}</p>
                            </div>
                            <div class="bg-purple-100 p-6 rounded-lg shadow-lg text-center">
                                <h2 class="font-bold text-xl mb-2">Jumlah Anggota Keluarga</h2>
                                <p class="text-5xl font-bold">{{ $statistik['jumlahAnggotaKeluarga'] }}</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery dan Script Dinamis untuk Kelurahan -->
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
                kelurahanDropdown.empty().append('<option value="all">Semua Kelurahan</option>');
                
                if (kecamatan && kelurahanOptions[kecamatan]) {
                    kelurahanOptions[kecamatan].forEach(function(kelurahan) {
                        kelurahanDropdown.append('<option value="' + kelurahan + '">' + kelurahan + '</option>');
                    });
                }
            });

            // Menginisialisasi kelurahan jika kecamatan sudah dipilih sebelumnya
            var selectedKecamatan = $('#kecamatan').val();
            if (selectedKecamatan && kelurahanOptions[selectedKecamatan]) {
                var kelurahanDropdown = $('#kelurahan');
                kelurahanDropdown.empty().append('<option value="all">Semua Kelurahan</option>');

                kelurahanOptions[selectedKecamatan].forEach(function(kelurahan) {
                    var isSelected = '{{ request('kelurahan') }}' === kelurahan ? 'selected' : '';
                    kelurahanDropdown.append('<option value="' + kelurahan + '" ' + isSelected + '>' + kelurahan + '</option>');
                });
            }
        });
    </script>
</x-app-layout>
