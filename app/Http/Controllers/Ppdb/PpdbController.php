<?php

namespace App\Http\Controllers\Ppdb;

use App\Http\Controllers\Controller;
use App\Models\PpdbRegistration;
use App\Models\AcademicYear;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PpdbController extends Controller
{
    public function index(Request $request)
    {
        $academicYears = AcademicYear::orderByDesc('is_active')->orderByDesc('name')->get();

        $activeYear = null;
        if ($request->filled('academic_year_id')) {
            $activeYear = AcademicYear::find($request->academic_year_id);
        } else {
            $activeYear = AcademicYear::where('is_active', true)->first();
        }

        $query = PpdbRegistration::with('academicYear', 'reviewer')
            ->orderByDesc('registered_at');

        if ($activeYear) {
            $query->where('academic_year_id', $activeYear->id);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Hitung statistik sebelum paginate
        $statsQuery = clone $query;
        $stats = [
            'total' => $statsQuery->count(),
            'pending' => (clone $statsQuery)->where('status', 'pending')->count(),
            'diterima' => (clone $statsQuery)->where('status', 'diterima')->count(),
            'ditolak' => (clone $statsQuery)->where('status', 'ditolak')->count(),
        ];

        $registrations = $query->paginate(15)->withQueryString();

        return view('ppdb.index', compact('registrations', 'academicYears', 'activeYear', 'stats'));
    }

    public function create()
    {
        $academicYears = AcademicYear::orderByDesc('is_active')->orderByDesc('name')->get();
        return view('ppdb.create', compact('academicYears'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'academic_year_id' => 'required|exists:academic_years,id',
            'student_name' => 'required|string|max:255',
            'gender' => 'required|in:L,P',
            'birth_date' => 'nullable|date',
            'birth_place' => 'nullable|string|max:255',
            'nik' => 'nullable|string|max:20',
            'no_kk' => 'nullable|string|max:20',
            'parent_name' => 'nullable|string|max:255',
            'parent_phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'previous_school' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ]);

        try {
            DB::transaction(function () use ($validated) {
                $count = PpdbRegistration::where('academic_year_id', $validated['academic_year_id'])->count() + 1;
                $validated['registration_number'] = 'PPDB-' . date('Y') . '-' . str_pad($count, 3, '0', STR_PAD_LEFT);
                $validated['registration_source'] = 'offline';
                PpdbRegistration::create($validated);
            });

            return redirect()->route('ppdb.index')->with('success', 'Pendaftar PPDB berhasil ditambahkan.');
        } catch (\Exception $e) {
            Log::error('Gagal menyimpan pendaftar PPDB: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Gagal menyimpan data. Silakan coba lagi.');
        }
    }

    public function show(PpdbRegistration $ppdb)
    {
        $ppdb->load('academicYear', 'reviewer');
        return view('ppdb.show', compact('ppdb'));
    }

    public function approve(PpdbRegistration $ppdb)
    {
        try {
            $ppdb->update([
                'status' => 'diterima',
                'reviewed_by' => Auth::id(),
                'reviewed_at' => now(),
            ]);
            return redirect()->back()->with('success', 'Pendaftar "' . $ppdb->student_name . '" diterima.');
        } catch (\Exception $e) {
            Log::error('Gagal approve PPDB: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal memproses penerimaan.');
        }
    }

    public function reject(PpdbRegistration $ppdb)
    {
        try {
            $ppdb->update([
                'status' => 'ditolak',
                'reviewed_by' => Auth::id(),
                'reviewed_at' => now(),
            ]);
            return redirect()->back()->with('success', 'Pendaftar "' . $ppdb->student_name . '" ditolak.');
        } catch (\Exception $e) {
            Log::error('Gagal reject PPDB: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal memproses penolakan.');
        }
    }

    public function convertToStudent(PpdbRegistration $ppdb)
    {
        if ($ppdb->status !== 'diterima') {
            return redirect()->back()->with('error', 'Hanya pendaftar berstatus "diterima" yang bisa dikonversi.');
        }

        try {
            DB::transaction(function () use ($ppdb) {
                Student::create([
                    'name' => $ppdb->student_name,
                    'gender' => $ppdb->gender,
                    'nik' => $ppdb->nik,
                    'no_kk' => $ppdb->no_kk,
                    'parent_name' => $ppdb->parent_name,
                    'parent_phone' => $ppdb->parent_phone,
                    'address' => $ppdb->address,
                    'status' => 'aktif',
                    'category' => 'reguler',
                ]);
            });

            return redirect()->route('ppdb.index')->with('success', 'Pendaftar "' . $ppdb->student_name . '" berhasil dikonversi menjadi siswa aktif.');
        } catch (\Exception $e) {
            Log::error('Gagal konversi PPDB ke siswa: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal mengkonversi data ke siswa.');
        }
    }
}
