<?php

namespace App\Services;

use App\Models\Student;
use App\Models\SppBill;
use App\Models\AcademicYear;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class SppService
{
    /**
     * Generate tagihan SPP bulanan untuk siswa.
     */
    public function generateMonthlyBills(AcademicYear $academicYear, int $month, int $year)
    {
        $students = Student::where('status', 'aktif')->get();
        $generatedCount = 0;

        foreach ($students as $student) {
            // Logika: Jangan buat tagihan jika sebelum tanggal masuk
            if ($student->entry_date) {
                $entryDate = Carbon::parse($student->entry_date);
                $billDate = Carbon::create($year, $month, 1)->endOfMonth();
                
                if ($billDate->lt($entryDate)) {
                    continue;
                }
            }

            // Cek apakah tagihan sudah ada
            $exists = SppBill::where('student_id', $student->id)
                ->where('academic_year_id', $academicYear->id)
                ->where('month', $month)
                ->exists();

            if (!$exists) {
                // Gunakan infaq_nominal dari siswa jika ada, atau default dari kelas
                $nominal = $student->infaq_nominal ?? ($student->classroom->infaq_nominal ?? 0);

                SppBill::create([
                    'student_id' => $student->id,
                    'academic_year_id' => $academicYear->id,
                    'month' => $month,
                    'year' => $year,
                    'nominal' => $nominal,
                    'status' => 'belum_lunas',
                    'unit_id' => $student->unit_id,
                    'entity_id' => $student->entity_id,
                ]);
                $generatedCount++;
            }
        }

        return $generatedCount;
    }

    /**
     * Dapatkan ringkasan tunggakan siswa per tahun ajaran.
     */
    public function getStudentArrears(Student $student)
    {
        return SppBill::where('student_id', $student->id)
            ->where('status', 'belum_lunas')
            ->select('academic_year_id', DB::raw('SUM(nominal) as total_tunggakan'))
            ->groupBy('academic_year_id')
            ->with('academicYear')
            ->get();
    }
}
