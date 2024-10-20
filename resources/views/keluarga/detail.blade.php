<div class="text-left text-sm md:text-base">    
    <p><strong>Tanggal Pengumpulan Data:</strong> {{ \Carbon\Carbon::parse($keluarga->tanggal_pengumpulan_data)->format('d/m/Y') }}</p>
    <p><strong>Alamat:</strong> {{ $keluarga->alamat }}</p>
    <p><strong>No Handphone:</strong> {{ $keluarga->no_handphone }}</p>
    <p><strong>Puskesmas:</strong> {{ $keluarga->puskesmas }}</p>
    <p><strong>Kecamatan:</strong> {{ $keluarga->kecamatan }}</p>
    <p><strong>Kelurahan:</strong> {{ $keluarga->kelurahan }}</p>
    <p><strong>Pustu/Posyandu Prima:</strong> {{ $keluarga->pustu }}</p>
    <p><strong>JKN:</strong> {{ $keluarga->jkn }}</p>
    <p><strong>Sarana Air Bersih:</strong> {{ $keluarga->sarana_air_bersih }}</p>
    <p><strong>Jenis Sumber Air:</strong> {{ $keluarga->jenis_sumber_air ?? 'Tidak Tersedia' }}</p>
    <p><strong>Jamban Keluarga:</strong> {{ $keluarga->jamban_keluarga }}</p>
    <p><strong>Jenis Jamban:</strong> {{ $keluarga->jenis_jamban ?? 'Tidak Tersedia' }}</p>
    <p><strong>Ventilasi:</strong> {{ $keluarga->ventilasi }}</p>
    <p><strong>Gangguan Jiwa:</strong> {{ $keluarga->gangguan_jiwa }}</p>
    <p><strong>Terdiagnosis Penyakit (TBC, Hipertensi, Diabetes Melitus):</strong> {{ $keluarga->terdiagnosis_penyakit }}</p>


    <h3 class="text-lg font-semibold mt-4">Anggota Keluarga</h3>
    <ul class="list-disc pl-5 text-xs"> <!-- Perkecil ukuran font dengan text-sm -->
        @foreach($keluarga->anggotaKeluarga as $anggota)
            <li class="mb-2">
                <span><strong>Nama:</strong> {{ $anggota->nama_lengkap }}, </span>
                <span><strong>NIK:</strong> {{ $anggota->nik }}, </span>
                <span><strong>Tanggal Lahir:</strong> {{ \Carbon\Carbon::parse($anggota->tanggal_lahir)->format('d/m/Y') }}, </span>
                <span><strong>Jenis Kelamin:</strong> {{ $anggota->jenis_kelamin }}, </span>
                <span><strong>Hubungan KK:</strong> 
                    @switch($anggota->hubungan_kk)
                        @case(1)
                            Kepala Keluarga
                            @break
                        @case(2)
                            Suami
                            @break
                        @case(3)
                            Istri
                            @break
                        @case(4)
                            Anak
                            @break
                        @case(5)
                            Menantu
                            @break
                        @case(6)
                            Cucu
                            @break
                        @case(7)
                            Orang Tua
                            @break
                        @case(8)
                            Mertua
                            @break
                        @case(9)
                            Anggota Lain
                            @break
                    @endswitch
                    , 
                </span>
                <span><strong>Status Perkawinan:</strong> 
                    @switch($anggota->status_perkawinan)
                        @case(1)
                            Belum Menikah
                            @break
                        @case(2)
                            Menikah
                            @break
                        @case(3)
                            Cerai Hidup
                            @break
                        @case(4)
                            Cerai Mati
                            @break
                    @endswitch
                    , 
                </span>
                <span><strong>Pendidikan Terakhir:</strong> 
                    @switch($anggota->pendidikan_terakhir)
                        @case(1)
                            Tidak Sekolah
                            @break
                        @case(2)
                            SD
                            @break
                        @case(3)
                            SMP
                            @break
                        @case(4)
                            SMA
                            @break
                        @case(5)
                            Diploma
                            @break
                        @case(6)
                            Sarjana
                            @break
                    @endswitch
                    , 
                </span>
                <span><strong>Pekerjaan:</strong> 
                    @switch($anggota->pekerjaan)
                        @case(1)
                            Tidak Bekerja
                            @break
                        @case(2)
                            Petani
                            @break
                        @case(3)
                            PNS
                            @break
                        @case(4)
                            Buruh
                            @break
                        @case(5)
                            Wiraswasta
                            @break
                        @case(6)
                            Pelajar
                            @break
                        @case(7)
                            Lainnya
                            @break
                    @endswitch
                    , 
                </span>
                <span><strong>Kelompok Sasaran:</strong> {{ $anggota->kelompok_sasaran }}</span>
            </li>
        @endforeach
    </ul>
</div>
