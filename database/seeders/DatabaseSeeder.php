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
            $user = \App\Models\User::firstOrCreate(
                ['email' => $userData['email']],
                $userData
            );
            
            // Assign scope ke MI jika belum ada
            \App\Models\UserScope::firstOrCreate(
                [
                    'user_id' => $user->id,
                    'entity_id' => $entityMi->id,
                    'unit_id' => $unitMi->id,
                ],
                ['role' => $user->role]
            );
        }

        // 3. Jalankan Demo Data (Kelas & Siswa)
        $this->call([
            DemoDataSeeder::class,
        ]);

        // 4. Default Kas
        $cashAccounts = [
            ['name' => 'BSI Sekolah', 'balance' => 0],
            ['name' => 'Kas Tunai / Brankas', 'balance' => 0]
        ];
        foreach ($cashAccounts as $account) {
            DB::table('cash_accounts')->updateOrInsert(
                ['name' => $account['name']],
                array_merge($account, ['updated_at' => now(), 'created_at' => now()])
            );
        }

        // 5. Default Kategori Transaksi
        $categories = [
            ['name' => 'Pencairan BOS', 'type' => 'in'],
            ['name' => 'Donasi / Bantuan', 'type' => 'in'],
            ['name' => 'Pembayaran SPP/Infaq', 'type' => 'in'],
            ['name' => 'Pengeluaran Listrik & WiFi', 'type' => 'out'],
            ['name' => 'Honorarium Guru', 'type' => 'out'],
            ['name' => 'Pengeluaran ATK', 'type' => 'out'],
        ];
        foreach ($categories as $cat) {
            DB::table('transaction_categories')->updateOrInsert(
                ['name' => $cat['name'], 'type' => $cat['type']],
                array_merge($cat, ['updated_at' => now(), 'created_at' => now()])
            );
        }
    }
}