<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGeneralTransactionRequest;
use App\Http\Resources\GeneralTransactionResource;
use App\Repositories\Contracts\GeneralTransactionRepositoryInterface;
use App\Models\CashAccount;
use App\Models\AuditLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GeneralTransactionController extends Controller
{
    protected $repository;

    public function __construct(GeneralTransactionRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        $transactions = $this->repository->all(['*'], ['unit', 'category', 'cashAccount', 'user']);
        return GeneralTransactionResource::collection($transactions);
    }

    public function store(StoreGeneralTransactionRequest $request)
    {
        return DB::transaction(function () use ($request) {
            $data = $request->validated();
            $data['user_id'] = $request->user() ? $request->user()->id : 1; // Fallback for testing without auth token if needed
            $data['status'] = 'active';

            // Dapatkan Cash Account dan lock untuk update saldo
            $cashAccount = CashAccount::lockForUpdate()->findOrFail($data['cash_account_id']);

            if ($data['type'] === 'income') {
                $cashAccount->current_balance += $data['amount'];
            }
            else {
                if ($cashAccount->current_balance < $data['amount']) {
                    abort(400, 'Saldo kas tidak mencukupi untuk pengeluaran ini.');
                }
                $cashAccount->current_balance -= $data['amount'];
            }
            $cashAccount->save();

            $transaction = $this->repository->create($data);
            $transaction->load(['unit', 'category', 'cashAccount', 'user']);

            return new GeneralTransactionResource($transaction);
        });
    }

    public function show($id)
    {
        $transaction = $this->repository->getById($id, ['*'], ['unit', 'category', 'cashAccount', 'user']);
        return new GeneralTransactionResource($transaction);
    }

    // Metode update dihapus karena transaksi finansial tidak boleh diedit secara langsung (aturan brief).
    // Diganti dengan Void / Soft Delete.

    public function destroy(Request $request, $id)
    {
        return DB::transaction(function () use ($request, $id) {
            $transaction = $this->repository->getById($id, ['*'], ['unit.entity']);

            if ($transaction->status === 'void') {
                abort(400, 'Transaksi ini sudah di-void sebelumnya.');
            }

            // Reverse balance
            $cashAccount = CashAccount::lockForUpdate()->findOrFail($transaction->cash_account_id);
            if ($transaction->type === 'income') {
                // Return money back if it was an income (meaning we lose the money now)
                if ($cashAccount->current_balance < $transaction->amount) {
                    abort(400, 'Saldo kas tidak mencukupi untuk melakukan void atas pemasukan ini.');
                }
                $cashAccount->current_balance -= $transaction->amount;
            }
            else {
                // If it was an expense, voiding means we get the money back
                $cashAccount->current_balance += $transaction->amount;
            }
            $cashAccount->save();

            // Ubah status transaksi menjadi void
            $transaction = $this->repository->update($id, ['status' => 'void']);

            // Catat log
            AuditLog::create([
                'user_id' => $request->user() ? $request->user()->id : 1,
                'entity_id' => $transaction->unit->entity_id,
                'unit_id' => $transaction->unit_id,
                'action_type' => 'void',
                'resource_type' => 'GeneralTransaction',
                'resource_id' => $transaction->id,
                'payload' => [
                    'reason' => $request->input('reason', 'Void via API'),
                    'amount_reversed' => $transaction->amount,
                ],
            ]);

            return response()->json(['message' => 'Transaksi berhasil di-void dan saldo telah disesuaikan.']);
        });
    }
}