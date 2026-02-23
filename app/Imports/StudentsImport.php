<?php

namespace App\Imports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;

class StudentsImport implements ToModel, WithHeadingRow, WithValidation, SkipsEmptyRows
{
    public function model(array $row)
    {
        return new Student([
            'nisn'              => $row['nisn'] ?? null,
            'nis'               => $row['nis'] ?? null,
            'nik'               => $row['nik'] ?? null,
            'no_kk'             => $row['no_kk'] ?? null,
            'name'              => $row['nama_lengkap'],
            'gender'            => $row['lp'],
            'birth_place'       => $row['tempat_lahir'] ?? null,
            'birth_date'        => $row['tanggal_lahir_yyyy_mm_dd'] ?? null,
            'religion'          => $row['agama'] ?? null,
            'category'          => $row['kategori_reguleryatimkurang_mampu'] ?? 'reguler',
            'infaq_status'      => $row['status_spp_bayargratissubsidi'] ?? 'bayar',
            'infaq_nominal'     => $row['nominal_spp'] ?? null,
            'child_position'    => $row['anak_ke'] ?? null,
            'sibling_count'     => $row['jml_saudara'] ?? null,
            'family_status'     => $row['status_keluarga'] ?? null,
            'address'           => $row['alamat'] ?? null,
            'village'           => $row['desa'] ?? null,
            'district'          => $row['kecamatan'] ?? null,
            'residence_type'    => $row['tempat_tinggal_orang_tuakerabatkoslainnya'] ?? null,
            'transportation'    => $row['transportasi_jalan_kakimotorjemputan_sekolahkendaraan_umumlainnya'] ?? null,
            'student_phone'     => $row['hp_siswa'] ?? null,
            'height'            => $row['tinggi_cm'] ?? null,
            'weight'            => $row['berat_kg'] ?? null,
            'distance_to_school'=> $row['jarak_sekolah'] ?? null,
            'travel_time'       => $row['waktu_tempuh_mnt'] ?? null,
            'father_name'       => $row['nama_ayah'] ?? null,
            'father_nik'        => $row['nik_ayah'] ?? null,
            'father_birth_place'=> $row['tempat_lahir_ayah'] ?? null,
            'father_birth_date' => $row['tgl_lahir_ayah_yyyy_mm_dd'] ?? null,
            'father_education'  => $row['pendidikan_ayah'] ?? null,
            'father_occupation' => $row['pekerjaan_ayah'] ?? null,
            'mother_name'       => $row['nama_ibu'] ?? null,
            'mother_nik'        => $row['nik_ibu'] ?? null,
            'mother_birth_place'=> $row['tempat_lahir_ibu'] ?? null,
            'mother_birth_date' => $row['tgl_lahir_ibu_yyyy_mm_dd'] ?? null,
            'mother_education'  => $row['pendidikan_ibu'] ?? null,
            'mother_occupation' => $row['pekerjaan_ibu'] ?? null,
            'parent_income'     => $row['penghasilan_ortu'] ?? null,
            'parent_name'       => $row['nama_wali_ortu'] ?? null,
            'parent_phone'      => $row['hp_ortu'] ?? null,
            'guardian_name'     => $row['nama_wali'] ?? null,
            'guardian_nik'      => $row['nik_wali'] ?? null,
            'guardian_birth_place'=> $row['tempat_lahir_wali'] ?? null,
            'guardian_birth_date' => $row['tgl_lahir_wali_yyyy_mm_dd'] ?? null,
            'guardian_education' => $row['pendidikan_wali'] ?? null,
            'guardian_occupation'=> $row['pekerjaan_wali'] ?? null,
            'guardian_address'  => $row['alamat_wali'] ?? null,
            'guardian_phone'    => $row['hp_wali'] ?? null,
            'status'            => 'aktif',
        ]);
    }

    public function rules(): array
    {
        return [
            'nama_lengkap' => 'required|string|max:255',
            'lp' => 'required|in:L,P',
        ];
    }
}
