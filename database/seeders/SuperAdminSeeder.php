<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat Akun Owner (Super Admin)
        $ownerId = DB::table('users')->insertGetId([
            'name' => 'Owner As-Saodah',
            'email' => 'owner@assaodah.com',
            'username' => 'superadmin',
            'password' => Hash::make('rahasia123'), // Default Password
            'role' => 'owner',
            'phone' => '081234567890',
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 2. Buat Entity (Sekolah)
        $sekolahEntityId = DB::table('entities')->where('name', 'MI As-Saodah')->value('id');
        if (!$sekolahEntityId) {
            $sekolahEntityId = DB::table('entities')->insertGetId([
                'name' => 'MI As-Saodah',
                'type' => 'sekolah',
                'description' => 'Madrasah Ibtidaiyah As-Saodah',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // 3. Buat Unit MI
        $unitMiId = DB::table('units')->where('name', 'MI As-Saodah')->where('entity_id', $sekolahEntityId)->value('id');
        if (!$unitMiId) {
            $unitMiId = DB::table('units')->insertGetId([
                'entity_id' => $sekolahEntityId,
                'name' => 'MI As-Saodah',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // 4. Beri Hak Akses (Scope) untuk Super Admin
        DB::table('user_scopes')->insert([
            [
                'user_id' => $ownerId,
                'entity_id' => $sekolahEntityId,
                'unit_id' => null, // Berarti akses penuh ke semua unit di bawah MI As-Saodah ini
                'role' => 'owner',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
        
        $this->command->info('Super Admin ber-role Owner berhasil ditambahkan!');
        $this->command->info('Email: owner@assaodah.com | Password: rahasia123');
    }
}
