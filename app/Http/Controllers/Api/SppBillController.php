<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSppBillRequest;
use App\Http\Resources\SppBillResource;
use App\Repositories\Contracts\SppBillRepositoryInterface;
use App\Models\AuditLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SppBillController extends Controller
{
    protected $repository;

    public function __construct(SppBillRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        $bills = $this->repository->all(['*'], ['student', 'unit', 'academicYear']);
        return SppBillResource::collection($bills);
    }

    public function store(StoreSppBillRequest $request)
    {
        $data = $request->validated();
        $data['paid_amount'] = 0;
        $data['status'] = 'unpaid';

        $bill = $this->repository->create($data);
        $bill->load(['student', 'unit', 'academicYear']);

        return new SppBillResource($bill);
    }

    public function show($id)
    {
        $bill = $this->repository->getById($id, ['*'], ['student', 'unit', 'academicYear', 'payments']);
        return new SppBillResource($bill);
    }

    public function destroy(Request $request, $id)
    {
        return DB::transaction(function () use ($request, $id) {
            $bill = $this->repository->getById($id, ['*'], ['unit.entity']);

            if ($bill->status === 'void') {
                abort(400, 'Tagihan sudah di-void.');
            }

            if ($bill->paid_amount > 0) {
                abort(400, 'Tidak bisa void tagihan yang sudah memiliki riwayat pembayaran. Void pembayaran terlebih dahulu.');
            }

            $bill = $this->repository->update($id, ['status' => 'void']);

            AuditLog::create([
                'user_id' => $request->user() ? $request->user()->id : 1,
                'entity_id' => $bill->unit->entity_id,
                'unit_id' => $bill->unit_id,
                'action_type' => 'void',
                'resource_type' => 'SppBill',
                'resource_id' => $bill->id,
                'payload' => ['reason' => $request->input('reason', 'Pembatalan tagihan.')],
            ]);

            return response()->json(['message' => 'Tagihan berhasil di-void.']);
        });
    }
}