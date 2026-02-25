<?php

namespace Database\Seeders;

use App\Models\WebSetting;
use Illuminate\Database\Seeder;

class WebSettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // === GENERAL ===
            ['key' => 'site_name', 'value' => 'MI MH As-Saodah', 'type' => 'text', 'group' => 'general', 'label' => 'Nama Situs'],
            ['key' => 'site_tagline', 'value' => 'Membentuk Generasi Qur\'ani, Berprestasi, dan Berwawasan Global', 'type' => 'text', 'group' => 'general', 'label' => 'Slogan / Tagline'],
            ['key' => 'site_description', 'value' => 'Madrasah Ibtidaiyah MH As-Saodah adalah lembaga pendidikan Islam yang mengedepankan kualitas akademik dan pembinaan akhlak mulia.', 'type' => 'textarea', 'group' => 'general', 'label' => 'Deskripsi Singkat'],
            ['key' => 'principal_name', 'value' => '', 'type' => 'text', 'group' => 'general', 'label' => 'Nama Kepala Madrasah'],
            ['key' => 'principal_photo', 'value' => '', 'type' => 'image', 'group' => 'general', 'label' => 'Foto Kepala Madrasah'],
            ['key' => 'principal_greeting', 'value' => '', 'type' => 'textarea', 'group' => 'general', 'label' => 'Sambutan Kepala Madrasah'],
            ['key' => 'school_history', 'value' => '', 'type' => 'textarea', 'group' => 'general', 'label' => 'Sejarah Singkat'],
            ['key' => 'vision', 'value' => '', 'type' => 'textarea', 'group' => 'general', 'label' => 'Visi'],
            ['key' => 'mission', 'value' => '', 'type' => 'textarea', 'group' => 'general', 'label' => 'Misi'],

            // === CONTACT ===
            ['key' => 'phone', 'value' => '', 'type' => 'text', 'group' => 'contact', 'label' => 'Nomor Telepon'],
            ['key' => 'whatsapp', 'value' => '', 'type' => 'text', 'group' => 'contact', 'label' => 'Nomor WhatsApp'],
            ['key' => 'email', 'value' => '', 'type' => 'text', 'group' => 'contact', 'label' => 'Email'],
            ['key' => 'address', 'value' => '', 'type' => 'textarea', 'group' => 'contact', 'label' => 'Alamat Lengkap'],
            ['key' => 'google_maps_embed', 'value' => '', 'type' => 'textarea', 'group' => 'contact', 'label' => 'Embed Google Maps (iframe URL)'],

            // === SOCIAL MEDIA ===
            ['key' => 'instagram', 'value' => '', 'type' => 'text', 'group' => 'social', 'label' => 'Link Instagram'],
            ['key' => 'youtube', 'value' => '', 'type' => 'text', 'group' => 'social', 'label' => 'Link YouTube'],
            ['key' => 'facebook', 'value' => '', 'type' => 'text', 'group' => 'social', 'label' => 'Link Facebook'],
            ['key' => 'tiktok', 'value' => '', 'type' => 'text', 'group' => 'social', 'label' => 'Link TikTok'],

            // === PPDB ===
            ['key' => 'ppdb_is_open', 'value' => '1', 'type' => 'text', 'group' => 'ppdb', 'label' => 'PPDB Dibuka (1/0)'],
            ['key' => 'ppdb_year', 'value' => '2026/2027', 'type' => 'text', 'group' => 'ppdb', 'label' => 'Tahun Ajaran PPDB'],
            ['key' => 'ppdb_quota', 'value' => '60', 'type' => 'text', 'group' => 'ppdb', 'label' => 'Kuota Pendaftaran'],
            ['key' => 'ppdb_registered_count', 'value' => '0', 'type' => 'text', 'group' => 'ppdb', 'label' => 'Jumlah Terdaftar Saat Ini'],
            ['key' => 'ppdb_registration_fee', 'value' => '150000', 'type' => 'text', 'group' => 'ppdb', 'label' => 'Biaya Pendaftaran / Formulir'],
            ['key' => 're_registration_fee', 'value' => '350000', 'type' => 'text', 'group' => 'ppdb', 'label' => 'Biaya Daftar Ulang (Gedung dsb)'],
            ['key' => 'uniform_fee', 'value' => '600000', 'type' => 'text', 'group' => 'ppdb', 'label' => 'Biaya Seragam (Total)'],
            ['key' => 'books_fee', 'value' => '250000', 'type' => 'text', 'group' => 'ppdb', 'label' => 'Biaya Buku / LKS'],
            ['key' => 'ppdb_start_date', 'value' => '', 'type' => 'text', 'group' => 'ppdb', 'label' => 'Tanggal Mulai Pendaftaran'],
            ['key' => 'ppdb_end_date', 'value' => '', 'type' => 'text', 'group' => 'ppdb', 'label' => 'Tanggal Akhir Pendaftaran'],
            ['key' => 'ppdb_requirements', 'value' => '', 'type' => 'textarea', 'group' => 'ppdb', 'label' => 'Syarat Pendaftaran'],
            ['key' => 'ppdb_brochure', 'value' => '', 'type' => 'image', 'group' => 'ppdb', 'label' => 'Brosur Digital (PDF/Gambar)'],

            // === SEO ===
            ['key' => 'meta_title', 'value' => 'MI MH As-Saodah — Madrasah Ibtidaiyah Unggul & Berprestasi', 'type' => 'text', 'group' => 'seo', 'label' => 'Meta Title Website'],
            ['key' => 'meta_description', 'value' => 'MI MH As-Saodah adalah madrasah ibtidaiyah yang mendidik generasi Qur\'ani berprestasi. Daftar PPDB sekarang!', 'type' => 'textarea', 'group' => 'seo', 'label' => 'Meta Description Website'],
            ['key' => 'og_image', 'value' => '', 'type' => 'image', 'group' => 'seo', 'label' => 'Gambar Open Graph (Share Sosmed)'],

            // === STATISTIK BERANDA ===
            ['key' => 'stat_students', 'value' => '0', 'type' => 'text', 'group' => 'stats', 'label' => 'Jumlah Siswa Aktif'],
            ['key' => 'stat_teachers', 'value' => '0', 'type' => 'text', 'group' => 'stats', 'label' => 'Jumlah Tenaga Pendidik'],
            ['key' => 'stat_achievements', 'value' => '0', 'type' => 'text', 'group' => 'stats', 'label' => 'Jumlah Prestasi'],
            ['key' => 'stat_graduates', 'value' => '0', 'type' => 'text', 'group' => 'stats', 'label' => 'Total Lulusan'],
        ];

        foreach ($settings as $setting) {
            WebSetting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}
