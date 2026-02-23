<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Classroom;
use App\Models\Student;
use App\Models\AcademicYear;

class DemoDataSeeder extends Seeder
{
    public function run(): void
    {
        // Pastikan ada Tahun Ajaran aktif
        $ay = AcademicYear::where('is_active', true)->first();
        if (!$ay) {
            $ay = AcademicYear::create([
                'name' => '2025/2026 Ganjil',
                'semester' => 'ganjil',
                'is_active' => true,
            ]);
        }

        // Buat Kelas 1 - 6
        $kelasData = [
            ['level' => 1, 'name' => 'Kelas 1A', 'infaq_nominal' => 150000, 'wali_kelas' => 'Ibu Siti Aminah'],
            ['level' => 2, 'name' => 'Kelas 2A', 'infaq_nominal' => 150000, 'wali_kelas' => 'Ibu Nurjanah'],
            ['level' => 3, 'name' => 'Kelas 3A', 'infaq_nominal' => 175000, 'wali_kelas' => 'Bapak Ahmad Fauzi'],
            ['level' => 4, 'name' => 'Kelas 4A', 'infaq_nominal' => 175000, 'wali_kelas' => 'Ibu Rina Marlina'],
            ['level' => 5, 'name' => 'Kelas 5A', 'infaq_nominal' => 200000, 'wali_kelas' => 'Bapak Hendra Wijaya'],
            ['level' => 6, 'name' => 'Kelas 6A', 'infaq_nominal' => 200000, 'wali_kelas' => 'Ibu Dewi Lestari'],
        ];

        $classrooms = [];
        foreach ($kelasData as $kd) {
            $classrooms[$kd['level']] = Classroom::create($kd);
        }

        // Buat Siswa (1 per kelas = 6 siswa)
        $siswaData = [
            ['name' => 'Ahmad Rafi Pratama',    'level' => 1, 'nisn' => '0081234001', 'nis' => 'MI-001', 'gender' => 'L', 'category' => 'reguler',       'infaq_status' => 'bayar',   'parent_name' => 'Bapak Dani Pratama',   'parent_phone' => '081234567801'],
            ['name' => 'Sitti Aisyah Zahra',    'level' => 2, 'nisn' => '0081234002', 'nis' => 'MI-002', 'gender' => 'P', 'category' => 'reguler',       'infaq_status' => 'bayar',   'parent_name' => 'Ibu Fatimah Zahra',    'parent_phone' => '081234567802'],
            ['name' => 'Muhammad Fajar Sidiq',   'level' => 3, 'nisn' => '0081234003', 'nis' => 'MI-003', 'gender' => 'L', 'category' => 'yatim',         'infaq_status' => 'gratis',  'parent_name' => 'Ibu Maryam',           'parent_phone' => '081234567803'],
            ['name' => 'Nur Halimah Putri',      'level' => 4, 'nisn' => '0081234004', 'nis' => 'MI-004', 'gender' => 'P', 'category' => 'kurang_mampu',  'infaq_status' => 'subsidi', 'parent_name' => 'Bapak Usman',          'parent_phone' => '081234567804', 'infaq_nominal' => 75000],
            ['name' => 'Rizky Ramadhan',         'level' => 5, 'nisn' => '0081234005', 'nis' => 'MI-005', 'gender' => 'L', 'category' => 'reguler',       'infaq_status' => 'bayar',   'parent_name' => 'Bapak Hasan Ramadhan', 'parent_phone' => '081234567805'],
            ['name' => 'Aulia Rahma Dewi',       'level' => 6, 'nisn' => '0081234006', 'nis' => 'MI-006', 'gender' => 'P', 'category' => 'reguler',       'infaq_status' => 'bayar',   'parent_name' => 'Ibu Sri Dewi',         'parent_phone' => '081234567806'],
        ];

        foreach ($siswaData as $sd) {
            $level = $sd['level'];
            unset($sd['level']);
            
            Student::create(array_merge($sd, [
                'classroom_id' => $classrooms[$level]->id,
                'status' => 'aktif',
                'nik' => '320100' . str_pad(rand(1000, 9999), 10, '0', STR_PAD_LEFT),
                'no_kk' => '320100' . str_pad(rand(1000, 9999), 10, '0', STR_PAD_LEFT),
                'address' => 'Kp. Contoh RT 001/001, Desa Contoh, Kab. Contoh',
            ]));
        }
    }
}
