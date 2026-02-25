<?php

namespace App\Http\Controllers\Ppdb;

use App\Http\Controllers\Controller;
use App\Models\PpdbRegistration;
use App\Models\AcademicYear;
use App\Models\Student;
use App\Models\RegistrationPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Exports\PpdbExport;
use Maatwebsite\Excel\Facades\Excel;
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

        $query = PpdbRegistration::with('academicYear', 'reviewer', 'registrationPayment')
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

        // Konfigurasi PPDB dari WebSetting
        $ppdbSettings = [
            'ppdb_is_open' => \App\Models\WebSetting::getValue('ppdb_is_open', '0'),
            'ppdb_year' => \App\Models\WebSetting::getValue('ppdb_year', ''),
            'ppdb_quota' => \App\Models\WebSetting::getValue('ppdb_quota', '0'),
            'ppdb_start_date' => \App\Models\WebSetting::getValue('ppdb_start_date', ''),
            'ppdb_end_date' => \App\Models\WebSetting::getValue('ppdb_end_date', ''),
            'ppdb_registration_fee' => \App\Models\WebSetting::getValue('ppdb_registration_fee', '0'),
            'books_fee' => \App\Models\WebSetting::getValue('books_fee', '0'),
            'uniform_fee' => \App\Models\WebSetting::getValue('uniform_fee', '0'),
        ];

        // Rekap keuangan dari registration_payments tipe PPDB
        $paymentStatsQuery = RegistrationPayment::where('registrationable_type', PpdbRegistration::class);
        if ($activeYear) {
            $paymentStatsQuery->where('academic_year_id', $activeYear->id);
        }
        $paymentStats = [
            'total_fee' => (clone $paymentStatsQuery)->where('is_fee_paid', true)->sum('fee_amount'),
            'total_books' => (clone $paymentStatsQuery)->where('is_books_paid', true)->sum('books_amount'),
            'total_uniform' => (clone $paymentStatsQuery)->where('is_uniform_paid', true)->sum('uniform_amount'),
            'count_fee' => (clone $paymentStatsQuery)->where('is_fee_paid', true)->count(),
            'count_books' => (clone $paymentStatsQuery)->where('is_books_paid', true)->count(),
            'count_uniform' => (clone $paymentStatsQuery)->where('is_uniform_paid', true)->count(),
        ];
        $paymentStats['grand_total'] = $paymentStats['total_fee'] + $paymentStats['total_books'] + $paymentStats['total_uniform'];

        return view('ppdb.index', compact('registrations', 'academicYears', 'activeYear', 'stats', 'ppdbSettings', 'paymentStats'));
    }

    /**
     * Update setting PPDB via AJAX (nominal, buka/tutup).
     */
    public function updateSettings(Request $request)
    {
        if (!in_array(Auth::user()->role, ['kepsek', 'admin', 'superadmin'])) {
            return response()->json(['success' => false, 'message' => 'Akses ditolak'], 403);
        }

        $allowedKeys = [
            'ppdb_is_open', 'ppdb_year', 'ppdb_quota',
            'ppdb_start_date', 'ppdb_end_date',
            'ppdb_registration_fee', 'books_fee', 'uniform_fee',
        ];

        $updated = [];
        foreach ($request->only($allowedKeys) as $key => $value) {
            \App\Models\WebSetting::setValue($key, $value);
            $updated[$key] = $value;
        }

        return response()->json(['success' => true, 'updated' => $updated]);
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
                $ppdb = PpdbRegistration::create($validated);
                
                // Buat record administrasi otomatis di awal
                RegistrationPayment::create([
                    'academic_year_id' => $ppdb->academic_year_id,
                    'registrationable_type' => PpdbRegistration::class,
                    'registrationable_id' => $ppdb->id,
                    'entity_id' => 1, // Default, akan diupdate oleh trait/user scope
                    'unit_id' => 1,
                ]);
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

    public function reset(PpdbRegistration $ppdb)
    {
        try {
            $ppdb->update([
                'status' => 'pending',
                'reviewed_by' => null,
                'reviewed_at' => null,
            ]);
            return redirect()->back()->with('success', 'Status pendaftar "' . $ppdb->student_name . '" berhasil dikembalikan ke Antrean (Pending).');
        } catch (\Exception $e) {
            Log::error('Gagal reset status PPDB: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal mereset status.');
        }
    }

    public function convertToStudent(PpdbRegistration $ppdb)
    {
        if ($ppdb->status !== 'diterima') {
            return redirect()->back()->with('error', 'Hanya pendaftar berstatus "diterima" yang bisa dikonversi.');
        }

        try {
            DB::transaction(function () use ($ppdb) {
                $student = Student::create([
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

                // Buat record pelacakan administrasi pendaftaran
                RegistrationPayment::create([
                    'academic_year_id' => $ppdb->academic_year_id,
                    'registrationable_type' => PpdbRegistration::class,
                    'registrationable_id' => $ppdb->id,
                    'entity_id' => $student->entity_id,
                    'unit_id' => $student->unit_id,
                ]);

                // Update status PPDB menjadi converted
                $ppdb->update(['status' => 'converted']);
            });

            return redirect()->route('ppdb.index')->with('success', 'Pendaftar "' . $ppdb->student_name . '" berhasil dikonversi menjadi siswa aktif.');
        } catch (\Exception $e) {
            Log::error('Gagal konversi PPDB ke siswa: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal mengkonversi data ke siswa.');
        }
    }

    public function export()
    {
        return Excel::download(new PpdbExport, 'data-ppdb-' . date('Y-m-d') . '.xlsx');
    }
}
