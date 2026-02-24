<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        $allRoles = ['kepsek', 'admin', 'operator', 'bendahara', 'superadmin'];
        $ppdbRoles = ['kepsek', 'operator', 'admin', 'superadmin'];
        $financeRoles = ['kepsek', 'bendahara', 'admin', 'superadmin'];
        $systemRoles = ['kepsek', 'superadmin', 'admin'];

        $menus = [
            [
                'name' => 'Dashboard Utama',
                'route_name' => 'dashboard',
                'icon_svg' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>',
                'roles' => $allRoles,
                'order_index' => 1,
                'group_name' => null,
            ],
            [
                'name' => 'Penerimaan PPDB',
                'route_name' => 'ppdb.index',
                'icon_svg' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>',
                'roles' => $ppdbRoles,
                'order_index' => 2,
                'group_name' => 'Penerimaan Siswa',
            ],
            [
                'name' => 'Daftar Ulang Siswa',
                'route_name' => 're-registration.index',
                'icon_svg' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />',
                'roles' => $allRoles, // Di sidebar asli ini diluar if (bisa diakses semua role)
                'order_index' => 3,
                'group_name' => 'Penerimaan Siswa',
            ],
            [
                'name' => 'Data Siswa',
                'route_name' => 'students.index',
                'icon_svg' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>',
                'roles' => $allRoles,
                'order_index' => 4,
                'group_name' => 'Basis Data Utama',
            ],
            [
                'name' => 'Mutasi & Kenaikan Kelas',
                'route_name' => 'mutations.index',
                'icon_svg' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />',
                'roles' => $allRoles,
                'order_index' => 5,
                'group_name' => 'Basis Data Utama',
            ],
            [
                'name' => 'Daftar Kelas RI',
                'route_name' => 'classrooms.index',
                'icon_svg' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />',
                'roles' => $allRoles,
                'order_index' => 6,
                'group_name' => 'Basis Data Utama',
            ],
            [
                'name' => 'Tahun Ajaran',
                'route_name' => 'academic-years.index',
                'icon_svg' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />',
                'roles' => $allRoles,
                'order_index' => 7,
                'group_name' => 'Basis Data Utama',
            ],
            [
                'name' => 'Kategori Keuangan',
                'route_name' => 'transaction-categories.index',
                'icon_svg' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />',
                'roles' => $allRoles,
                'order_index' => 8,
                'group_name' => 'Basis Data Utama',
            ],
            [
                'name' => 'Manajemen Infaq / SPP',
                'route_name' => 'infaq.bills.index',
                'icon_svg' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>',
                'roles' => $financeRoles,
                'order_index' => 9,
                'group_name' => 'Keuangan & Tagihan',
            ],
            [
                'name' => 'Tabungan Siswa',
                'route_name' => 'tabungan.index',
                'icon_svg' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />',
                'roles' => $financeRoles,
                'order_index' => 10,
                'group_name' => 'Keuangan & Tagihan',
            ],
            [
                'name' => 'Wakaf & Donasi',
                'route_name' => 'wakaf.index',
                'icon_svg' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7" />',
                'roles' => $financeRoles,
                'order_index' => 11,
                'group_name' => 'Keuangan & Tagihan',
            ],
            [
                'name' => 'Kas & Jurnal Umum',
                'route_name' => 'journal.index',
                'icon_svg' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>',
                'roles' => $financeRoles,
                'order_index' => 12,
                'group_name' => 'Keuangan & Tagihan',
            ],
            [
                'name' => 'Laporan Lengkap',
                'route_name' => 'reports.index',
                'icon_svg' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2" />',
                'roles' => $financeRoles,
                'order_index' => 13,
                'group_name' => 'Keuangan & Tagihan',
            ],
            [
                'name' => 'Data Guru',
                'route_name' => 'hr.teachers.index',
                'icon_svg' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />',
                'roles' => $financeRoles,
                'order_index' => 14,
                'group_name' => 'Kepegawaian (HR)',
            ],
            [
                'name' => 'Data Staf',
                'route_name' => 'hr.staff.index',
                'icon_svg' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />',
                'roles' => $financeRoles,
                'order_index' => 15,
                'group_name' => 'Kepegawaian (HR)',
            ],
            [
                'name' => 'Slip Gaji / Payroll',
                'route_name' => 'hr.payroll.index',
                'icon_svg' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />',
                'roles' => $financeRoles,
                'order_index' => 16,
                'group_name' => 'Kepegawaian (HR)',
            ],
            [
                'name' => 'Inventaris Sekolah',
                'route_name' => 'inventory.index',
                'icon_svg' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />',
                'roles' => $financeRoles,
                'order_index' => 17,
                'group_name' => 'Kepegawaian (HR)',
            ],
            [
                'name' => 'Pengaturan Sistem',
                'route_name' => 'settings.index',
                'icon_svg' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>',
                'roles' => $systemRoles,
                'order_index' => 18,
                'group_name' => 'Sistem',
            ],
        ];

        foreach ($menus as $menu) {
            Menu::updateOrCreate(
                ['route_name' => $menu['route_name']],
                $menu
            );
        }
    }
}
