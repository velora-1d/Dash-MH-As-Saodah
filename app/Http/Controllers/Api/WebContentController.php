<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\WebSetting;
use App\Models\WebHero;
use App\Models\WebFacility;
use App\Models\WebAchievement;
use App\Models\WebPost;
use App\Models\WebTeacher;
use App\Models\PpdbRegistration;
use App\Models\AcademicYear;
use Illuminate\Http\Request;

class WebContentController extends Controller
{
    /**
     * GET /api/web/settings
     * Ambil semua pengaturan website (dikelompokkan per group).
     */
    public function settings()
    {
        $settings = WebSetting::all()->groupBy('group')->map(function ($group) {
            return $group->pluck('value', 'key');
        });

        // Tambahkan data dari SchoolSettings (seperti nama, logo, dsb) ke dalam kumpulan setting
        $schoolSettings = \App\Models\SchoolSetting::first();
        if ($schoolSettings) {
            // Buat pseudo-group 'school'
            $settings['school'] = collect([
                'name' => $schoolSettings->name,
                'email' => $schoolSettings->email,
                'phone' => $schoolSettings->phone,
                'address' => $schoolSettings->address,
                'logo_url' => $schoolSettings->logo_path ? asset('storage/' . $schoolSettings->logo_path) : null,
            ]);
        }

        return response()->json([
            'status' => 'success',
            'data' => $settings,
        ]);
    }

    /**
     * GET /api/web/heroes
     * Ambil semua slider hero yang aktif.
     */
    public function heroes()
    {
        return response()->json([
            'status' => 'success',
            'data' => WebHero::active()->get(),
        ]);
    }

    /**
     * GET /api/web/facilities
     * Ambil semua fasilitas yang aktif.
     */
    public function facilities()
    {
        return response()->json([
            'status' => 'success',
            'data' => WebFacility::active()->get(),
        ]);
    }

    /**
     * GET /api/web/achievements
     * Ambil semua prestasi (bisa filter berdasarkan level).
     */
    public function achievements(Request $request)
    {
        $query = WebAchievement::active();

        if ($request->has('level')) {
            $query->where('level', $request->level);
        }

        if ($request->has('limit')) {
            $query->limit((int) $request->limit);
        }

        return response()->json([
            'status' => 'success',
            'data' => $query->get(),
        ]);
    }

    /**
     * GET /api/web/posts
     * Ambil daftar berita yang sudah dipublikasikan (dengan paginasi).
     */
    public function posts(Request $request)
    {
        $perPage = $request->get('per_page', 9);

        $posts = WebPost::published()
            ->select(['id', 'title', 'slug', 'excerpt', 'thumbnail_url', 'published_at'])
            ->paginate($perPage);

        return response()->json([
            'status' => 'success',
            'data' => $posts,
        ]);
    }

    /**
     * GET /api/web/posts/{slug}
     * Ambil detail artikel berdasarkan slug.
     */
    public function postDetail(string $slug)
    {
        $post = WebPost::where('slug', $slug)
            ->where('is_published', true)
            ->with('author:id,name')
            ->first();

        if (!$post) {
            return response()->json([
                'status' => 'error',
                'message' => 'Artikel tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $post,
        ]);
    }

    /**
     * GET /api/web/teachers
     * Ambil daftar guru/tenaga pendidik yang ditampilkan di website.
     */
    public function teachers()
    {
        return response()->json([
            'status' => 'success',
            'data' => WebTeacher::visible()->get(),
        ]);
    }

    /**
     * GET /api/web/ppdb/info
     * Ambil informasi PPDB: status, kuota, biaya, jadwal.
     */
    public function ppdbInfo()
    {
        $ppdbSettings = WebSetting::getByGroup('ppdb');

        // Hitung jumlah pendaftar online + offline dari tahun ajaran aktif
        $activeYear = AcademicYear::where('is_active', true)->first();
        $registeredCount = 0;

        if ($activeYear) {
            $registeredCount = PpdbRegistration::withoutGlobalScopes()
                ->where('academic_year_id', $activeYear->id)
                ->count();
        }

        $ppdbSettings['ppdb_registered_count'] = (string) $registeredCount;

        return response()->json([
            'status' => 'success',
            'data' => $ppdbSettings,
        ]);
    }
}
