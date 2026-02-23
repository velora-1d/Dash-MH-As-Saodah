<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class StudentsTemplateExport implements WithHeadings, ShouldAutoSize, WithStyles
{
    public function headings(): array
    {
        return [
            'NISN', 'NIS', 'NIK', 'No. KK', 'Nama Lengkap *', 'L/P *', 'Tempat Lahir', 'Tanggal Lahir (YYYY-MM-DD)',
            'Agama', 'Kategori (reguler/yatim/kurang_mampu) *', 'Status SPP (bayar/gratis/subsidi) *', 'Nominal SPP',
            'Anak Ke-', 'Jml Saudara', 'Status Keluarga',
            'Alamat', 'Desa', 'Kecamatan', 'Tempat Tinggal (Orang tua/Kerabat/Kos/Lainnya)', 'Transportasi (Jalan kaki/Motor/Jemputan Sekolah/Kendaraan Umum/Lainnya)',
            'HP Siswa', 'Tinggi (cm)', 'Berat (kg)', 'Jarak Sekolah', 'Waktu Tempuh (mnt)',
            'Nama Ayah', 'NIK Ayah', 'Tempat Lahir Ayah', 'Tgl Lahir Ayah (YYYY-MM-DD)', 'Pendidikan Ayah', 'Pekerjaan Ayah',
            'Nama Ibu', 'NIK Ibu', 'Tempat Lahir Ibu', 'Tgl Lahir Ibu (YYYY-MM-DD)', 'Pendidikan Ibu', 'Pekerjaan Ibu',
            'Penghasilan Ortu', 'Nama Wali Ortu', 'HP Ortu',
            'Nama Wali', 'NIK Wali', 'Tempat Lahir Wali', 'Tgl Lahir Wali (YYYY-MM-DD)', 'Pendidikan Wali', 'Pekerjaan Wali',
            'Alamat Wali', 'HP Wali',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [1 => ['font' => ['bold' => true, 'color' => ['rgb' => '1e40af']], 'fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'dbeafe']]]];
    }
}
