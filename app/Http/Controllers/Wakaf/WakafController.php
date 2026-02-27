<?php

namespace App\Http\Controllers\Wakaf;

use App\Http\Controllers\Controller;
use App\Models\CashAccount;
use App\Models\GeneralTransaction;
use App\Models\TransactionCategory;
use App\Models\WakafDonor;
use App\Models\WakafPurpose;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WakafController extends Controller
{
    /**
     * Halaman utama wakaf — daftar transaksi + KPI
     */
    public function index(Request $request)
    {
        $query = GeneralTransaction::with(['wakafDonor', 'wakafPurpose', 'cashAccount', 'category', 'user'])
            ->whereNotNull('wakaf_donor_id')
            ->orderByDesc('date')
            ->orderByDesc('id');

        if ($request->filled('purpose_id')) {
            $query->where('wakaf_purpose_id', $request->purpose_id);
        }

        $transactions = $query->paginate(20);

        // KPI
        $totalWakaf = GeneralTransaction::whereNotNull('wakaf_donor_id')->where('status', 'valid')->sum('amount');
        $totalDonors = WakafDonor::count();
        $totalPurposes = WakafPurpose::count();
        $thisMonth = GeneralTransaction::whereNotNull('wakaf_donor_id')
            ->where('status', 'valid')
            ->whereMonth('date', now()->month)
            ->whereYear('date', now()->year)
            ->sum('amount');

        $purposes = WakafPurpose::all();

        return view('wakaf.index', compact('transactions', 'totalWakaf', 'totalDonors', 'totalPurposes', 'thisMonth', 'purposes'));
    }

    /**
     * Form penerimaan wakaf
     */
    public function create()
    {
        $donors = WakafDonor::orderBy('name')->get();
        $purposes = WakafPurpose::orderBy('name')->get();
        $cashAccounts = CashAccount::orderBy('name')->get();
        $categories = TransactionCategory::where('type', 'in')->orderBy('name')->get();

        return view('wakaf.create', compact('donors', 'purposes', 'cashAccounts', 'categories'));
    }

    /**
     * Simpan penerimaan wakaf
     */
    public function store(Request $request)
    {
        $request->validate([
            'donor_name' => 'required|string|max:255',
            'donor_phone' => 'nullable|string|max:20',
            'amount' => 'required|numeric|min:1000',
            'wakaf_purpose' => 'required|string|max:255',
            'cash_account_id' => 'required|exists:cash_accounts,id',
            'category_id' => 'required|exists:transaction_categories,id',
            'date' => 'required|date',
            'description' => 'nullable|string',
        ]);

        DB::transaction(function () use ($request) {
            // Auto-register donatur jika belum ada
            $donor = WakafDonor::firstOrCreate(
                ['name' => $request->donor_name],
                ['phone' => $request->donor_phone]
            );

            // Update phone kalau berubah
            if ($request->donor_phone && $donor->phone !== $request->donor_phone) {
                $donor->update(['phone' => $request->donor_phone]);
            }

            // Auto-register tujuan wakaf jika belum ada
            $purpose = WakafPurpose::firstOrCreate(
                ['name' => $request->wakaf_purpose]
            );

            // Simpan transaksi wakaf
            GeneralTransaction::create([
                'wakaf_donor_id' => $donor->id,
                'wakaf_purpose_id' => $purpose->id,
                'category_id' => $request->category_id,
                'cash_account_id' => $request->cash_account_id,
                'user_id' => Auth::id(),
                'type' => 'in',
                'amount' => $request->amount,
                'date' => $request->date,
                'description' => $request->description ?? 'Penerimaan Wakaf dari ' . $donor->name,
                'status' => 'valid',
            ]);

            // Update saldo kas
            $cash = CashAccount::find($request->cash_account_id);
            $cash->increment('balance', $request->amount);
        });

        return redirect()->route('wakaf.index')->with('success', 'Penerimaan wakaf berhasil dicatat.');
    }

    /**
     * Database donatur / muwakif
     */
    public function donors(Request $request)
    {
        $query = WakafDonor::withCount('transactions')
            ->withSum(['transactions as total_donated' => function ($q) {
                $q->where('status', 'valid');
            }], 'amount');

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $donors = $query->orderBy('name')->paginate(20);

        return view('wakaf.donors', compact('donors'));
    }

    /**
     * Master tujuan wakaf
     */
    public function purposes()
    {
        $purposes = WakafPurpose::withCount('transactions')
            ->withSum(['transactions as collected' => function ($q) {
                $q->where('status', 'valid');
            }], 'amount')
            ->orderBy('name')->get();

        return view('wakaf.purposes', compact('purposes'));
    }

    /**
     * Simpan tujuan wakaf baru
     */
    public function storePurpose(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'target_amount' => 'nullable|numeric|min:0',
        ]);

        WakafPurpose::create($request->only('name', 'description', 'target_amount'));

        return redirect()->route('wakaf.purposes')->with('success', 'Tujuan wakaf berhasil ditambahkan.');
    }

    /**
     * Hapus tujuan wakaf
     */
    public function destroyPurpose(WakafPurpose $purpose)
    {
        if ($purpose->transactions()->count() > 0) {
            return back()->with('error', 'Tidak bisa menghapus tujuan yang sudah memiliki transaksi.');
        }

        $purpose->delete();
        return redirect()->route('wakaf.purposes')->with('success', 'Tujuan wakaf berhasil dihapus.');
    }

    /**
     * Tampilkan form edit transaksi wakaf
     */
    public function edit(GeneralTransaction $transaction)
    {
        if ($transaction->status === 'void') {
            return redirect()->route('wakaf.index')->with('error', 'Transaksi yang sudah di-void tidak dapat diedit.');
        }

        $donors = WakafDonor::orderBy('name')->get();
        $purposes = WakafPurpose::orderBy('name')->get();
        $cashAccounts = CashAccount::orderBy('name')->get();
        $categories = TransactionCategory::where('type', 'in')->orderBy('name')->get();

        return view('wakaf.edit', compact('transaction', 'donors', 'purposes', 'cashAccounts', 'categories'));
    }

    /**
     * Update data transaksi wakaf
     */
    public function update(Request $request, GeneralTransaction $transaction)
    {
        if ($transaction->status === 'void') {
             return redirect()->route('wakaf.index')->with('error', 'Transaksi yang sudah di-void tidak dapat diedit.');
        }

        $request->validate([
            'donor_name' => 'required|string|max:255',
            'donor_phone' => 'nullable|string|max:20',
            'amount' => 'required|numeric|min:1000',
            'wakaf_purpose' => 'required|string|max:255',
            'cash_account_id' => 'required|exists:cash_accounts,id',
            'category_id' => 'required|exists:transaction_categories,id',
            'date' => 'required|date',
            'description' => 'nullable|string',
        ]);

        DB::transaction(function () use ($request, $transaction) {
            // Register donatur jika belum ada/berubah
            $donor = WakafDonor::firstOrCreate(
                ['name' => $request->donor_name]
            );

            if ($request->donor_phone && $donor->phone !== $request->donor_phone) {
                $donor->update(['phone' => $request->donor_phone]);
            }

            // Register tujuan wakaf jika belum ada
            $purpose = WakafPurpose::firstOrCreate(
                ['name' => $request->wakaf_purpose]
            );

            // Hitung logika saldo uang riil
            $oldAmount = $transaction->amount;
            $oldAccountId = $transaction->cash_account_id;
            $newAmount = $request->amount;
            $newAccountId = $request->cash_account_id;

            if ($oldAccountId == $newAccountId) {
                // Jika kas sama, hitung selisihnya
                $difference = $newAmount - $oldAmount;
                if ($difference != 0) {
                    CashAccount::find($oldAccountId)->increment('balance', $difference);
                }
            } else {
                // Jika pindah akun kas: tarik dari kas lama, masuk ke kas baru
                CashAccount::find($oldAccountId)->decrement('balance', $oldAmount);
                CashAccount::find($newAccountId)->increment('balance', $newAmount);
            }

            // Update transaksi
            $transaction->update([
                'wakaf_donor_id' => $donor->id,
                'wakaf_purpose_id' => $purpose->id,
                'category_id' => $request->category_id,
                'cash_account_id' => $newAccountId,
                'amount' => $newAmount,
                'date' => $request->date,
                'description' => $request->description,
            ]);
        });

        return redirect()->route('wakaf.index')->with('success', 'Transaksi wakaf berhasil diperbarui.');
    }

    /**
     * Hapus permanen transaksi wakaf
     */
    public function destroy(GeneralTransaction $transaction)
    {
        DB::transaction(function () use ($transaction) {
            // Jika transaksi dulunya valid, tarik lagi uangnya dari kas
            if ($transaction->status === 'valid') {
                CashAccount::find($transaction->cash_account_id)?->decrement('balance', $transaction->amount);
            }
            
            $transaction->delete();
        });

        return back()->with('success', 'Transaksi wakaf berhasil dihapus permanen.');
    }
}
