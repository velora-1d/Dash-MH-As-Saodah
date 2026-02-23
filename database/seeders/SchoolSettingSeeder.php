<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SchoolSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\SchoolSetting::create([
            'name' => 'MI As-Saodah',
            'address' => 'Jl. Pendidikan No. 123, Kabupaten/Kota, Provinsi',
            'phone' => '021-12345678',
            'email' => 'info@mias-saodah.sch.id',
            'headmaster_name' => 'Fulan bin Fulan, S.Pd.I',
            'headmaster_nip' => '-'
        ]);
    }
}
