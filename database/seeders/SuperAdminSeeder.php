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

        // 2. Buat Entity (Yayasan / Sekolah / Pesantren)
        $sekolahEntityId = DB::table('entities')->insertGetId([
            'name' => 'Sekolah MH As-Saodah',
            'type' => 'sekolah',
            'description' => 'SD, SMP, SMK',
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $pesantrenEntityId = DB::table('entities')->insertGetId([
            'name' => 'Pesantren MH As-Saodah',
            'type' => 'pesantren',
            'description' => 'Pondok Pesantren Putra / Putri',
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 3. Buat Unit-unit di bawah Sekolah (Opsional untuk testing unit level)
        $unitSmkId = DB::table('units')->insertGetId([
            'entity_id' => $sekolahEntityId,
            'name' => 'SMK MH As-Saodah',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 4. Beri Hak Akses (Scope) untuk Super Admin
        // Karena role 'owner' hardcoded by-pass di middleware, scope ini hanya penguat context UI
        DB::table('user_scopes')->insert([
            [
                'user_id' => $ownerId,
                'entity_id' => $sekolahEntityId,
                'unit_id' => null, // Berarti akses penuh ke semua unit di bawah Sekolah ini
                'role' => 'owner',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => $ownerId,
                'entity_id' => $pesantrenEntityId,
                'unit_id' => null, // Akses penuh ke entitas Pesantren
                'role' => 'owner',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
        
        $this->command->info('Super Admin ber-role Owner berhasil ditambahkan!');
        $this->command->info('Email: owner@assaodah.com | Password: rahasia123');
    }
}
