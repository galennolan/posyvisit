<x-app-layout>
    <x-slot name="header">
        
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Edit Kader Posyandu') }}
            </h2>
            <nav class="breadcrumb">
                <ol class="list-reset flex text-sm"> <!-- Perkecil font dengan text-sm -->
                    <li><a href="/admin/users" class="text-blue-600 hover:text-blue-800">Daftar Kader </a></li>
                    <li><span class="mx-2">/ </span></li>
                    <!-- Tambahkan warna biru pada item yang dikunjungi -->
                    <li class="text-blue-600 font-semibold"> Edit</li> 
                </ol>
            </nav>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Notifikasi berhasil -->
                    @if (session('success'))
                        <div class="bg-green-500 text-white p-4 mb-4 rounded-lg">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Form Edit User -->
                    <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
                        @csrf
                        @method('PUT')

                        <!-- Nama -->
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="mt-1 block w-full rounded-md shadow-sm dark:bg-gray-700 dark:text-gray-300 border-gray-300 dark:border-gray-600 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                            @error('name')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="mt-1 block w-full rounded-md shadow-sm dark:bg-gray-700 dark:text-gray-300 border-gray-300 dark:border-gray-600 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                            @error('email')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Role -->
                        <div class="mb-4">
                            <label for="role" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Role</label>
                            <select name="role" id="role" class="mt-1 block w-full rounded-md shadow-sm dark:bg-gray-700 dark:text-gray-300 border-gray-300 dark:border-gray-600 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                @foreach ($roles as $role)
                                    <option value="{{ $role->name }}" {{ $user->roles->pluck('name')->contains($role->name) ? 'selected' : '' }}>
                                        {{ $role->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('role')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Kecamatan -->
                        <div class="mb-4">
                            <label for="kecamatan" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Kecamatan</label>
                            <select name="kecamatan" id="kecamatan" class="mt-1 block w-full rounded-md shadow-sm dark:bg-gray-700 dark:text-gray-300 border-gray-300 dark:border-gray-600 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                <option value="">Pilih Kecamatan</option>
                                <option value="Banjarsari" {{ old('kecamatan', $user->kecamatan) == 'Banjarsari' ? 'selected' : '' }}>Banjarsari</option>
                                <option value="Jebres" {{ old('kecamatan', $user->kecamatan) == 'Jebres' ? 'selected' : '' }}>Jebres</option>
                                <option value="Laweyan" {{ old('kecamatan', $user->kecamatan) == 'Laweyan' ? 'selected' : '' }}>Laweyan</option>
                                <option value="Pasar Kliwon" {{ old('kecamatan', $user->kecamatan) == 'Pasar Kliwon' ? 'selected' : '' }}>Pasar Kliwon</option>
                                <option value="Serengan" {{ old('kecamatan', $user->kecamatan) == 'Serengan' ? 'selected' : '' }}>Serengan</option>
                            </select>
                            @error('kecamatan')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Kelurahan -->
                        <div class="mb-4">
                            <label for="kelurahan" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Kelurahan</label>
                            <select name="kelurahan" id="kelurahan" class="mt-1 block w-full rounded-md shadow-sm dark:bg-gray-700 dark:text-gray-300 border-gray-300 dark:border-gray-600 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                <option value="">Pilih Kelurahan</option>
                                <!-- Kelurahan akan diisi oleh JavaScript -->
                            </select>
                            @error('kelurahan')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Nama Posyandu -->
                        <div class="mb-4">
                            <label for="nama_posyandu" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Posyandu</label>
                            <input type="text" name="nama_posyandu" id="nama_posyandu" value="{{ old('nama_posyandu', $user->nama_posyandu) }}" class="mt-1 block w-full rounded-md shadow-sm dark:bg-gray-700 dark:text-gray-300 border-gray-300 dark:border-gray-600 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                            @error('nama_posyandu')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Tombol Simpan -->
                        <div class="flex justify-end">
                            <a href="{{ route('admin.users.index') }}" class="bg-red-500 text-white px-4 py-2 rounded-lg mr-2 hover:bg-gray-600">Batal</a>
                            <button type="submit" class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Script untuk dynamic dropdown Kelurahan -->
    <script>
        const kelurahanOptions = {
            'Banjarsari': [
                'Banjarsari', 'Banyuanyar', 'Gilingan', 'Joglo', 'Kadipiro', 'Keprabon', 'Kestalan', 'Ketelan', 'Manahan', 'Mangkubumen', 'Nusukan', 'Punggawan', 'Setabelan', 'Sumber Timuran'
            ],
            'Jebres': [
                'Gandekan', 'Jagalan', 'Jebres', 'Kepatihan Kulon', 'Kepatihan Wetan', 'Mojosongo', 'Pucang Sawit', 'Purwodiningratan', 'Sewu', 'Sudiroprajan', 'Tegalharjo'
            ],
            'Laweyan': [
                'Bumi', 'Jajar', 'Karangasem', 'Kerten', 'Laweyan', 'Pajang', 'Panularan', 'Penumping', 'Purwosari', 'Sondakan', 'Sriwedari'
            ],
            'Pasar Kliwon': [
                'Baluwarti', 'Gajahan', 'Joyosuran', 'Kampung Baru', 'Kauman', 'Kedung Lumbu', 'Mojo', 'Pasar Kliwon', 'Sangkrah', 'Semanggi'
            ],
            'Serengan': [
                'Danukusuman', 'Jayengan', 'Joyotakan', 'Kemlayan', 'Kratonan', 'Serengan', 'Tipes'
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

        // Set Kelurahan saat halaman di-load jika ada kecamatan yang sudah dipilih
        document.addEventListener('DOMContentLoaded', function() {
            const kecamatan = document.getElementById('kecamatan').value;
            const kelurahan = "{{ old('kelurahan', $user->kelurahan) }}"; // Ambil kelurahan yang dipilih user
            if (kecamatan && kelurahanOptions[kecamatan]) {
                const kelurahanSelect = document.getElementById('kelurahan');
                kelurahanOptions[kecamatan].forEach(function(kelurahanName) {
                    const option = document.createElement('option');
                    option.value = kelurahanName;
                    option.textContent = kelurahanName;
                    if (kelurahanName === kelurahan) {
                        option.selected = true;
                    }
                    kelurahanSelect.appendChild(option);
                });
            }
        });
    </script>
</x-app-layout>
