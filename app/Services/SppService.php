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

    /**
     * Bangun data "Kartu Pembayaran" 12 bulan untuk siswa tertentu.
     *
     * @return array{months: array, summary: array}
     */
    public function getStudentPaymentCard(Student $student, AcademicYear $academicYear): array
    {
        // Query semua tagihan siswa di tahun ajaran ini, eager load payments
        $bills = SppBill::where('student_id', $student->id)
            ->where('academic_year_id', $academicYear->id)
            ->with('payments')
            ->get()
            ->keyBy('month');

        // Urutan bulan tahun ajaran: Juli(7) - Juni(6)
        $monthOrder = [7, 8, 9, 10, 11, 12, 1, 2, 3, 4, 5, 6];
        $monthNames = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember',
        ];

        $months = [];
        $totalKewajiban = 0;
        $totalTerbayar = 0;
        $totalTunggakan = 0;
        $bulanBolong = 0;

        foreach ($monthOrder as $m) {
            $bill = $bills->get($m);

            if ($bill) {
                $paid = $bill->payments->sum('amount');
                $months[] = [
                    'month' => $m,
                    'name' => $monthNames[$m],
                    'bill_id' => $bill->id,
                    'nominal' => $bill->nominal,
                    'total_paid' => $paid,
                    'remaining' => max(0, $bill->nominal - $paid),
                    'status' => $bill->status,
                ];

                if ($bill->status !== 'void') {
                    $totalKewajiban += $bill->nominal;
                    $totalTerbayar += $paid;
                    if ($bill->status === 'belum_lunas') {
                        $totalTunggakan += max(0, $bill->nominal - $paid);
                    }
                }
            } else {
                $months[] = [
                    'month' => $m,
                    'name' => $monthNames[$m],
                    'bill_id' => null,
                    'nominal' => 0,
                    'total_paid' => 0,
                    'remaining' => 0,
                    'status' => null,
                ];
                $bulanBolong++;
            }
        }

        return [
            'months' => $months,
            'summary' => [
                'total_kewajiban' => $totalKewajiban,
                'total_terbayar' => $totalTerbayar,
                'total_tunggakan' => $totalTunggakan,
                'bulan_bolong' => $bulanBolong,
            ],
        ];
    }

    /**
     * Generate tagihan untuk beberapa bulan sekaligus (batch).
     *
     * @return int total tagihan yang berhasil dibuat
     */
    public function generateBulkMonthlyBills(AcademicYear $academicYear, array $months, int $year): int
    {
        $total = 0;
        foreach ($months as $month) {
            $total += $this->generateMonthlyBills($academicYear, (int) $month, $year);
        }
        return $total;
    }
}
