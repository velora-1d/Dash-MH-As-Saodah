<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\WebHero;
use App\Models\WebFacility;
use App\Models\WebAchievement;
use App\Models\WebPost;
use App\Models\WebTeacher;

class WebDummyContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 1. Heroes
        DB::table('web_heroes')->truncate();
        $heroes = [
            ['title' => 'Membangun Generasi Qur\'ani & Berprestasi', 'subtitle' => 'Selamat Datang di MI MH As-Saodah', 'media_url' => 'web-contents/hero-1.jpg'],
            ['title' => 'Lingkungan Belajar Islami yang Nyaman', 'subtitle' => 'Fasilitas terbaik untuk ananda tercinta', 'media_url' => 'web-contents/hero-2.jpg'],
            ['title' => 'Berbakti Kepada Agama dan Negara', 'subtitle' => 'Mencetak siswa berakhlak mulia', 'media_url' => 'web-contents/hero-3.jpg'],
            ['title' => 'Cerdas, Kreatif, dan Mandiri', 'subtitle' => 'Pendidikan seimbang antara ilmu dunia dan akhirat', 'media_url' => 'web-contents/hero-4.jpg'],
            ['title' => 'Pendaftaran Peserta Didik Baru Terbuka', 'subtitle' => 'Segera daftarkan putra-putri Anda', 'media_url' => 'web-contents/hero-5.jpg'],
        ];
        foreach($heroes as $i => $h) {
            WebHero::create(array_merge($h, ['media_type' => 'image', 'is_active' => true, 'order' => $i + 1]));
        }

        // 2. Facilities
        DB::table('web_facilities')->truncate();
        $facilities = [
            ['name' => 'Perpustakaan Representatif', 'description' => 'Koleksi buku lengkap, ruang baca yang nyaman dan mendukung literasi siswa.', 'image_url' => 'web-contents/facility-1.jpg'],
            ['name' => 'Ruang Kelas Modern', 'description' => 'Fasilitas pembelajaran interaktif yang nyaman untuk menunjang kegiatan belajar mengajar.', 'image_url' => 'web-contents/facility-2.jpg'],
            ['name' => 'Laboratorium Penunjang', 'description' => 'Dilengkapi perangkat untuk praktik sains ataupun TIK sebagai penunjang belajar murid.', 'image_url' => 'web-contents/facility-3.jpg'],
            ['name' => 'Mushola / Masjid Madrasah', 'description' => 'Tempat yang luas dan bersih untuk ibadah shalat berjamaah dan kegiatan keagamaan rutinan.', 'image_url' => 'web-contents/facility-4.jpg'],
            ['name' => 'Lingkungan & Lapangan Luas', 'description' => 'Fasilitas berolahraga dan pengembangan fisik untuk senam pagi, upacara, dan kegiatan eskul ekstrakurikuler.', 'image_url' => 'web-contents/facility-5.jpg'],
        ];
        foreach($facilities as $f) {
            WebFacility::create(array_merge($f, ['is_active' => true]));
        }
        
        // 3. Posts
        DB::table('web_posts')->truncate();
        for($i = 1; $i <= 5; $i++) {
            WebPost::create([
                'title' => 'Keseruan Kegiatan Madrasah Bagian ' . $i,
                'slug' => 'kegiatan-madrasah-' . $i,
                'content' => '<p>Alhamdulillah, puji syukur kepada Allah SWT. Ini adalah konten berita panjang mengenai kegiatan seru dan membanggakan dari putra-putri madrasah kita. Kegiatan ini mengajarkan nilai-nilai kerjasama kelompok, ketangkasan, spiritual, dan etika Islami di dalam kehidupan sosial.</p><p>Semoga kegiatan serupa bisa terus dilangsungkan dengan istiqamah sehingga memberikan efek positif bagi psikologis dan tumbuh-kembang anak-anak kita. Aamiin.</p>',
                'excerpt' => 'Ringkasan singkat dari berita kegiatan madrasah yang sangat ditunggu dan menarik minat siswa-siswi.',
                'thumbnail_url' => 'web-contents/post-' . $i . '.jpg',
                'author_id' => 1,
                'is_published' => true,
                'published_at' => now()->subDays($i),
            ]);
        }
        
        // 4. Achievements
        DB::table('web_achievements')->truncate();
        $achievements = [
            ['title' => 'Juara 1 Lomba Tahfidz Al-Qur\'an', 'competition_name' => 'MTQ Tingkat Kabupaten/Kota', 'level' => 'kabupaten', 'student_name' => 'Tim Tahfidz MI MH As-Saodah'],
            ['title' => 'Juara Umum Kepramukaan Siaga', 'competition_name' => 'Jambore Daerah', 'level' => 'provinsi', 'student_name' => 'Regu Garuda & Melati'],
            ['title' => 'Medali Emas Olimpiade Sains', 'competition_name' => 'Olimpiade Sains Nasional', 'level' => 'nasional', 'student_name' => 'Siti Aminah & Kawan'],
            ['title' => 'Juara 2 Lomba Pidato Bahasa Arab', 'competition_name' => 'Gebyar Muharram', 'level' => 'kecamatan', 'student_name' => 'Hasan Al-Farisi'],
            ['title' => 'Juara Favorit Lomba Nasyid', 'competition_name' => 'Festival Seni Islami PAI', 'level' => 'kabupaten', 'student_name' => 'Grup Nasyid As-Saodah'],
        ];
        foreach($achievements as $i => $a) {
            WebAchievement::create(array_merge($a, ['year' => '2026', 'image_url' => 'web-contents/achievement-' . ($i + 1) . '.jpg', 'is_active' => true]));
        }

        // 5. Teachers
        DB::table('web_teachers')->truncate();
        $teachers = [
            ['name' => 'Muchtar Ahmadi, S.Pd.I', 'position' => 'Kepala Madrasah', 'bio' => 'Beliau berdedikasi tinggi terhadap pengelolaan dan peningkatan mutu pendidikan Islam yang maju di lingkungan madrasah.'],
            ['name' => 'Siti Nurhaliza, S.Ag', 'position' => 'Guru Agama / PAI', 'bio' => 'Membimbing dan mengajarkan siswa-siswi dalam memperdalam ilmu tauhid, akidah, dan akhlakul karimah.'],
            ['name' => 'Ahmad Fauzan, S.Pd', 'position' => 'Wali Kelas 6 & Guru Mapel', 'bio' => 'Motivator interaktif yang sangat dekat dengan anak-anak sebagai wali kelas tingkat akhir menjelang kelulusan sekolah.'],
            ['name' => 'Wardah Fitria, S.Pd', 'position' => 'Guru Tematik Terpadu', 'bio' => 'Mengajar berbagai ilmu eksak dan sosial dasar madrasah dengan gaya pendekatan yang menyenangkan dan asik dipahami.'],
            ['name' => 'Irawan Setiadi, S.Or', 'position' => 'Guru Penjaskes', 'bio' => 'Membentuk generasi kuat fisik dan melatih kedisiplinan berolahraga, kebugaran senam pagi, serta pembina kepramukaan utama.'],
        ];
        foreach($teachers as $i => $t) {
            WebTeacher::create(array_merge($t, ['photo_url' => 'web-contents/teacher-' . ($i + 1) . '.jpg', 'is_visible' => true, 'order' => $i + 1]));
        }
    }
}
