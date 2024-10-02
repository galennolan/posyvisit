<?php

namespace App\Exports;

use App\Models\Keluarga;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class KeluargaExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    protected $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function collection()
    {
        // Ambil data keluarga berdasarkan id beserta anggota keluarganya
        return Keluarga::with('anggotaKeluarga')->where('id', $this->id)->get();
    }

    public function headings(): array
    {
        return [
            'DATA KELUARGA DAN ANGGOTA KELUARGA',
        ]; // Merge cell dan styling dilakukan di metode styles()
    }

    // Helper function untuk mengubah kode numerik menjadi teks pada hubungan KK
    protected function mapHubunganKK($value)
    {
        $hubungan = [
            1 => 'Kepala Keluarga',
            2 => 'Suami',
            3 => 'Istri',
            4 => 'Anak',
            5 => 'Menantu',
            6 => 'Cucu',
            7 => 'Orang Tua',
            8 => 'Mertua',
            9 => 'Anggota Lain',
        ];

        return $hubungan[$value] ?? 'Tidak Diketahui';
    }

    // Helper function untuk mengubah kode numerik menjadi teks pada status perkawinan
    protected function mapStatusPerkawinan($value)
    {
        $status = [
            1 => 'Belum Menikah',
            2 => 'Menikah',
            3 => 'Cerai Hidup',
            4 => 'Cerai Mati',
        ];

        return $status[$value] ?? 'Tidak Diketahui';
    }

    // Helper function untuk mengubah kode numerik menjadi teks pada pendidikan terakhir
    protected function mapPendidikanTerakhir($value)
    {
        $pendidikan = [
            1 => 'Tidak Sekolah',
            2 => 'SD',
            3 => 'SMP',
            4 => 'SMA',
            5 => 'Diploma',
            6 => 'Sarjana',
        ];

        return $pendidikan[$value] ?? 'Tidak Diketahui';
    }

    // Helper function untuk mengubah kode numerik menjadi teks pada pekerjaan
    protected function mapPekerjaan($value)
    {
        $pekerjaan = [
            1 => 'Tidak Bekerja',
            2 => 'Petani',
            3 => 'PNS',
            4 => 'Buruh',
            5 => 'Wiraswasta',
            6 => 'Pelajar',
            7 => 'Lainnya',
        ];

        return $pekerjaan[$value] ?? 'Tidak Diketahui';
    }

    public function map($keluarga): array
    {
        $rows = [];

        // Bagian Data Keluarga
        $rows[] = ['Tanggal Pengumpulan Data: ' . \Carbon\Carbon::parse($keluarga->tanggal_pengumpulan_data)->format('d/m/Y')];
        $rows[] = ['Informasi Tempat'];
        $rows[] = ['Alamat: ' . $keluarga->alamat];
        $rows[] = ['No Handphone: ' . $keluarga->no_handphone];
        $rows[] = ['Desa/Kelurahan: ' . $keluarga->kelurahan, 'Puskesmas: ' . $keluarga->puskesmas];
        
        // Input untuk Kecamatan dan Puskesmas pada cell yang di-merge
        $rows[] = ['Kecamatan: ' . $keluarga->kecamatan]; // Akan di-merge pada A7-C7
        $rows[] = ['Pustu/Posyandu: ' . $keluarga->pustu]; // Akan di-merge pada D7-D9

        $rows[] = ['Provinsi: ' . $keluarga->provinsi];

        // Tambahkan baris kosong sebagai jeda
        $rows[] = [];

        // Heading untuk Anggota Keluarga
        $rows[] = ['Anggota Keluarga'];
        $rows[] = ['Nama', 'NIK', 'Tanggal Lahir', 'Jenis Kelamin', 'Hubungan KK', 'Status Perkawinan', 'Pendidikan Terakhir', 'Pekerjaan', 'Kelompok Sasaran'];

        // Tambahkan setiap anggota keluarga
        foreach ($keluarga->anggotaKeluarga as $anggota) {
            $rows[] = [
                $anggota->nama_lengkap,
                $anggota->nik,
                \Carbon\Carbon::parse($anggota->tanggal_lahir)->format('d/m/Y'),
                $anggota->jenis_kelamin,
                $this->mapHubunganKK($anggota->hubungan_kk),
                $this->mapStatusPerkawinan($anggota->status_perkawinan),
                $this->mapPendidikanTerakhir($anggota->pendidikan_terakhir),
                $this->mapPekerjaan($anggota->pekerjaan),
                $anggota->kelompok_sasaran,
            ];
        }

        return $rows;
    }

    public function styles(Worksheet $sheet)
    {
        // Merge cell dan style untuk 'DATA KELUARGA DAN ANGGOTA KELUARGA' dari A1 sampai I1
        $sheet->mergeCells('A1:I1');
        $sheet->getStyle('A1:I1')->applyFromArray([
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['argb' => 'FFCCCCCC'],  // Warna abu-abu
            ],
            'font' => [
                'bold' => true,
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ]);
      


        // Merge cell dan style untuk 'Anggota Keluarga' dari A10 sampai I10
        $sheet->mergeCells('A10:I10');
        $sheet->getStyle('A10:I10')->applyFromArray([
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['argb' => 'FFCCCCCC'],  // Warna abu-abu
            ],
            'font' => [
                'bold' => true,
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ]);

        // Set border untuk semua sel
        $sheet->getStyle('A1:I100')->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'], // Warna border hitam
                ],
            ],
        ]);

        return [];
    }
}
