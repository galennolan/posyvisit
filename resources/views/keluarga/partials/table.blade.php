<tbody class="bg-white divide-y divide-gray-200">
    @foreach($keluargas as $index => $keluarga)
        <tr class="hover:bg-gray-50 transition duration-200">
            <td class="px-4 py-2 text-sm text-gray-500">{{ $index + 1 }}</td>
            <td class="px-4 py-2 text-sm text-gray-700">
                @php
                    $anggota = $keluarga->anggotaKeluarga->firstWhere('hubungan_kk', 1);
                @endphp
                {{ $anggota ? $anggota->nama_lengkap : '-' }}
            </td>
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
                <button class="text-blue-500 hover:text-blue-700" onclick="showKeluargaDetail({{ $keluarga->id }})">
                    <!-- Icon detail -->
                </button>
                <a href="{{ route('keluarga.edit', $keluarga->id) }}" class="text-yellow-500 hover:text-yellow-700" title="Edit Keluarga">
                    <!-- Icon edit -->
                </a>
                <a href="{{ route('keluarga.export', ['id' => $keluarga->id]) }}" class="text-blue-500 hover:text-blue-700" title="Cetak ke Excel">
                    <!-- Icon print -->
                </a>
                <form action="{{ route('keluarga.destroy', ['id' => $keluarga->id]) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-500 hover:text-red-700" title="Hapus Keluarga">
                        <!-- Icon delete -->
                    </button>
                </form>
            </td>
        </tr>
    @endforeach
</tbody>
