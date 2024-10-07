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
                    <div class="mb-4">
                        <form action="{{ route('admin.users.filter') }}" method="POST">
                        @csrf <!-- Include CSRF token -->
                            <label for="kecamatan" class="mr-2">Pilih Kader Posyandu dari Kecamatan:</label>
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
                                        Role
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
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900 dark:text-gray-300">{{ $user->name }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900 dark:text-gray-300">{{ $user->email }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900 dark:text-gray-300">{{ $user->roles->pluck('name')->join(', ') }}</div>
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
