<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Formulir Pendaftaran Pengguna') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @if ($errors->any())
                        <div class="bg-red-500 text-white p-4 mb-4 rounded-lg">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.users.store') }}" method="POST">
                        @csrf

                        <!-- Input Nama -->
                        <div class="mb-6">
                            <label for="name" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Nama</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" class="border border-gray-300 rounded-lg p-3 w-full focus:outline-none focus:ring focus:ring-blue-500" required>
                        </div>

                        <!-- Pilih Role -->
                        <div class="mb-6">
                            <label for="role" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Pilih Role</label>
                            <select name="role" id="role" class="border border-gray-300 rounded-lg p-3 w-full focus:outline-none focus:ring focus:ring-blue-500" required>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->name }}">{{ ucfirst($role->name) }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Input Kecamatan -->
                        <div class="mb-6">
                            <label for="kecamatan" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Kecamatan</label>
                            <select name="kecamatan" id="kecamatan" class="border border-gray-300 rounded-lg p-3 w-full focus:outline-none focus:ring focus:ring-blue-500" required>
                                <option value="">Pilih Kecamatan</option>
                                <option value="Banjarsari">Banjarsari</option>
                                <option value="Jebres">Jebres</option>
                                <option value="Laweyan">Laweyan</option>
                                <option value="Pasar Kliwon">Pasar Kliwon</option>
                                <option value="Serengan">Serengan</option>
                            </select>
                        </div>

                        <!-- Input Kelurahan -->
                        <div class="mb-6">
                            <label for="kelurahan" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Kelurahan</label>
                            <select name="kelurahan" id="kelurahan" class="border border-gray-300 rounded-lg p-3 w-full focus:outline-none focus:ring focus:ring-blue-500" required>
                                <option value="">Pilih Kelurahan</option>
                            </select>
                        </div>

                        <!-- Input Nama Posyandu -->
                        <div class="mb-6">
                            <label for="nama_posyandu" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Nama Posyandu</label>
                            <input type="text" name="nama_posyandu" id="nama_posyandu" value="{{ old('nama_posyandu') }}" class="border border-gray-300 rounded-lg p-3 w-full focus:outline-none focus:ring focus:ring-blue-500" required>
                        </div>

                        <!-- Input Email -->
                        <div class="mb-6">
                            <label for="email" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Email</label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" class="border border-gray-300 rounded-lg p-3 w-full focus:outline-none focus:ring focus:ring-blue-500" required>
                        </div>

                        <!-- Input Password -->
                        <div class="mb-6">
                            <label for="password" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Password</label>
                            <input type="password" name="password" id="password" class="border border-gray-300 rounded-lg p-3 w-full focus:outline-none focus:ring focus:ring-blue-500" required>
                        </div>

                        <!-- Konfirmasi Password -->
                        <div class="mb-6">
                            <label for="password_confirmation" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="border border-gray-300 rounded-lg p-3 w-full focus:outline-none focus:ring focus:ring-blue-500" required>
                        </div>

                        <!-- Submit Button -->
                        <div>
                            <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 transition duration-200">Buat User</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        const kelurahanOptions = {
            'Banjarsari': [
                'Banjarsari',
                'Banyuanyar',
                'Gilingan',
                'Joglo',
                'Kadipiro',
                'Keprabon',
                'Kestalan',
                'Ketelan',
                'Manahan',
                'Mangkubumen',
                'Nusukan',
                'Punggawan',
                'Setabelan',
                'Sumber Timuran'
            ],
            'Jebres': [
                'Gandekan',
                'Jagalan',
                'Jebres',
                'Kepatihan Kulon',
                'Kepatihan Wetan',
                'Mojosongo',
                'Pucang Sawit',
                'Purwodiningratan',
                'Sewu',
                'Sudiroprajan',
                'Tegalharjo'
            ],
            'Laweyan': [
                'Bumi',
                'Jajar',
                'Karangasem',
                'Kerten',
                'Laweyan',
                'Pajang',
                'Panularan',
                'Penumping',
                'Purwosari',
                'Sondakan',
                'Sriwedari'
            ],
            'Pasar Kliwon': [
                'Baluwarti',
                'Gajahan',
                'Joyosuran',
                'Kampung Baru',
                'Kauman',
                'Kedung Lumbu',
                'Mojo',
                'Pasar Kliwon',
                'Sangkrah',
                'Semanggi'
            ],
            'Serengan': [
                'Danukusuman',
                'Jayengan',
                'Joyotakan',
                'Kemlayan',
                'Kratonan',
                'Serengan',
                'Tipes'
            ]
        };

        document.getElementById('kecamatan').addEventListener('change', function() {
            const kelurahanSelect = document.getElementById('kelurahan');
            kelurahanSelect.innerHTML = '<option value="">Pilih Kelurahan</option>'; // Clear existing options
            const selectedKecamatan = this.value;
            if (kelurahanOptions[selectedKecamatan]) {
                kelurahanOptions[selectedKecamatan].forEach(function(kelurahan) {
                    const option = document.createElement('option');
                    option.value = kelurahan;
                    option.textContent = kelurahan;
                    kelurahanSelect.appendChild(option);
                });
            }
        });
    </script>
</x-app-layout>
