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
        $role = $user->role;

        // KPI 1: Siswa Aktif
        $totalSiswaPa = Student::whereIn('gender', ['L', 'Laki-laki'])->count();
        $totalSiswaPi = Student::whereIn('gender', ['P', 'Perempuan'])->count();
        $totalSiswa = $totalSiswaPa + $totalSiswaPi;

        // KPI 2: Pemasukan Bulan Ini
        $pemasukanBulanIni = 0;
        if (in_array($role, ['kepsek', 'bendahara', 'admin', 'superadmin', 'owner'])) {
            $pemasukanUmum = GeneralTransaction::where('type', 'in')
                ->whereMonth('date', now()->month)
                ->sum('amount');
            $pemasukanSpp = SppPayment::whereMonth('date', now()->month)
                ->sum('amount');
            $pemasukanBulanIni = $pemasukanUmum + $pemasukanSpp;
        }

        // KPI 3 & 4: Kepatuhan & Tunggakan
        $kepatuhanPa = 0; $kepatuhanPi = 0;
        $tunggakanPa = 0; $tunggakanPi = 0;
        $tunggakanPaRp = 0; $tunggakanPiRp = 0;

        if (in_array($role, ['kepsek', 'bendahara', 'admin', 'superadmin', 'owner'])) {
            $kepatuhanPa = SppBill::whereHas('student', function($q) {
                $q->whereIn('gender', ['L', 'Laki-laki']);
            })->where('status', 'lunas')->count();

            $kepatuhanPi = SppBill::whereHas('student', function($q) {
                $q->whereIn('gender', ['P', 'Perempuan']);
            })->where('status', 'lunas')->count();

            // Tunggakan
            $unpaidPa = SppBill::whereHas('student', function($q){
                $q->whereIn('gender', ['L', 'Laki-laki']);
            })->where('status', 'belum_lunas')->get();
            $tunggakanPa = $unpaidPa->groupBy('student_id')->count();
            $tunggakanPaRp = $unpaidPa->sum('nominal');

            $unpaidPi = SppBill::whereHas('student', function($q){
                $q->whereIn('gender', ['P', 'Perempuan']);
            })->where('status', 'belum_lunas')->get();
            $tunggakanPi = $unpaidPi->groupBy('student_id')->count();
            $tunggakanPiRp = $unpaidPi->sum('nominal');
        }

        // KPI 5: PPDB (Placeholder pending table creation)
        $ppdbPending = 0; // Query from future PPDB table
        $ppdbDiterima = 0;

        // Grid Tagihan 
        $siswaMenunggakPa = collect([]);
        $siswaMenunggakPi = collect([]);

        if (in_array($role, ['kepsek', 'bendahara', 'admin', 'superadmin', 'owner'])) {
            $siswaMenunggakPa = Student::whereIn('gender', ['L', 'Laki-laki'])
                ->whereHas('sppBills', function($q) {
                    $q->where('status', 'belum_lunas');
                })
                ->with(['sppBills' => function($q) {
                    $q->where('status', 'belum_lunas');
                }, 'classroom'])
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

            $siswaMenunggakPi = Student::whereIn('gender', ['P', 'Perempuan'])
                ->whereHas('sppBills', function($q) {
                    $q->where('status', 'belum_lunas');
                })
                ->with(['sppBills' => function($q) {
                    $q->where('status', 'belum_lunas');
                }, 'classroom'])
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
        if (in_array($role, ['kepsek', 'bendahara', 'admin', 'superadmin', 'owner'])) {
            $months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
            $currentYear = now()->year;
            $cashflowIn = array_fill(0, 12, 0);
            $cashflowOut = array_fill(0, 12, 0);

            // Fetch Inflow (General + SPP)
            $generalIn = GeneralTransaction::where('type', 'in')
                ->whereYear('date', $currentYear)
                ->selectRaw('EXTRACT(MONTH FROM date)::int as month, SUM(amount) as total')
                ->groupBy('month')
                ->pluck('total', 'month');

            $sppIn = SppPayment::whereYear('date', $currentYear)
                ->selectRaw('EXTRACT(MONTH FROM date)::int as month, SUM(amount) as total')
                ->groupBy('month')
                ->pluck('total', 'month');

            // Fetch Outflow (General)
            $generalOut = GeneralTransaction::where('type', 'out')
                ->whereYear('date', $currentYear)
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
        if (in_array($role, ['kepsek', 'bendahara', 'admin', 'superadmin', 'owner'])) {
            $totalSppAll = SppPayment::sum('amount');
            
            $categoriesIn = DB::table('transaction_categories')
                ->where('transaction_categories.type', 'in')
                ->leftJoin('general_transactions', 'transaction_categories.id', '=', 'general_transactions.category_id')
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
        if (in_array($role, ['kepsek', 'bendahara', 'admin', 'superadmin', 'owner'])) {
            $classrooms = Classroom::orderBy('level')->orderBy('name')->get();
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

        $academicYears = AcademicYear::orderBy('name', 'desc')->get();

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
