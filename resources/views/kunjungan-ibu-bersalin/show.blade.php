<div class="text-sm">
    <p><strong>Nama Ibu:</strong> {{ $kunjungan->nama_ibu }}</p>
    <p><strong>Umur Ibu:</strong> {{ $kunjungan->umur_ibu }} tahun</p>
    <p><strong>Tanggal Persalinan:</strong> {{ \Carbon\Carbon::parse($kunjungan->tanggal_persalinan)->format('d/m/Y') }}</p>
    <p><strong>Usia Kehamilan Saat Persalinan:</strong> {{ $kunjungan->usia_kehamilan_saat_persalinan }} minggu</p>
    <p><strong>Kelahiran Anak Ke:</strong> {{ $kunjungan->kelahiran_anak_ke }}</p>
    <p><strong>Pukul Persalinan:</strong> {{ $kunjungan->pukul_persalinan }}</p>
    <p><strong>Penolong Persalinan:</strong> {{ $kunjungan->penolong_persalinan }}</p>
    <p><strong>Tempat Persalinan:</strong> {{ $kunjungan->tempat_persalinan }}</p>
    <p><strong>Keadaan Ibu:</strong> {{ $kunjungan->keadaan_ibu }}</p>
    <p><strong>Inisiasi Menyusu Dini:</strong> {{ $kunjungan->inisiasi_menyusu_dini ? 'Ya' : 'Tidak' }}</p>
</div>
