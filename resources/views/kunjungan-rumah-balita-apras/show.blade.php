<div class="text-sm">
            <p><strong>Nama Ibu Balita:</strong> {{ $kunjungan->anggotaKeluarga->nama_lengkap}}</p>
            <p><strong>Tanggal Kunjungan:</strong> {{ \Carbon\Carbon::parse($kunjungan->tanggal)->format('d/m/Y') }}</p>
            <p><strong>Suhu Tubuh:</strong> {{ $kunjungan->suhu_tubuh }} °C</p>
            <p><strong>Ada Buku KIA:</strong> {{ $kunjungan->ada_buku_kia ? 'Ya' : 'Tidak' }}</p>
            <p><strong>Tanggal Terakhir Menimbang/Mengukur:</strong> {{ \Carbon\Carbon::parse($kunjungan->tanggal_terakhir_menimbang_mengukur)->format('d/m/Y') }}</p>
            <p><strong>Hasil Penimbangan:</strong> {{ $kunjungan->hasil_penimbangan }}</p>
            <p><strong>BB (Berat Badan):</strong> {{ $kunjungan->bb }} kg</p>
            <p><strong>PB/TB (Panjang/Tinggi Badan):</strong> {{ $kunjungan->pb_tb }} cm</p>
            <p><strong>LK (Lingkar Kepala):</strong> {{ $kunjungan->lk }} cm</p>
            <p><strong>Makanan Pokok:</strong> {{ $kunjungan->makanan_pokok ? 'Ya' : 'Tidak' }}</p>
            <p><strong>Makanan Sumber Protein Hewani:</strong> {{ $kunjungan->makanan_protein_hewani ? 'Ya' : 'Tidak' }}</p>
            <p><strong>Makanan Sumber Protein Nabati:</strong> {{ $kunjungan->makanan_protein_nabati ? 'Ya' : 'Tidak' }}</p>
            <p><strong>Sumber Lemak:</strong> {{ $kunjungan->sumber_lemak ? 'Ya' : 'Tidak' }}</p>
            <p><strong>Buah dan Sayur:</strong> {{ $kunjungan->buah_sayur ? 'Ya' : 'Tidak' }}</p>
            <p><strong>Ada Obat Cacing:</strong> {{ $kunjungan->ada_obat_cacing ? 'Ya' : 'Tidak' }}</p>
            <p><strong>Waktu Minum Obat Cacing:</strong> {{ \Carbon\Carbon::parse($kunjungan->waktu_minum_obat_cacing)->format('d/m/Y') }}</p>
            <p><strong>Ada MT Pangan Lokal:</strong> {{ $kunjungan->ada_mt_pangan_lokal ? 'Ya' : 'Tidak' }}</p>
            <p><strong>Kepatuhan Konsumsi MT Pangan Lokal:</strong> {{ $kunjungan->kepatuhan_mt_pangan_lokal ? 'Ya' : 'Tidak' }}</p>
        </div>
