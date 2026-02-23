<?php

namespace App\Http\Controllers\Journal;

use App\Http\Controllers\Controller;
use App\Models\CashAccount;
use App\Models\GeneralTransaction;
use App\Models\TransactionCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CashJournalController extends Controller
{
    /**
     * Dashboard Jurnal Kas Umum (Non-Wakaf)
     */
    public function index(Request $request)
    {
        // Query untuk transaksi UMUM (bukan wakaf)
        $query = GeneralTransaction::with(['cashAccount', 'category', 'user'])
            ->whereNull('wakaf_donor_id')
            ->orderByDesc('date')
            ->orderByDesc('id');

        // Filter berdasarkan Tipe (in/out)
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        // Filter berdasarkan Akun Kas
        if ($request->filled('cash_account_id')) {
            $query->where('cash_account_id', $request->cash_account_id);
        }

        $transactions = $query->paginate(20);

        // KPI Data
        $totalBalance = CashAccount::sum('balance');
        
        $thisMonthIn = GeneralTransaction::whereNull('wakaf_donor_id')
            ->where('status', 'valid')
            ->where('type', 'in')
            ->whereMonth('date', now()->month)
            ->whereYear('date', now()->year)
            ->sum('amount');
            
        $thisMonthOut = GeneralTransaction::whereNull('wakaf_donor_id')
            ->where('status', 'valid')
            ->where('type', 'out')
            ->whereMonth('date', now()->month)
            ->whereYear('date', now()->year)
            ->sum('amount');

        $cashAccounts = CashAccount::orderBy('name')->get();

        return view('journal.index', compact('transactions', 'totalBalance', 'thisMonthIn', 'thisMonthOut', 'cashAccounts'));
    }

    /**
     * Form Transaksi Baru (Pemasukan / Pengeluaran)
     */
    public function create()
    {
        $cashAccounts = CashAccount::orderBy('name')->get();
        // Ambil semua kategori, nanti difilter di frontend dengan AlpineJS atau JS biasa
        $categories = TransactionCategory::orderBy('name')->get();

        return view('journal.create', compact('cashAccounts', 'categories'));
    }

    /**
     * Simpan Transaksi Kas Umum
     */
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:in,out',
            'amount' => 'required|numeric|min:100',
            'cash_account_id' => 'required|exists:cash_accounts,id',
            'category_id' => 'required|exists:transaction_categories,id',
            'date' => 'required|date',
            'description' => 'nullable|string',
        ]);

        $cash = CashAccount::findOrFail($request->cash_account_id);

        // Validasi khusus untuk PENGELUARAN (out)
        if ($request->type === 'out') {
            if ($cash->balance < $request->amount) {
                return back()->withInput()->with('error', 'Saldo kas (' . number_format($cash->balance, 0, ',', '.') . ') tidak mencukupi untuk pengeluaran ini.');
            }
        }

        DB::transaction(function () use ($request, $cash) {
            // Simpan transaksi
            GeneralTransaction::create([
                'category_id' => $request->category_id,
                'cash_account_id' => $request->cash_account_id,
                'user_id' => Auth::id(),
                'type' => $request->type,
                'amount' => $request->amount,
                'date' => $request->date,
                'description' => $request->description,
                'status' => 'valid',
                // Pastikan wakaf ID null
                'wakaf_donor_id' => null,
                'wakaf_purpose_id' => null,
            ]);

            // Update Saldo Kas
            if ($request->type === 'in') {
                $cash->increment('balance', $request->amount);
            } else {
                $cash->decrement('balance', $request->amount);
            }
        });

        $msg = $request->type === 'in' ? 'Pemasukan berhasil dicatat.' : 'Pengeluaran berhasil dicatat.';
        return redirect()->route('journal.index')->with('success', $msg);
    }

    /**
     * Void transaksi (Pembatalan tanpa hapus fisik)
     */
    public function void(GeneralTransaction $transaction)
    {
        // Pastikan ini transaksi umum, bukan wakaf
        if ($transaction->wakaf_donor_id !== null) {
            return back()->with('error', 'Transaksi ini adalah Wakaf, harap void melalui modul Wakaf.');
        }

        if ($transaction->status === 'void') {
            return back()->with('error', 'Transaksi sudah di-void.');
        }

        DB::transaction(function () use ($transaction) {
            $transaction->update(['status' => 'void']);
            
            $cash = CashAccount::find($transaction->cash_account_id);
            if ($cash) {
                // Revert saldo (Kebalikan dari saat store)
                if ($transaction->type === 'in') {
                    $cash->decrement('balance', (float) $transaction->amount);
                } else {
                    $cash->increment('balance', (float) $transaction->amount);
                }
            }
        });

        return back()->with('success', 'Transaksi berhasil di-void dan saldo telah disesuaikan.');
    }

    /**
     * Halaman Master Kategori Jurnal
     */
    public function categories()
    {
        $categories = TransactionCategory::withCount('transactions')
            ->orderBy('type')
            ->orderBy('name')
            ->get();

        return view('journal.categories', compact('categories'));
    }

    /**
     * Simpan Kategori Baru
     */
    public function storeCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:in,out',
            'description' => 'nullable|string',
        ]);

        TransactionCategory::create($request->only('name', 'type', 'description'));

        return redirect()->route('journal.categories')->with('success', 'Kategori baru berhasil ditambahkan.');
    }

    /**
     * Hapus Kategori
     */
    public function destroyCategory(TransactionCategory $category)
    {
        if ($category->transactions()->count() > 0) {
            return back()->with('error', 'Gagal menghapus! Kategori ini sudah digunakan dalam transaksi.');
        }

        $category->delete();
        return redirect()->route('journal.categories')->with('success', 'Kategori berhasil dihapus.');
    }
}
