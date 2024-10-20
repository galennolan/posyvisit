<div class="text-left text-sm max-h-screen overflow-auto">
    <!-- Informasi Dasar dalam tiga kolom -->
    <h3 class="text-lg font-semibold mt-4">Informasi Dasar</h3>
    <div class="grid grid-cols-3 gap-4">
        <div>
            <p><strong>Nama:</strong> {{ $kunjungan->anggotaKeluarga->nama_lengkap }}</p>
            <p><strong>Kehamilan Ke:</strong> {{ $kunjungan->kehamilan_ke }}</p>
            <p><strong>Jarak Kehamilan:</strong> {{ $kunjungan->jarak_kehamilan ?? 'blm ad' }}</p>
        </div>
        <div>
            <p><strong>Umur:</strong> {{ $kunjungan->umur }} tahun</p>
            <p><strong>Waktu Kunjungan:</strong> {{ \Carbon\Carbon::parse($kunjungan->waktu_kunjungan)->format('d/m/Y H:i') }}</p>
            <p><strong>Tanggal Kunjungan:</strong> {{ \Carbon\Carbon::parse($kunjungan->tanggal_kunjungan)->format('d/m/Y') }}</p>
        </div>
        <div>
            <p><strong>Suhu Tubuh:</strong> {{ $kunjungan->suhu_tubuh ?? 'blm ad' }} °C</p>
            <p><strong>Buku KIA:</strong> {{ $kunjungan->buku_kia }}</p>
        </div>
    </div>

    <!-- Data Kunjungan K1-K6 dalam tiga kolom -->
    <h3 class="text-lg font-semibold mt-4">Data Kunjungan K1-K6</h3>
    <div class="grid grid-cols-3 gap-4">
        @foreach(['k1', 'k2', 'k3', 'k4', 'k5', 'k6'] as $kunjungan_ke)
            @if ($kunjungan->$kunjungan_ke)
                <div class="mb-4">
                    <h4 class="font-semibold">{{ strtoupper($kunjungan_ke) }}:</h4>
                    <p><strong>Tanggal:</strong> 
                        {{ $kunjungan->$kunjungan_ke['tanggal'] ? \Carbon\Carbon::parse($kunjungan->$kunjungan_ke['tanggal'])->format('d/m/Y') : 'blm ad' }}
                    </p>
                    <p><strong>Tempat:</strong> {{ $kunjungan->$kunjungan_ke['tempat'] ?? 'blm ad' }}</p>
                    <p><strong>Petugas:</strong> {{ $kunjungan->$kunjungan_ke['petugas'] ?? 'blm ad' }}</p>
                </div>
            @endif
        @endforeach
    </div>
    
    <!-- Data Tambahan dan Kelas Ibu Hamil, Skrining, Edukasi dalam tiga kolom -->
    <h3 class="text-lg font-semibold mt-4">Data Tambahan dan Lainnya</h3>
    <div class="grid grid-cols-3 gap-4">
        <!-- Kolom Kiri: Data Tambahan -->
        <div>
            <h4 class="font-semibold">Data Tambahan</h4>
            <p><strong>Isi Piringku:</strong> {{ $kunjungan->isi_piringku }}</p>
            <p><strong>TTD:</strong> {{ $kunjungan->ttd }}</p>
            <p><strong>TTD Dikonsumsi:</strong> {{ $kunjungan->ttd_dikonsumsi ?? 'blm ad' }}</p>
            <p><strong>LILA:</strong> {{ $kunjungan->lila ?? 'blm ad' }}</p>
            <p><strong>PMT Bumil KEK:</strong> {{ $kunjungan->pmt_bumil_kek ?? 'blm ad' }}</p>
        </div>

        <!-- Kolom Tengah: Kelas Ibu Hamil -->
        <div>
            <h4 class="font-semibold">Kelas Ibu Hamil</h4>
            @if ($kunjungan->kelas_ibu_hamil)
                @php $kelas = json_decode($kunjungan->kelas_ibu_hamil, true); @endphp
                <ul class="list-disc pl-5 text-xs">
                    <li><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($kelas['tanggal'])->format('d/m/Y') ?? 'blm ad' }}</li>
                    <li><strong>Tempat:</strong> {{ $kelas['tempat'] ?? 'blm ad' }}</li>
                    <li><strong>Pendamping:</strong> {{ $kelas['pendamping'] ?? 'blm ad' }}</li>
                </ul>
            @else
                <p>Tidak ada data kelas ibu hamil.</p>
            @endif
        </div>

        <!-- Kolom Kanan: Skrining Kesehatan Jiwa dan Edukasi -->
        <div>
            <h4 class="font-semibold">Skrining Kesehatan Jiwa</h4>
            @if ($kunjungan->skrining_jiwa)
                @php $skrining = json_decode($kunjungan->skrining_jiwa, true); @endphp
                <ul class="list-disc pl-5 text-xs">
                    <li><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($skrining['tanggal'])->format('d/m/Y') ?? 'blm ad' }}</li>
                    <li><strong>Tempat:</strong> {{ $skrining['tempat'] ?? 'blm ad' }}</li>
                    <li><strong>Petugas:</strong> {{ $skrining['petugas'] ?? 'blm ad' }}</li>
                </ul>
            @else
                <p>Tidak ada data skrining kesehatan jiwa.</p>
            @endif

            <h4 class="font-semibold mt-4">Edukasi</h4>
            @if ($kunjungan->edukasi)
                @php $edukasi = json_decode($kunjungan->edukasi, true); @endphp
                <ul class="list-disc pl-5 text-xs">
                    <li><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($edukasi['tanggal'])->format('d/m/Y') ?? 'blm ad' }}</li>
                    <li><strong>Materi:</strong> {{ $edukasi['materi'] ?? 'blm ad' }}</li>
                </ul>
            @else
                <p>Tidak ada data edukasi.</p>
            @endif
        </div>
    </div>
</div>
