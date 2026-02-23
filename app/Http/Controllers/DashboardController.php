<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\SppBill;
use App\Models\GeneralTransaction;
use App\Models\SppPayment;
use App\Models\AcademicYear;
use App\Models\Classroom;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = $request->user();
        
        if (!$user) {
            return redirect()->route('login');
        }

        $role = $user->role;

        $userScopeUnitIds = \App\Models\UserScope::where('user_id', $user->id)
            ->whereNotNull('unit_id')
            ->pluck('unit_id')
            ->toArray();
            
        $isGlobalAdmin = in_array($role, ['superadmin', 'kepsek', 'bendahara']);

        // KPI 1: Siswa Aktif
        $siswaQuery = Student::query();
        if (!$isGlobalAdmin && !empty($userScopeUnitIds)) {
            $siswaQuery->whereIn('unit_id', $userScopeUnitIds);
        }
        $totalSiswaPa = (clone $siswaQuery)->whereIn('gender', ['L', 'Laki-laki'])->count();
        $totalSiswaPi = (clone $siswaQuery)->whereIn('gender', ['P', 'Perempuan'])->count();
        $totalSiswa = $totalSiswaPa + $totalSiswaPi;

        // KPI 2: Pemasukan Bulan Ini
        $pemasukanBulanIni = 0;
        if (in_array($role, ['kepsek', 'bendahara', 'admin', 'superadmin'])) {
            $pemasukanUmumQuery = GeneralTransaction::where('type', 'in')->whereMonth('date', now()->month);
            $pemasukanSppQuery = SppPayment::whereMonth('date', now()->month);
            
            if (!$isGlobalAdmin && !empty($userScopeUnitIds)) {
                $pemasukanUmumQuery->whereIn('unit_id', $userScopeUnitIds);
                $pemasukanSppQuery->whereHas('sppBill', function($q) use ($userScopeUnitIds) {
                    $q->whereIn('unit_id', $userScopeUnitIds);
                });
            }

            $pemasukanUmum = $pemasukanUmumQuery->sum('amount');
            $pemasukanSpp = $pemasukanSppQuery->sum('amount');
            $pemasukanBulanIni = $pemasukanUmum + $pemasukanSpp;
        }

        // KPI 3 & 4: Kepatuhan & Tunggakan
        $kepatuhanPa = 0; $kepatuhanPi = 0;
        $tunggakanPa = 0; $tunggakanPi = 0;
        $tunggakanPaRp = 0; $tunggakanPiRp = 0;

        if (in_array($role, ['kepsek', 'bendahara', 'admin', 'superadmin'])) {
            $kepatuhanQuery = SppBill::where('status', 'lunas');
            $unpaidQuery = SppBill::where('status', 'belum_lunas');
            
            if (!$isGlobalAdmin && !empty($userScopeUnitIds)) {
                $kepatuhanQuery->whereIn('unit_id', $userScopeUnitIds);
                $unpaidQuery->whereIn('unit_id', $userScopeUnitIds);
            }

            $kepatuhanPa = (clone $kepatuhanQuery)->whereHas('student', function($q) {
                $q->whereIn('gender', ['L', 'Laki-laki']);
            })->count();

            $kepatuhanPi = (clone $kepatuhanQuery)->whereHas('student', function($q) {
                $q->whereIn('gender', ['P', 'Perempuan']);
            })->count();

            // Tunggakan
            $unpaidPa = (clone $unpaidQuery)->whereHas('student', function($q){
                $q->whereIn('gender', ['L', 'Laki-laki']);
            })->get();
            $tunggakanPa = $unpaidPa->groupBy('student_id')->count();
            $tunggakanPaRp = $unpaidPa->sum('nominal');

            $unpaidPi = (clone $unpaidQuery)->whereHas('student', function($q){
                $q->whereIn('gender', ['P', 'Perempuan']);
            })->get();
            $tunggakanPi = $unpaidPi->groupBy('student_id')->count();
            $tunggakanPiRp = $unpaidPi->sum('nominal');
        }

        // KPI 5: PPDB (Data Real dari tabel ppdb_registrations)
        $ppdbQuery = \App\Models\PpdbRegistration::query();
        if (!$isGlobalAdmin && !empty($userScopeUnitIds)) {
            $ppdbQuery->whereIn('unit_id', $userScopeUnitIds);
        }
        $ppdbPending = (clone $ppdbQuery)->where('status', 'pending')->count();
        $ppdbDiterima = (clone $ppdbQuery)->where('status', 'diterima')->count();

        // Grid Tagihan 
        $siswaMenunggakPa = collect([]);
        $siswaMenunggakPi = collect([]);

        if (in_array($role, ['kepsek', 'bendahara', 'admin', 'superadmin'])) {
            $menunggakBaseQuery = Student::whereHas('sppBills', function($q) {
                    $q->where('status', 'belum_lunas');
                })
                ->with(['sppBills' => function($q) {
                    $q->where('status', 'belum_lunas');
                }, 'classroom']);
                
            if (!$isGlobalAdmin && !empty($userScopeUnitIds)) {
                $menunggakBaseQuery->whereIn('unit_id', $userScopeUnitIds);
            }

            $siswaMenunggakPa = (clone $menunggakBaseQuery)->whereIn('gender', ['L', 'Laki-laki'])
                ->take(5)->get()
                ->map(function($student) {
                    $tunggakan = $student->sppBills->sum('nominal');
                    return (object)[
                        'name' => $student->name,
                        'nisn' => $student->nisn,
                        'kelas' => $student->classroom ? $student->classroom->name : '-',
                        'bulan' => $student->sppBills->count(),
                        'nominal' => $tunggakan
                    ];
                });

            $siswaMenunggakPi = (clone $menunggakBaseQuery)->whereIn('gender', ['P', 'Perempuan'])
                ->take(5)->get()
                ->map(function($student) {
                    $tunggakan = $student->sppBills->sum('nominal');
                    return (object)[
                        'name' => $student->name,
                        'nisn' => $student->nisn,
                        'kelas' => $student->classroom ? $student->classroom->name : '-',
                        'bulan' => $student->sppBills->count(),
                        'nominal' => $tunggakan
                    ];
                });
        }

        // Data Chart 1: Arus Kas Tahunan (In & Out) - Per Bulan tahun ini
        $chartCashflow = [];
        if (in_array($role, ['kepsek', 'bendahara', 'admin', 'superadmin'])) {
            $months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
            $currentYear = now()->year;
            $cashflowIn = array_fill(0, 12, 0);
            $cashflowOut = array_fill(0, 12, 0);

            // Fetch Inflow (General + SPP)
            $generalInQuery = GeneralTransaction::where('type', 'in')->whereYear('date', $currentYear);
            $sppInQuery = SppPayment::whereYear('date', $currentYear);
            // Fetch Outflow (General)
            $generalOutQuery = GeneralTransaction::where('type', 'out')->whereYear('date', $currentYear);

            if (!$isGlobalAdmin && !empty($userScopeUnitIds)) {
                $generalInQuery->whereIn('unit_id', $userScopeUnitIds);
                $generalOutQuery->whereIn('unit_id', $userScopeUnitIds);
                $sppInQuery->whereHas('sppBill', function($q) use ($userScopeUnitIds) {
                    $q->whereIn('unit_id', $userScopeUnitIds);
                });
            }

            $generalIn = $generalInQuery
                ->selectRaw('EXTRACT(MONTH FROM date)::int as month, SUM(amount) as total')
                ->groupBy('month')
                ->pluck('total', 'month');

            $sppIn = $sppInQuery
                ->selectRaw('EXTRACT(MONTH FROM date)::int as month, SUM(amount) as total')
                ->groupBy('month')
                ->pluck('total', 'month');

            $generalOut = $generalOutQuery
                ->selectRaw('EXTRACT(MONTH FROM date)::int as month, SUM(amount) as total')
                ->groupBy('month')
                ->pluck('total', 'month');

            for ($i = 0; $i < 12; $i++) {
                $monthNum = $i + 1;
                $cashflowIn[$i] = ($generalIn[$monthNum] ?? 0) + ($sppIn[$monthNum] ?? 0);
                $cashflowOut[$i] = $generalOut[$monthNum] ?? 0;
            }

            $chartCashflow = [
                'labels' => $months,
                'in' => $cashflowIn,
                'out' => $cashflowOut
            ];
        }

        // Data Chart 2: Komposisi Sumber Pemasukan
        $chartSource = [];
        if (in_array($role, ['kepsek', 'bendahara', 'admin', 'superadmin'])) {
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

            $totalSppAll = $sppSourceQuery->sum('amount');
            
            $categoriesIn = $categoriesInQuery
                ->select('transaction_categories.name', DB::raw('SUM(COALESCE(general_transactions.amount, 0)) as total'))
                ->groupBy('transaction_categories.id', 'transaction_categories.name')
                ->get();

            $sourceLabels = ['Pembayaran SPP'];
            $sourceData = [$totalSppAll];
            $sourceColors = ['#6366f1']; // Indigo

            $palette = ['#f59e0b', '#10b981', '#0ea5e9', '#8b5cf6', '#ec4899', '#f43f5e'];
            foreach ($categoriesIn as $index => $cat) {
                if ($cat->total > 0) {
                    $sourceLabels[] = $cat->name;
                    $sourceData[] = $cat->total;
                    $sourceColors[] = $palette[$index % count($palette)];
                }
            }

            // Fallback jika kosong total
            if (empty(array_filter($sourceData))) {
                $sourceLabels = ['Belum Ada Data'];
                $sourceData = [100];
                $sourceColors = ['#cbd5e1'];
            }

            $chartSource = [
                'labels' => $sourceLabels,
                'data' => $sourceData,
                'colors' => $sourceColors
            ];
        }

        // Data Chart 3: Kepatuhan Infaq per Kelas
        $chartCompliance = [];
        if (in_array($role, ['kepsek', 'bendahara', 'admin', 'superadmin'])) {
            $classroomsQuery = Classroom::orderBy('level')->orderBy('name');
            if (!$isGlobalAdmin && !empty($userScopeUnitIds)) {
                $classroomsQuery->whereIn('unit_id', $userScopeUnitIds);
            }
            $classrooms = $classroomsQuery->get();
            
            $compLabels = [];
            $compLunas = [];
            $compNunggak = [];
            
            foreach ($classrooms as $cls) {
                $compLabels[] = $cls->name;
                
                $lunasCount = SppBill::whereHas('student', function($q) use ($cls) {
                    $q->where('classroom_id', $cls->id);
                })->where('status', 'lunas')->count();

                $nunggakCount = SppBill::whereHas('student', function($q) use ($cls) {
                    $q->where('classroom_id', $cls->id);
                })->where('status', 'belum_lunas')->count();

                $compLunas[] = $lunasCount;
                $compNunggak[] = $nunggakCount;
            }

            $chartCompliance = [
                'labels' => $compLabels,
                'lunas' => $compLunas,
                'nunggak' => $compNunggak
            ];
        }

        $academicYearsQuery = AcademicYear::orderBy('name', 'desc');
        if (!$isGlobalAdmin && !empty($userScopeUnitIds)) {
            $academicYearsQuery->whereIn('unit_id', $userScopeUnitIds);
        }
        $academicYears = $academicYearsQuery->get();

        return view('dashboard', compact(
            'academicYears',
            'chartCashflow', 'chartSource', 'chartCompliance',
            'totalSiswa', 'totalSiswaPa', 'totalSiswaPi',
            'pemasukanBulanIni',
            'kepatuhanPa', 'kepatuhanPi',
            'tunggakanPa', 'tunggakanPaRp',
            'tunggakanPi', 'tunggakanPiRp',
            'siswaMenunggakPa', 'siswaMenunggakPi',
            'ppdbPending', 'ppdbDiterima'
        ));
    }
}
