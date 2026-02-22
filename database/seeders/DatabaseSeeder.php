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
        // 1. Akun Super Admin Utama (Kepala Sekolah)
        DB::table('users')->insert([
            'name' => 'Bapak Kepala Sekolah',
            'email' => 'kepsek@mi-assaodah.sch.id',
            'username' => 'kepsek',
            'password' => Hash::make('password123'),
            'role' => 'kepsek',
            'status' => 'aktif',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 2. Akun Bendahara
        DB::table('users')->insert([
            'name' => 'Ibu Bendahara',
            'email' => 'bendahara@mi-assaodah.sch.id',
            'username' => 'bendahara',
            'password' => Hash::make('password123'),
            'role' => 'bendahara',
            'status' => 'aktif',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 3. Akun Operator PPDB
        DB::table('users')->insert([
            'name' => 'Admin Operator',
            'email' => 'operator@mi-assaodah.sch.id',
            'username' => 'operator',
            'password' => Hash::make('password123'),
            'role' => 'operator',
            'status' => 'aktif',
            'created_at' => now(),
            'updated_at' => now(),
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