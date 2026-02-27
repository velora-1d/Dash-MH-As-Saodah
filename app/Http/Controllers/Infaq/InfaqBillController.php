<?php

namespace App\Http\Controllers\Infaq;

use App\Http\Controllers\Controller;
use App\Models\SppBill;
use App\Models\Student;
use App\Models\AcademicYear;
use App\Models\Classroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Exports\InfaqExport;
use Maatwebsite\Excel\Facades\Excel;

class InfaqBillController extends Controller
{
    /**
     * Display a listing of the bills.
     */
    public function index(Request $request)
    {
        $query = SppBill::with(['student.classroom', 'academicYear'])
            ->join('students', 'infaq_bills.student_id', '=', 'students.id')
            ->select('infaq_bills.*'); // Select bills columns to avoid ambiguity

        // Filters
        if ($request->filled('academic_year_id')) {
            $query->where('infaq_bills.academic_year_id', $request->academic_year_id);
        }
        else {
            // Default to active academic year
            $activeYear = AcademicYear::where('is_active', true)->first();
            if ($activeYear) {
                $query->where('infaq_bills.academic_year_id', $activeYear->id);
            }
        }

        if ($request->filled('month')) {
            $query->where('infaq_bills.month', $request->month);
        }

        if ($request->filled('status')) {
            $query->where('infaq_bills.status', $request->status);
        }

        if ($request->filled('classroom_id')) {
            $query->where('students.classroom_id', $request->classroom_id);
        }

        if ($request->filled('search')) {
            $query->where('students.name', 'like', '%' . $request->search . '%');
        }

        $bills = $query->orderBy('infaq_bills.created_at', 'desc')->paginate(20)->withQueryString();

        $academicYears = AcademicYear::orderBy('name', 'desc')->get();
        $classrooms = Classroom::orderBy('level')->orderBy('name')->get();

        return view('infaq.bills.index', compact('bills', 'academicYears', 'classrooms'));
    }

    /**
     * Show the form for generating bills.
     */
    public function createGenerate()
    {
        $academicYears = AcademicYear::where('is_active', true)->get();
        return view('infaq.bills.generate', compact('academicYears'));
    }

