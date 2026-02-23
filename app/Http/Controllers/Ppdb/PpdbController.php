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
            'nik' => 'nullable|string|max:20|unique:ppdb_registrations,nik',
            'no_kk' => 'nullable|string|max:20',
            'parent_name' => 'nullable|string|max:255',
            'parent_phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'previous_school' => 'nullable|string|max:255',
            'notes' => 'nullable|string',

            // Dapodik Fields
            'family_status' => 'nullable|string|max:50',
            'sibling_count' => 'nullable|integer|min:0',
            'child_position' => 'nullable|integer|min:1',
            'religion' => 'nullable|string|max:50',
            'village' => 'nullable|string|max:255',
            'district' => 'nullable|string|max:255',
            'residence_type' => 'nullable|in:Orang tua,Kerabat,Kos,Lainnya',
            'transportation' => 'nullable|in:Jalan kaki,Motor,Jemputan Sekolah,Kendaraan Umum,Lainnya',
            'student_phone' => 'nullable|string|max:20',
            'height' => 'nullable|integer|min:0',
            'weight' => 'nullable|integer|min:0',
            'distance_to_school' => 'nullable|string|max:50',
            'travel_time' => 'nullable|integer|min:0',
            'father_name' => 'nullable|string|max:255',
            'father_birth_place' => 'nullable|string|max:255',
            'father_birth_date' => 'nullable|date',
            'father_nik' => 'nullable|string|max:20',
            'father_education' => 'nullable|string|max:100',
            'father_occupation' => 'nullable|string|max:100',
            'mother_name' => 'nullable|string|max:255',
            'mother_birth_place' => 'nullable|string|max:255',
            'mother_birth_date' => 'nullable|date',
            'mother_nik' => 'nullable|string|max:20',
            'mother_education' => 'nullable|string|max:100',
            'mother_occupation' => 'nullable|string|max:100',
            'parent_income' => 'nullable|string|max:50',
            'guardian_name' => 'nullable|string|max:255',
            'guardian_birth_place' => 'nullable|string|max:255',
            'guardian_birth_date' => 'nullable|date',
            'guardian_nik' => 'nullable|string|max:20',
            'guardian_education' => 'nullable|string|max:100',
            'guardian_occupation' => 'nullable|string|max:100',
            'guardian_address' => 'nullable|string|max:500',
            'guardian_phone' => 'nullable|string|max:20',
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
                    'birth_date' => $ppdb->birth_date,
                    'birth_place' => $ppdb->birth_place,
                    'nik' => $ppdb->nik,
                    'no_kk' => $ppdb->no_kk,
                    'parent_name' => $ppdb->parent_name,
                    'parent_phone' => $ppdb->parent_phone,
                    'address' => $ppdb->address,
                    'status' => 'aktif',
                    'category' => 'reguler',
                    
                    // Dapodik Fields
                    'family_status' => $ppdb->family_status,
                    'sibling_count' => $ppdb->sibling_count,
                    'child_position' => $ppdb->child_position,
                    'religion' => $ppdb->religion,
                    'village' => $ppdb->village,
                    'district' => $ppdb->district,
                    'residence_type' => $ppdb->residence_type,
                    'transportation' => $ppdb->transportation,
                    'student_phone' => $ppdb->student_phone,
                    'height' => $ppdb->height,
                    'weight' => $ppdb->weight,
                    'distance_to_school' => $ppdb->distance_to_school,
                    'travel_time' => $ppdb->travel_time,
                    'father_name' => $ppdb->father_name,
                    'father_birth_place' => $ppdb->father_birth_place,
                    'father_birth_date' => $ppdb->father_birth_date,
                    'father_nik' => $ppdb->father_nik,
                    'father_education' => $ppdb->father_education,
                    'father_occupation' => $ppdb->father_occupation,
                    'mother_name' => $ppdb->mother_name,
                    'mother_birth_place' => $ppdb->mother_birth_place,
                    'mother_birth_date' => $ppdb->mother_birth_date,
                    'mother_nik' => $ppdb->mother_nik,
                    'mother_education' => $ppdb->mother_education,
                    'mother_occupation' => $ppdb->mother_occupation,
                    'parent_income' => $ppdb->parent_income,
                    'guardian_name' => $ppdb->guardian_name,
                    'guardian_birth_place' => $ppdb->guardian_birth_place,
                    'guardian_birth_date' => $ppdb->guardian_birth_date,
                    'guardian_nik' => $ppdb->guardian_nik,
                    'guardian_education' => $ppdb->guardian_education,
                    'guardian_occupation' => $ppdb->guardian_occupation,
                    'guardian_address' => $ppdb->guardian_address,
                    'guardian_phone' => $ppdb->guardian_phone,
                    'attachments' => $ppdb->attachments,
                ]);
            });

            return redirect()->route('ppdb.index')->with('success', 'Pendaftar "' . $ppdb->student_name . '" berhasil dikonversi menjadi siswa aktif.');
        } catch (\Exception $e) {
            Log::error('Gagal konversi PPDB ke siswa: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal mengkonversi data ke siswa.');
        }
    }
}
