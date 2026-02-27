<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\SppBill;
use App\Models\GeneralTransaction;
use App\Models\SppPayment;
use App\Models\AcademicYear;
use App\Models\Classroom;
use App\Models\Employee;
use App\Models\StudentSaving;
use App\Models\UserScope;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class DashboardController extends Controller
{
    private const CACHE_TTL = 900; // 15 Menit

    public function index(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = $request->user();
        
        if (!$user) {
            return redirect()->route('login');
        }

        $role = $user->role;
        $userScopeUnitIds = UserScope::where('user_id', $user->id)
            ->whereNotNull('unit_id')
            ->pluck('unit_id')
            ->toArray();
            
        $isGlobalAdmin = in_array($role, ['superadmin', 'kepsek', 'bendahara']);

        // Cache Key unik berdasarkan user dan unit scope
        $cacheKey = "dashboard_stats_u{$user->id}_" . md5(serialize($userScopeUnitIds));

        $stats = Cache::remember($cacheKey, self::CACHE_TTL, function () use ($role, $isGlobalAdmin, $userScopeUnitIds) {
            return array_merge(
                [
                    'academicYears' => $this->getAcademicYears($isGlobalAdmin, $userScopeUnitIds),
                    'chartCashflow' => $this->getChartCashflow($role, $isGlobalAdmin, $userScopeUnitIds),
                    'chartSource' => $this->getChartSource($role, $isGlobalAdmin, $userScopeUnitIds),
                    'chartCompliance' => $this->getChartCompliance($role, $isGlobalAdmin, $userScopeUnitIds),
                ],
                $this->getSiswaStats($isGlobalAdmin, $userScopeUnitIds),
                ['pemasukanBulanIni' => $this->getPemasukanBulanIni($role, $isGlobalAdmin, $userScopeUnitIds)],
                $this->getKepatuhanDanTunggakan($role, $isGlobalAdmin, $userScopeUnitIds),
                $this->getPpdbStats($isGlobalAdmin, $userScopeUnitIds),
                $this->getSiswaMenunggak($role, $isGlobalAdmin, $userScopeUnitIds),
                // 5 KPI Baru
                $this->getGuruStaffStats($isGlobalAdmin, $userScopeUnitIds),
                ['pengeluaranBulanIni' => $this->getPengeluaranBulanIni($role, $isGlobalAdmin, $userScopeUnitIds)],
                ['totalSaldoTabungan' => $this->getTotalSaldoTabungan($isGlobalAdmin, $userScopeUnitIds)],
                ['totalWakafMasuk' => $this->getTotalWakafMasuk($role, $isGlobalAdmin, $userScopeUnitIds)],
                $this->getKelasStats($isGlobalAdmin, $userScopeUnitIds),
                // 4 Chart Baru
                ['chartTabunganTren' => $this->getChartTabunganTren($isGlobalAdmin, $userScopeUnitIds)],
                ['chartDistribusiPengeluaran' => $this->getChartDistribusiPengeluaran($role, $isGlobalAdmin, $userScopeUnitIds)],
                ['chartPemasukanVsPengeluaran' => $this->getChartPemasukanVsPengeluaran($role, $isGlobalAdmin, $userScopeUnitIds)],
                ['chartRasioSiswaKelas' => $this->getChartRasioSiswaKelas($isGlobalAdmin, $userScopeUnitIds)]
            );
        });

        return view('dashboard', $stats);
    }

    private function getSiswaStats($isGlobalAdmin, $userScopeUnitIds): array
    {
        $siswaQuery = Student::query();
        if (!$isGlobalAdmin && !empty($userScopeUnitIds)) {
            $siswaQuery->whereIn('unit_id', $userScopeUnitIds);
        }
        $totalSiswaPa = (clone $siswaQuery)->whereIn('gender', ['L', 'Laki-laki'])->count();
        $totalSiswaPi = (clone $siswaQuery)->whereIn('gender', ['P', 'Perempuan'])->count();

        return [
            'totalSiswa' => $totalSiswaPa + $totalSiswaPi,
            'totalSiswaPa' => $totalSiswaPa,
            'totalSiswaPi' => $totalSiswaPi,
        ];
    }

    private function getPemasukanBulanIni($role, $isGlobalAdmin, $userScopeUnitIds): int
    {
        if (!in_array($role, ['kepsek', 'bendahara', 'admin', 'superadmin'])) return 0;

        $pemasukanUmumQuery = GeneralTransaction::where('type', 'in')->whereMonth('date', now()->month);
        $pemasukanSppQuery = SppPayment::whereMonth('date', now()->month);
        
        if (!$isGlobalAdmin && !empty($userScopeUnitIds)) {
            $pemasukanUmumQuery->whereIn('unit_id', $userScopeUnitIds);
            $pemasukanSppQuery->whereHas('sppBill', function($q) use ($userScopeUnitIds) {
                $q->whereIn('unit_id', $userScopeUnitIds);
            });
        }

        return $pemasukanUmumQuery->sum('amount') + $pemasukanSppQuery->sum('amount');
    }

    private function getKepatuhanDanTunggakan($role, $isGlobalAdmin, $userScopeUnitIds): array
    {
        $stats = [
            'kepatuhanPa' => 0, 'kepatuhanPi' => 0,
            'tunggakanPa' => 0, 'tunggakanPaRp' => 0,
            'tunggakanPi' => 0, 'tunggakanPiRp' => 0,
        ];

        if (!in_array($role, ['kepsek', 'bendahara', 'admin', 'superadmin'])) return $stats;

        $kepatuhanQuery = SppBill::where('status', 'lunas');
        $unpaidQuery = SppBill::where('status', 'belum_lunas');
        
        if (!$isGlobalAdmin && !empty($userScopeUnitIds)) {
            $kepatuhanQuery->whereIn('unit_id', $userScopeUnitIds);
            $unpaidQuery->whereIn('unit_id', $userScopeUnitIds);
        }

        $stats['kepatuhanPa'] = (clone $kepatuhanQuery)->whereHas('student', fn($q) => $q->whereIn('gender', ['L', 'Laki-laki']))->count();
        $stats['kepatuhanPi'] = (clone $kepatuhanQuery)->whereHas('student', fn($q) => $q->whereIn('gender', ['P', 'Perempuan']))->count();

        $unpaidPa = (clone $unpaidQuery)->whereHas('student', fn($q) => $q->whereIn('gender', ['L', 'Laki-laki']))->get();
        $stats['tunggakanPa'] = $unpaidPa->groupBy('student_id')->count();
        $stats['tunggakanPaRp'] = $unpaidPa->sum('nominal');

        $unpaidPi = (clone $unpaidQuery)->whereHas('student', fn($q) => $q->whereIn('gender', ['P', 'Perempuan']))->get();
        $stats['tunggakanPi'] = $unpaidPi->groupBy('student_id')->count();
        $stats['tunggakanPiRp'] = $unpaidPi->sum('nominal');

        return $stats;
    }

    private function getPpdbStats($isGlobalAdmin, $userScopeUnitIds): array
    {
        $ppdbQuery = \App\Models\PpdbRegistration::query();
        if (!$isGlobalAdmin && !empty($userScopeUnitIds)) {
            $ppdbQuery->whereIn('unit_id', $userScopeUnitIds);
        }
        
        return [
            'ppdbPending' => (clone $ppdbQuery)->where('status', 'pending')->count(),
            'ppdbDiterima' => (clone $ppdbQuery)->where('status', 'diterima')->count(),
        ];
    }

    private function getSiswaMenunggak($role, $isGlobalAdmin, $userScopeUnitIds): array
    {
        $stats = ['siswaMenunggakPa' => collect([]), 'siswaMenunggakPi' => collect([])];

        if (!in_array($role, ['kepsek', 'bendahara', 'admin', 'superadmin'])) return $stats;

        $menunggakBaseQuery = Student::whereHas('sppBills', function($q) {
                $q->where('status', 'belum_lunas');
            })
            ->with(['sppBills' => function($q) {
                $q->where('status', 'belum_lunas');
            }, 'classroom']);
            
        if (!$isGlobalAdmin && !empty($userScopeUnitIds)) {
            $menunggakBaseQuery->whereIn('unit_id', $userScopeUnitIds);
        }

        $mapStudent = function($student) {
            return (object)[
                'name' => $student->name,
                'nisn' => $student->nisn,
                'kelas' => $student->classroom ? $student->classroom->name : '-',
                'bulan' => $student->sppBills->count(),
                'nominal' => $student->sppBills->sum('nominal')
            ];
        };

        $stats['siswaMenunggakPa'] = (clone $menunggakBaseQuery)->whereIn('gender', ['L', 'Laki-laki'])
            ->take(5)->get()->map($mapStudent);
            
        $stats['siswaMenunggakPi'] = (clone $menunggakBaseQuery)->whereIn('gender', ['P', 'Perempuan'])
            ->take(5)->get()->map($mapStudent);

        return $stats;
    }

    private function getChartCashflow($role, $isGlobalAdmin, $userScopeUnitIds): array
    {
        if (!in_array($role, ['kepsek', 'bendahara', 'admin', 'superadmin'])) return [];

        $currentYear = now()->year;
        
        $generalInQuery = GeneralTransaction::where('type', 'in')->whereYear('date', $currentYear);
        $sppInQuery = SppPayment::whereYear('date', $currentYear);
        $generalOutQuery = GeneralTransaction::where('type', 'out')->whereYear('date', $currentYear);

        if (!$isGlobalAdmin && !empty($userScopeUnitIds)) {
            $generalInQuery->whereIn('unit_id', $userScopeUnitIds);
            $generalOutQuery->whereIn('unit_id', $userScopeUnitIds);
            $sppInQuery->whereHas('sppBill', function($q) use ($userScopeUnitIds) {
                $q->whereIn('unit_id', $userScopeUnitIds);
            });
        }

        $generalIn = $generalInQuery->selectRaw('EXTRACT(MONTH FROM date)::int as month, SUM(amount) as total')
            ->groupBy('month')->pluck('total', 'month');

        $sppIn = $sppInQuery->selectRaw('EXTRACT(MONTH FROM date)::int as month, SUM(amount) as total')
            ->groupBy('month')->pluck('total', 'month');

        $generalOut = $generalOutQuery->selectRaw('EXTRACT(MONTH FROM date)::int as month, SUM(amount) as total')
            ->groupBy('month')->pluck('total', 'month');

        $cashflowIn = [];
        $cashflowOut = [];

        for ($i = 0; $i < 12; $i++) {
            $monthNum = $i + 1;
            $cashflowIn[$i] = ($generalIn[$monthNum] ?? 0) + ($sppIn[$monthNum] ?? 0);
            $cashflowOut[$i] = $generalOut[$monthNum] ?? 0;
        }

        return [
            'labels' => ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
            'in' => $cashflowIn,
            'out' => $cashflowOut
        ];
    }

    private function getChartSource($role, $isGlobalAdmin, $userScopeUnitIds): array
    {
        if (!in_array($role, ['kepsek', 'bendahara', 'admin', 'superadmin'])) return [];

        $sppSourceQuery = SppPayment::query();
        $categoriesInQuery = DB::table('transaction_categories')
            ->where('transaction_categories.type', 'in')
            ->leftJoin('general_transactions', function($join) use ($isGlobalAdmin, $userScopeUnitIds) {
                $join->on('transaction_categories.id', '=', 'general_transactions.category_id');
                if (!$isGlobalAdmin && !empty($userScopeUnitIds)) {
                    $join->whereIn('general_transactions.unit_id', $userScopeUnitIds);
                }
            });
            
        if (!$isGlobalAdmin && !empty($userScopeUnitIds)) {
            $sppSourceQuery->whereHas('sppBill', function($q) use ($userScopeUnitIds) {
                $q->whereIn('unit_id', $userScopeUnitIds);
            });
        }

        $categoriesIn = $categoriesInQuery
            ->select('transaction_categories.name', DB::raw('SUM(COALESCE(general_transactions.amount, 0)) as total'))
            ->groupBy('transaction_categories.id', 'transaction_categories.name')
            ->get();

        $sourceLabels = ['Pembayaran SPP'];
        $sourceData = [$sppSourceQuery->sum('amount')];
        $sourceColors = ['#6366f1']; 

        $palette = ['#f59e0b', '#10b981', '#0ea5e9', '#8b5cf6', '#ec4899', '#f43f5e'];
        foreach ($categoriesIn as $index => $cat) {
            if ($cat->total > 0) {
                $sourceLabels[] = $cat->name;
                $sourceData[] = $cat->total;
                $sourceColors[] = $palette[$index % count($palette)];
            }
        }

        if (empty(array_filter($sourceData))) {
            return [
                'labels' => ['Belum Ada Data'],
                'data' => [100],
                'colors' => ['#cbd5e1']
            ];
        }

        return [
            'labels' => $sourceLabels,
            'data' => $sourceData,
            'colors' => $sourceColors
        ];
    }

    private function getChartCompliance($role, $isGlobalAdmin, $userScopeUnitIds): array
    {
        if (!in_array($role, ['kepsek', 'bendahara', 'admin', 'superadmin'])) return [];

        $classroomsQuery = Classroom::orderBy('level')->orderBy('name');
        if (!$isGlobalAdmin && !empty($userScopeUnitIds)) {
            $classroomsQuery->whereIn('unit_id', $userScopeUnitIds);
        }
        
        // Optimasi: Gunakan satu query join untuk menghitung lunas/nunggak per kelas
        // Ini menghindari N+1 query problem
        $stats = DB::table('classrooms as c')
            ->leftJoin('students as s', 's.classroom_id', '=', 'c.id')
            ->leftJoin('infaq_bills as sb', 'sb.student_id', '=', 's.id')
            ->select(
                'c.name',
                DB::raw("SUM(CASE WHEN sb.status = 'lunas' THEN 1 ELSE 0 END) as lunas_count"),
                DB::raw("SUM(CASE WHEN sb.status = 'belum_lunas' THEN 1 ELSE 0 END) as nunggak_count")
            );

        if (!$isGlobalAdmin && !empty($userScopeUnitIds)) {
            $stats->whereIn('c.unit_id', $userScopeUnitIds);
        }

        $results = $stats->groupBy('c.id', 'c.name', 'c.level')
            ->orderBy('c.level')
            ->orderBy('c.name')
            ->get();

        return [
            'labels' => $results->pluck('name')->toArray(),
            'lunas' => $results->pluck('lunas_count')->toArray(),
            'nunggak' => $results->pluck('nunggak_count')->toArray()
        ];
    }

    private function getAcademicYears($isGlobalAdmin, $userScopeUnitIds)
    {
        $academicYearsQuery = AcademicYear::orderBy('name', 'desc');
        if (!$isGlobalAdmin && !empty($userScopeUnitIds)) {
            $academicYearsQuery->whereIn('unit_id', $userScopeUnitIds);
        }
        return $academicYearsQuery->get();
    }

    // ========== 5 KPI BARU ==========

    private function getGuruStaffStats($isGlobalAdmin, $userScopeUnitIds): array
    {
        $query = Employee::query();
        if (!$isGlobalAdmin && !empty($userScopeUnitIds)) {
            $query->whereIn('unit_id', $userScopeUnitIds);
        }
        $totalGuru  = (clone $query)->where('type', 'guru')->count();
        $totalStaff = (clone $query)->where('type', 'staff')->count();

        return [
            'totalGuru'  => $totalGuru,
            'totalStaff' => $totalStaff,
        ];
    }

    private function getPengeluaranBulanIni($role, $isGlobalAdmin, $userScopeUnitIds): int
    {
        if (!in_array($role, ['kepsek', 'bendahara', 'admin', 'superadmin'])) return 0;

        $query = GeneralTransaction::where('type', 'out')->whereMonth('date', now()->month)->whereYear('date', now()->year);
        if (!$isGlobalAdmin && !empty($userScopeUnitIds)) {
            $query->whereIn('unit_id', $userScopeUnitIds);
        }
        return $query->sum('amount');
    }

    private function getTotalSaldoTabungan($isGlobalAdmin, $userScopeUnitIds): int
    {
        $inQuery  = StudentSaving::where('type', 'in');
        $outQuery = StudentSaving::where('type', 'out');
        if (!$isGlobalAdmin && !empty($userScopeUnitIds)) {
            $inQuery->whereIn('unit_id', $userScopeUnitIds);
            $outQuery->whereIn('unit_id', $userScopeUnitIds);
        }
        return $inQuery->sum('amount') - $outQuery->sum('amount');
    }

    private function getTotalWakafMasuk($role, $isGlobalAdmin, $userScopeUnitIds): int
    {
        if (!in_array($role, ['kepsek', 'bendahara', 'admin', 'superadmin'])) return 0;

        $query = GeneralTransaction::where('type', 'in')
            ->whereNotNull('wakaf_donor_id');
        if (!$isGlobalAdmin && !empty($userScopeUnitIds)) {
            $query->whereIn('unit_id', $userScopeUnitIds);
        }
        return $query->sum('amount');
    }

    private function getKelasStats($isGlobalAdmin, $userScopeUnitIds): array
    {
        $query = Classroom::query();
        if (!$isGlobalAdmin && !empty($userScopeUnitIds)) {
            $query->whereIn('unit_id', $userScopeUnitIds);
        }
        $totalKelas = $query->count();

        // Hitung total siswa yang sudah terdaftar di kelas
        $siswaQuery = Student::whereNotNull('classroom_id');
        if (!$isGlobalAdmin && !empty($userScopeUnitIds)) {
            $siswaQuery->whereIn('unit_id', $userScopeUnitIds);
        }
        $totalSiswaKelas = $siswaQuery->count();

        return [
            'totalKelas'      => $totalKelas,
            'totalSiswaKelas' => $totalSiswaKelas,
        ];
    }

    // ========== 4 CHART BARU ==========

    private function getChartTabunganTren($isGlobalAdmin, $userScopeUnitIds): array
    {
        $currentYear = now()->year;
        $inQuery = StudentSaving::where('type', 'in')->whereYear('date', $currentYear);
        $outQuery = StudentSaving::where('type', 'out')->whereYear('date', $currentYear);
        if (!$isGlobalAdmin && !empty($userScopeUnitIds)) {
            $inQuery->whereIn('unit_id', $userScopeUnitIds);
            $outQuery->whereIn('unit_id', $userScopeUnitIds);
        }
        $monthlyIn = $inQuery->selectRaw("EXTRACT(MONTH FROM date)::int as month, SUM(amount) as total")
            ->groupBy('month')->pluck('total', 'month');
        $monthlyOut = $outQuery->selectRaw("EXTRACT(MONTH FROM date)::int as month, SUM(amount) as total")
            ->groupBy('month')->pluck('total', 'month');

        $saldoIn = []; $saldoOut = [];
        for ($i = 1; $i <= 12; $i++) {
            $saldoIn[] = $monthlyIn[$i] ?? 0;
            $saldoOut[] = $monthlyOut[$i] ?? 0;
        }
        return [
            'labels' => ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'],
            'in' => $saldoIn,
            'out' => $saldoOut
        ];
    }

    private function getChartDistribusiPengeluaran($role, $isGlobalAdmin, $userScopeUnitIds): array
    {
        if (!in_array($role, ['kepsek', 'bendahara', 'admin', 'superadmin'])) return [];

        $currentYear = now()->year;
        $query = GeneralTransaction::where('type', 'out')
            ->whereYear('date', $currentYear)
            ->join('transaction_categories', 'general_transactions.category_id', '=', 'transaction_categories.id')
            ->selectRaw('transaction_categories.name as category, SUM(general_transactions.amount) as total')
            ->groupBy('transaction_categories.name');
        if (!$isGlobalAdmin && !empty($userScopeUnitIds)) {
            $query->whereIn('general_transactions.unit_id', $userScopeUnitIds);
        }
        $data = $query->pluck('total', 'category');
        return [
            'labels' => $data->keys()->toArray(),
            'data' => $data->values()->toArray()
        ];
    }

    private function getChartPemasukanVsPengeluaran($role, $isGlobalAdmin, $userScopeUnitIds): array
    {
        if (!in_array($role, ['kepsek', 'bendahara', 'admin', 'superadmin'])) return [];

        $currentYear = now()->year;
        $inQuery = GeneralTransaction::where('type', 'in')->whereYear('date', $currentYear);
        $outQuery = GeneralTransaction::where('type', 'out')->whereYear('date', $currentYear);
        $sppQuery = SppPayment::whereYear('date', $currentYear);
        if (!$isGlobalAdmin && !empty($userScopeUnitIds)) {
            $inQuery->whereIn('unit_id', $userScopeUnitIds);
            $outQuery->whereIn('unit_id', $userScopeUnitIds);
            $sppQuery->whereHas('sppBill', fn($q) => $q->whereIn('unit_id', $userScopeUnitIds));
        }
        $monthlyIn = $inQuery->selectRaw("EXTRACT(MONTH FROM date)::int as month, SUM(amount) as total")
            ->groupBy('month')->pluck('total', 'month');
        $monthlySpp = $sppQuery->selectRaw("EXTRACT(MONTH FROM date)::int as month, SUM(amount) as total")
            ->groupBy('month')->pluck('total', 'month');
        $monthlyOut = $outQuery->selectRaw("EXTRACT(MONTH FROM date)::int as month, SUM(amount) as total")
            ->groupBy('month')->pluck('total', 'month');

        $dataIn = []; $dataOut = [];
        for ($i = 1; $i <= 12; $i++) {
            $dataIn[] = ($monthlyIn[$i] ?? 0) + ($monthlySpp[$i] ?? 0);
            $dataOut[] = $monthlyOut[$i] ?? 0;
        }
        return [
            'labels' => ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'],
            'in' => $dataIn,
            'out' => $dataOut
        ];
    }

    private function getChartRasioSiswaKelas($isGlobalAdmin, $userScopeUnitIds): array
    {
        $query = Classroom::withCount('students');
        if (!$isGlobalAdmin && !empty($userScopeUnitIds)) {
            $query->whereIn('unit_id', $userScopeUnitIds);
        }
        $kelas = $query->orderBy('name')->get();
        return [
            'labels' => $kelas->pluck('name')->toArray(),
            'data' => $kelas->pluck('students_count')->toArray()
        ];
    }
}
