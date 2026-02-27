<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        return view('reports.index');
    }

    public function infaq(Request $request)
    {
        // TODO: Logic Infaq Report
        return view('reports.infaq');
    }

    public function registration(Request $request)
    {
        // TODO: Logic PPDB/Daftar Ulang Report
        return view('reports.registration');
    }

    public function savings(Request $request)
    {
        // TODO: Logic Tabungan Report
        return view('reports.savings');
    }

    public function cashFlow(Request $request)
    {
        $month = $request->input('month', now()->month);
        $year = $request->input('year', now()->year);
        $type = $request->input('type'); // 'income', 'expense', atau null (semua)

        $query = \App\Models\GeneralTransaction::with(['category', 'cashAccount'])
            ->where('status', 'active')
            ->whereMonth('date', $month)
            ->whereYear('date', $year);

        if ($type === 'income') {
            $query->where('type', 'income');
        }
        elseif ($type === 'expense') {
            $query->where('type', 'expense');
        }

        $transactions = $query->orderBy('date', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(20)
            ->withQueryString();

        // Hitung aggregate dari SELURUH transaksi bulan/tahun (tanpa filter tipe)
        // agar summary card selalu menampilkan ringkasan penuh
        $baseQuery = \App\Models\GeneralTransaction::where('status', 'active')
            ->whereMonth('date', $month)
            ->whereYear('date', $year);

        $totalIncome = (clone $baseQuery)->where('type', 'income')->sum('amount');
        $totalExpense = (clone $baseQuery)->where('type', 'expense')->sum('amount');
        $balance = $totalIncome - $totalExpense;

        return view('reports.cash-flow', compact(
            'transactions', 'totalIncome', 'totalExpense', 'balance',
            'month', 'year', 'type'
        ));
    }
}