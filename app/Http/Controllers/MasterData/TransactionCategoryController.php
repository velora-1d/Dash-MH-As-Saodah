<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
use App\Models\TransactionCategory;
use Illuminate\Http\Request;

class TransactionCategoryController extends Controller
{
    public function index()
    {
        $categories = TransactionCategory::orderBy('type')->orderBy('name')->get();
        return view('master-data.transaction-categories.index', compact('categories'));
    }

    public function create()
    {
        return view('master-data.transaction-categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:transaction_categories,name',
            'type' => 'required|in:in,out',
            'description' => 'nullable|string|max:500',
        ]);

        TransactionCategory::create($validated);

        return redirect()->route('transaction-categories.index')
            ->with('success', 'Kategori keuangan berhasil ditambahkan.');
    }

    public function edit(TransactionCategory $transactionCategory)
    {
        return view('master-data.transaction-categories.edit', compact('transactionCategory'));
    }

    public function update(Request $request, TransactionCategory $transactionCategory)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:transaction_categories,name,' . $transactionCategory->id,
            'type' => 'required|in:in,out',
            'description' => 'nullable|string|max:500',
        ]);

        $transactionCategory->update($validated);

        return redirect()->route('transaction-categories.index')
            ->with('success', 'Kategori keuangan berhasil diperbarui.');
    }

    public function destroy(TransactionCategory $transactionCategory)
    {
        if ($transactionCategory->transactions()->count() > 0) {
            return redirect()->route('transaction-categories.index')
                ->with('error', 'Tidak bisa menghapus kategori yang masih memiliki transaksi terkait.');
        }

        $transactionCategory->delete();
        return redirect()->route('transaction-categories.index')
            ->with('success', 'Kategori keuangan berhasil dihapus.');
    }
}
