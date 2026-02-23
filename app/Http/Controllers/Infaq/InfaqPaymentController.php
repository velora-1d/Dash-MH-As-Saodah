<?php

namespace App\Http\Controllers\Infaq;

use App\Http\Controllers\Controller;
use App\Models\SppBill;
use App\Models\SppPayment;
use App\Models\StudentSaving;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InfaqPaymentController extends Controller
{
    /**
     * Form pembayaran tagihan Infaq.
     */
    public function create(SppBill $bill)
    {
        $bill->load(['student.classroom', 'academicYear']);

        // Hitung saldo tabungan siswa
        $savingsBalance = StudentSaving::getBalance($bill->student_id);

        // Hitung sisa tagihan (nominal - total pembayaran aktif)
        $totalPaid = $bill->payments()->sum('amount');
        $remaining = max(0, $bill->nominal - $totalPaid);

        $months = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];

        return view('infaq.payments.create', compact('bill', 'savingsBalance', 'remaining', 'months'));
    }

    /**
     * Simpan pembayaran tagihan.
     */
    public function store(Request $request, SppBill $bill)
    {
        $request->validate([
            'payment_method' => 'required|in:tunai,transfer,tabungan',
            'amount' => 'required|numeric|min:1000',
            'date' => 'required|date',
        ]);

        $amount = $request->amount;
        $method = $request->payment_method;

        // Validasi tagihan belum lunas
        if ($bill->status === 'lunas') {
            return redirect()->back()->with('error', 'Tagihan ini sudah lunas.');
        }

        // Hitung sisa tagihan
        $totalPaid = $bill->payments()->sum('amount');
        $remaining = $bill->nominal - $totalPaid;

        if ($amount > $remaining) {
            return redirect()->back()->withInput()
                ->with('error', 'Jumlah pembayaran (Rp ' . number_format($amount, 0, ',', '.') . ') melebihi sisa tagihan (Rp ' . number_format($remaining, 0, ',', '.') . ').');
        }

        // Validasi saldo tabungan jika bayar via Potong Tabungan
        if ($method === 'tabungan') {
            $savingsBalance = StudentSaving::getBalance($bill->student_id);
            if ($amount > $savingsBalance) {
                return redirect()->back()->withInput()
                    ->with('error', 'Saldo tabungan tidak mencukupi! Saldo: Rp ' . number_format($savingsBalance, 0, ',', '.'));
            }
        }

        DB::beginTransaction();
        try {
            // 1. Catat pembayaran
            SppPayment::create([
                'bill_id' => $bill->id,
                'payment_method' => $method,
                'amount' => $amount,
                'date' => $request->date,
                'user_id' => Auth::id(),
            ]);

            // 2. Jika via Potong Tabungan, buat mutasi debit di tabungan siswa
            if ($method === 'tabungan') {
                StudentSaving::create([
                    'student_id' => $bill->student_id,
                    'type' => 'out',
                    'amount' => $amount,
                    'date' => $request->date,
                    'description' => 'Potong Tabungan untuk bayar Infaq bulan ' . $bill->month,
                    'status' => 'active',
                    'user_id' => Auth::id(),
                ]);
            }

            // 3. Cek apakah tagihan sudah lunas
            $newTotalPaid = $totalPaid + $amount;
            if ($newTotalPaid >= $bill->nominal) {
                $bill->update(['status' => 'lunas']);
            }

            DB::commit();

            return redirect()->route('infaq.bills.index')
                ->with('success', 'Pembayaran Rp ' . number_format($amount, 0, ',', '.') . ' via ' . ucfirst($method) . ' berhasil dicatat.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()
                ->with('error', 'Gagal menyimpan pembayaran: ' . $e->getMessage());
        }
    }
}
