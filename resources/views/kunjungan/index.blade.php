<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Data Kunjungan Ibu Hamil') }}
        </h2>
        <nav class="breadcrumb">
            <ol class="list-reset flex text-sm">
                <li><a href="/dashboard" class="text-blue-600 hover:text-blue-800">Home</a></li>
                <li><span class="mx-2">/</span></li>
                <li class="text-blue-600 font-semibold"><a href="{{ route('kunjungan.index') }}" class="text-blue-600 hover:text-blue-800">Data Kunjungan</a></li>
            </ol>
        </nav>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-lg rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-700 mb-4">Daftar Kunjungan</h3>
                <div class="flex justify-end mb-4">
                    <a href="{{ route('kunjungan.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded shadow">Tambah Kunjungan</a>
                </div>
                <div class="table-responsive">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-500">No</th>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-500">Nama Anggota</th>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-500">Umur</th>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-500">Tanggal Kunjungan</th>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-500">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($kunjungans as $index => $kunjungan)
                                <tr class="hover:bg-gray-50 transition duration-200">
                                    <td class="px-4 py-2 text-sm text-gray-500">{{ $index + 1 }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-700">{{ $kunjungan->anggotaKeluarga->nama_lengkap }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-700">{{ $kunjungan->umur }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-700">{{ $kunjungan->tanggal_kunjungan }}</td>
                                    <td class="px-4 py-2 flex space-x-2">
                                        <a href="{{ route('kunjungan.show', $kunjungan->id) }}" class="text-blue-500 hover:text-blue-700">Lihat</a>
                                        <a href="{{ route('kunjungan.edit', $kunjungan->id) }}" class="text-yellow-500 hover:text-yellow-700">Edit</a>
                                        <form action="{{ route('kunjungan.destroy', $kunjungan->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-700">Hapus</button>
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
</x-app-layout>
