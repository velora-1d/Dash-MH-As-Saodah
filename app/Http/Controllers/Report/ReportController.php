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
        // TODO: Logic Jurnal Kas Report
        return view('reports.cash-flow');
    }
}

