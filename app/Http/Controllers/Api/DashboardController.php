<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CashAccount;
use App\Models\GeneralTransaction;
use App\Models\SppPayment;
use App\Models\StudentSaving;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function summary(Request $request)
    {
        $unitId = $request->query('unit_id');
        $month = $request->query('month', date('m'));
        $year = $request->query('year', date('Y'));

        // Query Total Saldo Kas Sekolah (berdasarkan unit_id jika filter aktif)
        $cashQuery = CashAccount::where('status', 'active');
        if ($unitId) {
            $cashQuery->where('unit_id', $unitId);
        }
        $totalCash = $cashQuery->sum('current_balance');

        // Pemasukan & Pengeluaran Umum (Bulan filter)
        $incomeQuery = GeneralTransaction::where('type', 'income')->where('status', 'active')
            ->whereMonth('transaction_date', $month)
            ->whereYear('transaction_date', $year);

        $expenseQuery = GeneralTransaction::where('type', 'expense')->where('status', 'active')
            ->whereMonth('transaction_date', $month)
            ->whereYear('transaction_date', $year);

        if ($unitId) {
            $incomeQuery->where('unit_id', $unitId);
            $expenseQuery->where('unit_id', $unitId);
        }

        $totalGeneralIncome = $incomeQuery->sum('amount');
        $totalGeneralExpense = $expenseQuery->sum('amount');

        // SPP Masuk (Bulan filter) berdasarkan payment_date
        $sppQuery = SppPayment::where('status', 'active')
            ->whereMonth('payment_date', $month)
            ->whereYear('payment_date', $year);

        if ($unitId) {
            $sppQuery->whereHas('sppBill', function ($q) use ($unitId) {
                $q->where('unit_id', $unitId);
            });
        }
        $totalSppIncome = $sppQuery->sum('amount');

        // Tabungan Siswa Masuk & Keluar (Bulan filter)
        $depositQuery = StudentSaving::where('type', 'deposit')->where('status', 'active')
            ->whereMonth('transaction_date', $month)
            ->whereYear('transaction_date', $year);

        $withdrawQuery = StudentSaving::whereIn('type', ['withdrawal', 'refund'])->where('status', 'active')
            ->whereMonth('transaction_date', $month)
            ->whereYear('transaction_date', $year);

        if ($unitId) {
            $depositQuery->where('unit_id', $unitId);
            $withdrawQuery->where('unit_id', $unitId);
        }

        $totalSavingDeposit = $depositQuery->sum('amount');
        $totalSavingWithdraw = $withdrawQuery->sum('amount');

        return response()->json([
            'status' => 'success',
            'data' => [
                'period' => $year . '-' . str_pad($month, 2, '0', STR_PAD_LEFT),
                'unit_id_filtered' => $unitId,
                'total_cash_balance' => (float)$totalCash,
                'monthly_stats' => [
                    'general_income' => (float)$totalGeneralIncome,
                    'general_expense' => (float)$totalGeneralExpense,
                    'spp_income' => (float)$totalSppIncome,
                    'saving_deposit' => (float)$totalSavingDeposit,
                    'saving_withdrawal' => (float)$totalSavingWithdraw,
                    // Total Pemasukan Bersih bulan ini direpresentasikan dari Spp + Income + Deposit - Withdraw
                    'net_cash_flow_month' => (float)($totalGeneralIncome + $totalSppIncome + $totalSavingDeposit) - ($totalGeneralExpense + $totalSavingWithdraw)
                ]
            ]
        ]);
    }
}