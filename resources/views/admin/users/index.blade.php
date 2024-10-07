<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Daftar Kader Posyandu') }}
        </h2>
        <nav class="breadcrumb">
            <ol class="list-reset flex text-sm">
                <li><a href="/dashboard" class="text-blue-600 hover:text-blue-800">Home </a></li>
                <li><span class="mx-2">/ </span></li>
                <li class="text-blue-600 font-semibold"> Daftar Kader Posyandu</li>
            </ol>
        </nav>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if (session('success'))
                        <div class="bg-green-500 text-white p-4 mb-4 rounded-lg">
                            {{ session('success') }}
                        </div>
                    @endif
                    
                    <!-- Dropdown untuk memilih kecamatan -->
                    <div class="mb-4 flex justify-between items-center">
                    @if(!Auth::user()->hasRole('PetugasKesehatan'))
                        <form action="{{ route('admin.users.filter') }}" method="POST">
                        @csrf <!-- Include CSRF token -->
                            <label for="kecamatan" class="mr-2">Pilih Kecamatan:</label>
                            <select name="kecamatan" id="kecamatan" class="border rounded p-2 w-40">
                                <option value="">--- Pilih Kec ---</option>
                                <!-- Tambahkan opsi kecamatan sesuai dengan yang ada di database -->
                                <option value="Pasar Kliwon" {{ (isset($kecamatan) && $kecamatan == 'Pasar Kliwon') ? 'selected' : '' }}>Pasar Kliwon</option>
                                <option value="Banjarsari" {{ (isset($kecamatan) && $kecamatan == 'Banjarsari') ? 'selected' : '' }}>Banjarsari</option>
                                <option value="Laweyan" {{ (isset($kecamatan) && $kecamatan == 'Laweyan') ? 'selected' : '' }}>Laweyan</option>
                                <option value="Serengan" {{ (isset($kecamatan) && $kecamatan == 'Serengan') ? 'selected' : '' }}>Serengan</option>
                               
                                <option value="Jebres" {{ (isset($kecamatan) && $kecamatan == 'Jebres') ? 'selected' : '' }}>Jebres</option>
                            </select>
                            <button type="submit" class="bg-blue-500 text-white rounded p-2 ml-2">Tampilkan</button>
                        </form>
                        @endif
                        <!-- Bagian kanan: Tombol Tambah User -->
                        <a href="{{ route('admin.users.create') }}" class="bg-green-500 text-white rounded p-2 hover:bg-green-700">
                            Tambah User
                        </a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full table-auto divide-y divide-gray-200 dark:divide-gray-700">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 bg-gray-50 dark:bg-gray-900 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        Nama
                                    </th>
                                    <th class="px-6 py-3 bg-gray-50 dark:bg-gray-900 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        Email
                                    </th>
                                    <th class="px-6 py-3 bg-gray-50 dark:bg-gray-900 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        Asal
                                    </th>
                                    <th class="px-6 py-3 bg-gray-50 dark:bg-gray-900 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        Kelurahan
                                    </th>
                                    <th class="px-6 py-3 bg-gray-50 dark:bg-gray-900 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        Nama Posyandu
                                    </th>
                                    <th class="px-6 py-3 bg-gray-50 dark:bg-gray-900 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach ($users as $user)
                            @php
                                // Tetapkan warna latar belakang berdasarkan kecamatan
                                $bgColor = match($user->kecamatan) {
                                    'Banjarsari' => 'bg-green-100 dark:bg-green-800', // Hijau
                                    'Jebres' => 'bg-yellow-100 dark:bg-yellow-800', // Kuning
                                    'Laweyan' => 'bg-purple-100 dark:bg-purple-800', // Ungu
                                    'Pasar Kliwon' => 'bg-cyan-100 dark:bg-cyan-800', // Biru
                                    'Serengan' => 'bg-red-100 dark:bg-red-800', // Merah
                                    default => 'bg-gray-100 dark:bg-gray-700', // Default jika tidak ada yang cocok
                                };
                            @endphp

                            <tr class="{{ $bgColor }}">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900 dark:text-gray-300">{{ $user->name }}</div>
                                    <div class="text-xs text-gray-600 dark:text-gray-400">
                                        {{ $user->roles->pluck('name')->join(', ') }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900 dark:text-gray-300">{{ $user->email }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900 dark:text-gray-300">Kec.{{ $user->kecamatan }}</div>
                                    <div class="text-xs text-gray-600 dark:text-gray-400">
                                        Kel. {{  $user->kelurahan }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900 dark:text-gray-300">{{ $user->kelurahan }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900 dark:text-gray-300">{{ $user->nama_posyandu }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="{{ route('admin.users.edit', $user->id) }}" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900">Edit</a>
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 dark:text-red-400 hover:text-red-900 ml-4" onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                            </tbody>
                        </table>
                    </div> <!-- End of overflow-x-auto -->
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
