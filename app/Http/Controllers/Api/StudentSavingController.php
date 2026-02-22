<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudentSavingRequest;
use App\Http\Resources\StudentSavingResource;
use App\Repositories\Contracts\StudentSavingRepositoryInterface;
use App\Models\CashAccount;
use App\Models\StudentSaving;
use App\Models\AuditLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentSavingController extends Controller
{
    protected $repository;

    public function __construct(StudentSavingRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        // Support filter by student_id
        $filters = [];
        if ($request->has('student_id')) {
            // Because repository all() might not support direct where, we can use model directly or extend repository
            // For simplicity, returning all loaded. Repositories should ideally receive filter parameters.
            $savings = StudentSaving::with(['student', 'unit', 'cashAccount', 'user'])
                ->where('student_id', $request->student_id)
                ->get();
        }
        else {
            $savings = $this->repository->all(['*'], ['student', 'unit', 'cashAccount', 'user']);
        }

        return StudentSavingResource::collection($savings);
    }

    public function store(StoreStudentSavingRequest $request)
    {
        return DB::transaction(function () use ($request) {
            $data = $request->validated();
            $data['user_id'] = $request->user() ? $request->user()->id : 1;
            $data['status'] = 'active';

            $cashAccount = CashAccount::lockForUpdate()->findOrFail($data['cash_account_id']);

            if ($data['type'] === 'deposit') {
                $cashAccount->current_balance += $data['amount'];
            }
            elseif (in_array($data['type'], ['withdrawal', 'refund'])) {
                // Kalkulasi saldo tabungan siswa saat ini
                $studentBalance = StudentSaving::where('student_id', $data['student_id'])
                    ->where('status', 'active')
                    ->selectRaw("SUM(CASE WHEN type = 'deposit' THEN amount ELSE -amount END) as balance")
                    ->value('balance') ?? 0;

                if ($studentBalance < $data['amount']) {
                    abort(400, "Saldo tabungan siswa tidak mencukupi. (Saldo: {$studentBalance})");
                }

                if ($cashAccount->current_balance < $data['amount']) {
                    abort(400, 'Saldo kas sekolah tidak mencukupi untuk memproses penarikan tabungan.');
                }

                $cashAccount->current_balance -= $data['amount'];
            }

            $cashAccount->save();

            $saving = $this->repository->create($data);
            $saving->load(['student', 'unit', 'cashAccount', 'user']);

            return new StudentSavingResource($saving);
        });
    }

    public function show($id)
    {
        $saving = $this->repository->getById($id, ['*'], ['student', 'unit', 'cashAccount', 'user']);
        return new StudentSavingResource($saving);
    }

    public function destroy(Request $request, $id)
    {
        return DB::transaction(function () use ($request, $id) {
            $saving = $this->repository->getById($id, ['*'], ['unit.entity']);

            if ($saving->status === 'void') {
                abort(400, 'Transaksi tabungan ini sudah di-void.');
            }

            $cashAccount = CashAccount::lockForUpdate()->findOrFail($saving->cash_account_id);

            // Reversing the effect on Cash Account
            if ($saving->type === 'deposit') {
                if ($cashAccount->current_balance < $saving->amount) {
                    abort(400, 'Saldo kas sekolah tidak mencukupi untuk void setoran ini.');
                }
                // Void deposit = uang ditarik kembali dari kas sekolah
                $cashAccount->current_balance -= $saving->amount;
            }
            else {
                // Void withdrawal = uang dikembalikan ke kas sekolah
                $cashAccount->current_balance += $saving->amount;
            }

            $cashAccount->save();

            // Ubah status jadi void
            $saving = $this->repository->update($id, ['status' => 'void']);

            // Catat log
            AuditLog::create([
                'user_id' => $request->user() ? $request->user()->id : 1,
                'entity_id' => $saving->unit->entity_id,
                'unit_id' => $saving->unit_id,
                'action_type' => 'void',
                'resource_type' => 'StudentSaving',
                'resource_id' => $saving->id,
                'payload' => [
                    'reason' => $request->input('reason', 'Void Tabungan via API'),
                    'amount_reversed' => $saving->amount,
                ],
            ]);

            return response()->json(['message' => 'Transaksi tabungan berhasil di-void.']);
        });
    }
}