<?php

namespace App\Http\Controllers\ReRegistration;

use App\Http\Controllers\Controller;
use App\Models\ReRegistration;
use App\Models\AcademicYear;
use App\Models\Student;
use App\Models\Classroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ReRegistrationController extends Controller
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

        $query = ReRegistration::with('student.classroom', 'academicYear', 'confirmedByUser', 'registrationPayment');

        if ($activeYear) {
            $query->where('academic_year_id', $activeYear->id);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Hitung statistik dari query clone sebelum paginate
        $statsQuery = clone $query;
        $stats = [
            'total' => $statsQuery->count(),
            'confirmed' => (clone $statsQuery)->where('status', 'confirmed')->count(),
            'pending' => (clone $statsQuery)->where('status', 'pending')->count(),
            'not_registered' => (clone $statsQuery)->where('status', 'not_registered')->count(),
        ];

        $registrations = $query->paginate(15)->withQueryString();
        $classrooms = Classroom::orderBy('name')->get();

        // Setting nominal daftar ulang dari WebSetting
        $reRegSettings = [
            're_registration_fee' => \App\Models\WebSetting::getValue('re_registration_fee', '0'),
            'books_fee' => \App\Models\WebSetting::getValue('books_fee', '0'),
            'uniform_fee' => \App\Models\WebSetting::getValue('uniform_fee', '0'),
        ];

        // Rekap keuangan dari registration_payments tipe ReRegistration
        $paymentStatsQuery = \App\Models\RegistrationPayment::where('registrationable_type', ReRegistration::class);
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

        return view('re-registration.index', compact('registrations', 'academicYears', 'activeYear', 'stats', 'classrooms', 'reRegSettings', 'paymentStats'));
    }

    /**
     * Update setting nominal daftar ulang via AJAX.
     */
    public function updateSettings(Request $request)
    {
        if (!in_array(\Illuminate\Support\Facades\Auth::user()->role, ['kepsek', 'admin', 'superadmin'])) {
            return response()->json(['success' => false, 'message' => 'Akses ditolak'], 403);
        }

        $allowedKeys = ['re_registration_fee', 'books_fee', 'uniform_fee'];

        $updated = [];
        foreach ($request->only($allowedKeys) as $key => $value) {
            \App\Models\WebSetting::setValue($key, $value);
            $updated[$key] = $value;
        }

        return response()->json(['success' => true, 'updated' => $updated]);
    }

    public function generate(Request $request)
    {
        $request->validate([
            'academic_year_id' => 'required|exists:academic_years,id',
        ]);

        try {
            $yearId = $request->academic_year_id;
            $created = 0;

            DB::transaction(function () use ($yearId, &$created) {
                $students = Student::where('status', 'aktif')->get();

                foreach ($students as $student) {
                    $exists = ReRegistration::where('academic_year_id', $yearId)
                        ->where('student_id', $student->id)
                        ->exists();

                    if (!$exists) {
                        $reReg = ReRegistration::create([
                            'academic_year_id' => $yearId,
                            'student_id' => $student->id,
                            'status' => 'pending',
                        ]);
                        
                        // Buat record administrasi otomatis di awal
                        \App\Models\RegistrationPayment::create([
                            'academic_year_id' => $yearId,
                            'registrationable_type' => ReRegistration::class,
                            'registrationable_id' => $reReg->id,
                            'entity_id' => $student->entity_id,
                            'unit_id' => $student->unit_id,
                        ]);

                        $created++;
                    }
                }
            });

            return redirect()->route('re-registration.index', ['academic_year_id' => $yearId])
                ->with('success', "Berhasil generate {$created} data daftar ulang.");
        } catch (\Exception $e) {
            Log::error('Gagal generate daftar ulang: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal generate data daftar ulang. Silakan coba lagi.');
        }
    }

    public function confirm(ReRegistration $reRegistration)
    {
        try {
            $reRegistration->update([
                'status' => 'confirmed',
                'confirmed_by' => Auth::id(),
                'confirmed_at' => now(),
            ]);

            // Buat/pastikan record pelacakan administrasi daftar ulang
            $reRegistration->registrationPayment()->firstOrCreate(
                [
                    'registrationable_type' => ReRegistration::class,
                    'registrationable_id' => $reRegistration->id,
                ],
                [
                    'academic_year_id' => $reRegistration->academic_year_id,
                    'entity_id' => $reRegistration->entity_id,
                    'unit_id' => $reRegistration->unit_id,
                ]
            );

            return redirect()->back()->with('success', 'Daftar ulang siswa "' . $reRegistration->student->name . '" dikonfirmasi.');
        } catch (\Exception $e) {
            Log::error('Gagal konfirmasi daftar ulang: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal mengkonfirmasi daftar ulang.');
        }
    }

    public function markNotRegistered(ReRegistration $reRegistration)
    {
        try {
            $reRegistration->update([
                'status' => 'not_registered',
                'confirmed_by' => Auth::id(),
                'confirmed_at' => now(),
            ]);
            return redirect()->back()->with('success', 'Siswa "' . $reRegistration->student->name . '" ditandai tidak daftar ulang.');
        } catch (\Exception $e) {
            Log::error('Gagal menandai tidak daftar ulang: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal memproses data.');
        }
    }
}
