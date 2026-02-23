<?php

namespace App\Exports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class StudentsExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    public function query()
    {
        return Student::with('classroom')->where('status', '!=', 'calon_siswa')->orderBy('name');
    }

    public function headings(): array
    {
        return [
            'NISN', 'NIS', 'NIK', 'No. KK', 'Nama Lengkap', 'L/P', 'Tempat Lahir', 'Tanggal Lahir',
            'Agama', 'Kelas', 'Kategori', 'Status', 'Status SPP', 'Nominal SPP',
            'Anak Ke-', 'Jml Saudara', 'Status Keluarga',
            'Alamat', 'Desa', 'Kecamatan', 'Tempat Tinggal', 'Transportasi',
            'HP Siswa', 'Tinggi (cm)', 'Berat (kg)', 'Jarak Sekolah', 'Waktu Tempuh (mnt)',
            'Nama Ayah', 'NIK Ayah', 'TTL Ayah', 'Tgl Lahir Ayah', 'Pendidikan Ayah', 'Pekerjaan Ayah',
            'Nama Ibu', 'NIK Ibu', 'TTL Ibu', 'Tgl Lahir Ibu', 'Pendidikan Ibu', 'Pekerjaan Ibu',
            'Penghasilan Ortu', 'Nama Wali Ortu', 'HP Ortu',
            'Nama Wali', 'NIK Wali', 'TTL Wali', 'Tgl Lahir Wali', 'Pendidikan Wali', 'Pekerjaan Wali',
            'Alamat Wali', 'HP Wali',
        ];
    }

    public function map($student): array
    {
        return [
            $student->nisn, $student->nis, $student->nik, $student->no_kk,
            $student->name, $student->gender,
            $student->birth_place, $student->birth_date?->format('Y-m-d'),
            $student->religion, $student->classroom->name ?? '-',
            $student->category, $student->status, $student->infaq_status, $student->infaq_nominal,
            $student->child_position, $student->sibling_count, $student->family_status,
            $student->address, $student->village, $student->district,
            $student->residence_type, $student->transportation,
            $student->student_phone, $student->height, $student->weight,
            $student->distance_to_school, $student->travel_time,
            $student->father_name, $student->father_nik, $student->father_birth_place,
            $student->father_birth_date?->format('Y-m-d'), $student->father_education, $student->father_occupation,
            $student->mother_name, $student->mother_nik, $student->mother_birth_place,
            $student->mother_birth_date?->format('Y-m-d'), $student->mother_education, $student->mother_occupation,
            $student->parent_income, $student->parent_name, $student->parent_phone,
            $student->guardian_name, $student->guardian_nik, $student->guardian_birth_place,
            $student->guardian_birth_date?->format('Y-m-d'), $student->guardian_education, $student->guardian_occupation,
            $student->guardian_address, $student->guardian_phone,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [1 => ['font' => ['bold' => true]]];
    }
}
