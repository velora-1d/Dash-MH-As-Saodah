<?php

namespace App\Exports;

use App\Models\PpdbRegistration;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PpdbExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    public function query()
    {
        return PpdbRegistration::with('academicYear')->orderByDesc('created_at');
    }

    public function headings(): array
    {
        return [
            'No. Registrasi', 'Tahun Ajaran', 'Nama Siswa', 'L/P', 'Tempat Lahir', 'Tgl Lahir',
            'NIK', 'No. KK', 'Agama', 'Asal Sekolah', 'Status',
            'Sumber', 'Tgl Daftar',
            'Alamat', 'Desa', 'Kecamatan', 'Tempat Tinggal', 'Transportasi', 'HP Siswa',
            'Tinggi (cm)', 'Berat (kg)', 'Jarak Sekolah', 'Waktu Tempuh (mnt)',
            'Nama Wali Ortu', 'HP Ortu', 'Penghasilan Ortu',
            'Nama Ayah', 'NIK Ayah', 'Pendidikan Ayah', 'Pekerjaan Ayah',
            'Nama Ibu', 'NIK Ibu', 'Pendidikan Ibu', 'Pekerjaan Ibu',
            'Nama Wali', 'NIK Wali', 'Pendidikan Wali', 'Pekerjaan Wali', 'HP Wali',
        ];
    }

    public function map($ppdb): array
    {
        return [
            $ppdb->registration_number, $ppdb->academicYear->name ?? '-',
            $ppdb->student_name, $ppdb->gender,
            $ppdb->birth_place, $ppdb->birth_date?->format('Y-m-d'),
            $ppdb->nik, $ppdb->no_kk, $ppdb->religion, $ppdb->previous_school,
            $ppdb->status, $ppdb->registration_source, $ppdb->created_at?->format('Y-m-d'),
            $ppdb->address, $ppdb->village, $ppdb->district,
            $ppdb->residence_type, $ppdb->transportation, $ppdb->student_phone,
            $ppdb->height, $ppdb->weight, $ppdb->distance_to_school, $ppdb->travel_time,
            $ppdb->parent_name, $ppdb->parent_phone, $ppdb->parent_income,
            $ppdb->father_name, $ppdb->father_nik, $ppdb->father_education, $ppdb->father_occupation,
            $ppdb->mother_name, $ppdb->mother_nik, $ppdb->mother_education, $ppdb->mother_occupation,
            $ppdb->guardian_name, $ppdb->guardian_nik, $ppdb->guardian_education, $ppdb->guardian_occupation, $ppdb->guardian_phone,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [1 => ['font' => ['bold' => true]]];
    }
}
