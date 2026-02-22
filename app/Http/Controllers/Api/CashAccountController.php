<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCashAccountRequest;
use App\Http\Requests\UpdateCashAccountRequest;
use App\Http\Resources\CashAccountResource;
use App\Repositories\Contracts\CashAccountRepositoryInterface;
use Illuminate\Http\Request;

class CashAccountController extends Controller
{
    protected $repository;

    public function __construct(CashAccountRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        $cashAccounts = $this->repository->all(['*'], ['unit']);
        return CashAccountResource::collection($cashAccounts);
    }

    public function store(StoreCashAccountRequest $request)
    {
        // Fitur keamanan: Saldo awal hanya bisa di-set saat pembuatan, tidak boleh diupdate dari form update.
        $payload = $request->validated();
        $payload['current_balance'] = $payload['initial_balance']; // Saldo saat ini sama dengan awal pada permulaan

        $cashAccount = $this->repository->create($payload);
        return new CashAccountResource($cashAccount);
    }

    public function show($id)
    {
        $cashAccount = $this->repository->getById($id, ['*'], ['unit']);
        return new CashAccountResource($cashAccount);
    }

    public function update(UpdateCashAccountRequest $request, $id)
    {
        $cashAccount = $this->repository->update($id, $request->validated());
        return new CashAccountResource($cashAccount);
    }

    public function destroy($id)
    {
        $this->repository->deleteById($id);
        return response()->json(null, 204);
    }
}