<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Jalankan Seeders Dasar & Unit (Audit MI Tunggal)
        $this->call([
            SuperAdminSeeder::class,
            RoleUnitUserSeeder::class,
            SchoolSettingSeeder::class,
        ]);

        // 2. Akun Kepsek, Bendahara, Operator (Manual)
        // Hubungkan ke unit MI yang sudah dibuat oleh seeder di atas
        $unitMi = \App\Models\Unit::where('name', 'MI As-Saodah')->first();
        $entityMi = \App\Models\Entity::where('name', 'MI As-Saodah')->first();

        $users = [
            [
                'name' => 'Bapak Kepala Sekolah',
                'email' => 'kepsek@mi-assaodah.sch.id',
                'username' => 'kepsek',
                'password' => Hash::make('password123'),
                'role' => 'kepsek',
                'status' => 'aktif',
            ],
            [
                'name' => 'Ibu Bendahara',
                'email' => 'bendahara@mi-assaodah.sch.id',
                'username' => 'bendahara',
                'password' => Hash::make('password123'),
                'role' => 'bendahara',
                'status' => 'aktif',
            ],
            [
                'name' => 'Admin Operator',
                'email' => 'operator@mi-assaodah.sch.id',
                'username' => 'operator',
                'password' => Hash::make('password123'),
                'role' => 'operator',
                'status' => 'aktif',
            ],
        ];

        foreach ($users as $userData) {
            $user = \App\Models\User::create($userData);
            
            // Assign scope ke MI
            \App\Models\UserScope::create([
                'user_id' => $user->id,
                'entity_id' => $entityMi->id,
                'unit_id' => $unitMi->id,
                'role' => $user->role,
            ]);
        }

        // 3. Jalankan Demo Data (Kelas & Siswa)
        $this->call([
            DemoDataSeeder::class,
        ]);

        // 4. Default Kas
        DB::table('cash_accounts')->insert([
            ['name' => 'BSI Sekolah', 'balance' => 0, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Kas Tunai / Brankas', 'balance' => 0, 'created_at' => now(), 'updated_at' => now()]
        ]);

        // 5. Default Kategori Transaksi
        DB::table('transaction_categories')->insert([
            ['name' => 'Pencairan BOS', 'type' => 'in', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Donasi / Bantuan', 'type' => 'in', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Pembayaran SPP/Infaq', 'type' => 'in', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Pengeluaran Listrik & WiFi', 'type' => 'out', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Honorarium Guru', 'type' => 'out', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Pengeluaran ATK', 'type' => 'out', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}