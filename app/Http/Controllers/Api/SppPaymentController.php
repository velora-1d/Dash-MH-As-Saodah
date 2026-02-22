<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSppPaymentRequest;
use App\Http\Resources\SppPaymentResource;
use App\Repositories\Contracts\SppPaymentRepositoryInterface;
use App\Models\SppBill;
use App\Models\CashAccount;
use App\Models\AuditLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SppPaymentController extends Controller
{
    protected $repository;

    public function __construct(SppPaymentRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function store(StoreSppPaymentRequest $request)
    {
        return DB::transaction(function () use ($request) {
            $data = $request->validated();
            $data['user_id'] = $request->user() ? $request->user()->id : 1;
            $data['status'] = 'active';

            // 1. Lock dan cek Bill
            $bill = SppBill::lockForUpdate()->findOrFail($data['spp_bill_id']);

            if ($bill->status === 'void' || $bill->status === 'paid') {
                abort(400, "Tagihan tidak valid (Sudah Lunas atau Void).");
            }

            $remaining = $bill->amount - $bill->paid_amount;
            if ($data['amount'] > $remaining) {
                abort(400, "Nominal pembayaran melebihi sisa tagihan. Sisa tagihan: {$remaining}");
            }

            // 2. Lock dan tambah saldo Cash Account
            $cashAccount = CashAccount::lockForUpdate()->findOrFail($data['cash_account_id']);
            $cashAccount->current_balance += $data['amount'];
            $cashAccount->save();

            // 3. Update status dan paid_amount Bill
            $bill->paid_amount += $data['amount'];
            $bill->status = ($bill->paid_amount >= $bill->amount) ? 'paid' : 'partial';
            $bill->save();

            // 4. Catat Payment
            $payment = $this->repository->create($data);
            $payment->load(['cashAccount', 'user']);

            return new SppPaymentResource($payment);
        });
    }

    public function show($id)
    {
        $payment = $this->repository->getById($id, ['*'], ['cashAccount', 'user']);
        return new SppPaymentResource($payment);
    }

    public function destroy(Request $request, $id)
    {
        return DB::transaction(function () use ($request, $id) {
            $payment = $this->repository->getById($id, ['*'], ['sppBill.unit.entity']);

            if ($payment->status === 'void') {
                abort(400, 'Pembayaran ini sudah di-void.');
            }

            // Reverse Bill
            $bill = SppBill::lockForUpdate()->findOrFail($payment->spp_bill_id);
            $bill->paid_amount -= $payment->amount;
            $bill->status = ($bill->paid_amount == 0) ? 'unpaid' : 'partial';
            $bill->save();

            // Reverse Cash Account
            $cashAccount = CashAccount::lockForUpdate()->findOrFail($payment->cash_account_id);
            if ($cashAccount->current_balance < $payment->amount) {
                abort(400, 'Saldo kas sekolah tidak mencukupi untuk membatalkan (void) pembayaran ini.');
            }
            $cashAccount->current_balance -= $payment->amount;
            $cashAccount->save();

            // Set Void
            $payment = $this->repository->update($id, ['status' => 'void']);

            // Catat Log
            AuditLog::create([
                'user_id' => $request->user() ? $request->user()->id : 1,
                'entity_id' => $bill->unit->entity_id,
                'unit_id' => $bill->unit_id,
                'action_type' => 'void',
                'resource_type' => 'SppPayment',
                'resource_id' => $payment->id,
                'payload' => [
                    'reason' => $request->input('reason', 'Void pembayaran SPP'),
                    'amount_reversed' => $payment->amount,
                ],
            ]);

            return response()->json(['message' => 'Pembayaran SPP berhasil dibatalkan (void).']);
        });
    }
}