    /**
     * Store newly generated bills in storage (multi-month batch support).
     */
    public function storeGenerate(Request $request)
    {
        $request->validate([
            'academic_year_id' => 'required|exists:academic_years,id',
            'months' => 'required|array|min:1',
            'months.*' => 'integer|min:1|max:12',
        ]);

        $academicYearId = $request->academic_year_id;
        $months = $request->months;

        // Fetch academic year to calculate correct calendar year per month
        $academicYear = AcademicYear::findOrFail($academicYearId);
        // Parse start year from academic year name (e.g. "2025/2026 Ganjil" → 2025)
        preg_match('/(\d{4})/', $academicYear->name, $matches);
        $startYear = isset($matches[1]) ? (int)$matches[1] : (int)date('Y');

        // Get all active students with their associated classroom
        $students = Student::with('classroom')->where('status', 'aktif')->get();

        if ($students->isEmpty()) {
            return redirect()->back()->with('error', 'Tidak ada siswa aktif ditemukan.');
        }

        $billsCreated = 0;
        $billsSkipped = 0;

        DB::beginTransaction();

        try {
            foreach ($months as $month) {
                $month = (int)$month;
                // Jul-Dec = startYear, Jan-Jun = startYear + 1
                $billYear = ($month >= 7) ? $startYear : $startYear + 1;

                foreach ($students as $student) {
                    // Check if bill already exists for this student, month, and academic year
                    $exists = SppBill::where('student_id', $student->id)
                        ->where('academic_year_id', $academicYearId)
                        ->where('month', $month)
                        ->exists();

                    if ($exists) {
                        $billsSkipped++;
                        continue;
                    }

                    $nominal = 0;
                    $status = 'belum_lunas';

                    // Determine nominal based on infaq_status
                    if ($student->infaq_status === 'gratis') {
                        $nominal = 0;
                        $status = 'lunas';
                    }
                    elseif ($student->infaq_status === 'subsidi') {
                        $nominal = $student->infaq_nominal ?? 0;
                        if ($nominal <= 0) {
                            $status = 'lunas';
                        }
                    }
                    else {
                        $nominal = $student->classroom ? ($student->classroom->infaq_nominal ?? 0) : 0;
                        if ($nominal <= 0) {
                            $status = 'lunas';
                        }
                    }

                    SppBill::create([
                        'student_id' => $student->id,
                        'academic_year_id' => $academicYearId,
                        'month' => $month,
                        'year' => $billYear,
                        'nominal' => $nominal,
                        'status' => $status,
                    ]);

                    $billsCreated++;
                }
            }

            DB::commit();

            $monthCount = count($months);
            if ($billsCreated > 0) {
                return redirect()->route('infaq.bills.index')->with('success', "Berhasil men-generate {$billsCreated} tagihan Infaq/SPP untuk {$monthCount} bulan.");
            }
            else {
                return redirect()->route('infaq.bills.index')->with('info', "Semua siswa aktif sudah memiliki tagihan untuk bulan yang dipilih. ({$billsSkipped} tagihan dilewati)");
            }

        }
        catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan sistem saat mencoba meng-generate tagihan: ' . $e->getMessage());
        }
    }

    /**
     * Mark a specific bill as void.
     */
    public function void(SppBill $sppBill)
    {
        if ($sppBill->status === 'lunas') {
            return back()->with('error', 'Tagihan yang sudah LUNAS tidak dapat dibatalkan (void).');
        }

        if ($sppBill->status === 'void') {
            return back()->with('error', 'Tagihan ini sudah berstatus void.');
        }

        if ($sppBill->payments()->count() > 0) {
            return back()->with('error', 'Tagihan ini memiliki riwayat pembayaran. Hapus pembayaran terlebih dahulu sebelum me-void tagihan.');
        }

        try {
            DB::beginTransaction();
            $sppBill->update(['status' => 'void']);
            DB::commit();

            return back()->with('success', 'Tagihan berhasil dibatalkan (void).');
        }
        catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal void tagihan: ' . $e->getMessage());
        }
    }

    /**
     * Revert tagihan lunas kembali ke belum_lunas (koreksi salah input).
     */
    public function revert(SppBill $sppBill)
    {
        if ($sppBill->status !== 'lunas') {
            return back()->with('error', 'Hanya tagihan berstatus LUNAS yang bisa di-revert.');
        }

        try {
            DB::beginTransaction();
            $sppBill->update(['status' => 'belum_lunas']);
            DB::commit();

            return back()->with('success', 'Status tagihan berhasil dikembalikan ke Belum Lunas.');
        }
        catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal revert tagihan: ' . $e->getMessage());
        }
    }

    /**
     * Helper to get month name.
     */
    private function getMonthName($monthNumber)
    {
        $months = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];

        return $months[$monthNumber] ?? 'Bulan Tidak Diketahui';
    }

    public function export()
    {
        return Excel::download(new InfaqExport, 'rekap-infaq-' . date('Y-m-d') . '.xlsx');
    }

    /**
     * Tampilkan rekapitulasi SPP 12 bulan untuk satu siswa.
     */
    public function tracking(Student $student)
    {
        // Ambil tahun ajaran aktif
        $activeAcademicYear = AcademicYear::where('is_active', true)->first();
        if (!$activeAcademicYear) {
            return redirect()->route('infaq.bills.index')->with('error', 'Tidak ada Tahun Ajaran yang aktif. Silakan atur terlebih dahulu di menu Setting Tahun Ajaran.');
        }

        // Ambil semua tagihan untuk siswa ini pada tahun ajaran aktif
        $bills = SppBill::where('student_id', $student->id)
            ->where('academic_year_id', $activeAcademicYear->id)
            ->get();

        // Siapkan array 12 bulan dengan default null (belum ada tagihan di-generate)
        // Bulan yang kita track mengikuti tahun ajaran lokal: Juli - Juni
        // Array mapping standar 1-12 supaya mudah diakses di view
        $trackedBills = [];
        for ($i = 1; $i <= 12; $i++) {
            $trackedBills[$i] = $bills->firstWhere('month', $i);
        }

        return view('infaq.bills.tracking', compact('student', 'activeAcademicYear', 'trackedBills'));
    }
}