<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTransactionCategoryRequest;
use App\Http\Requests\UpdateTransactionCategoryRequest;
use App\Http\Resources\TransactionCategoryResource;
use App\Repositories\Contracts\TransactionCategoryRepositoryInterface;
use Illuminate\Http\Request;

class TransactionCategoryController extends Controller
{
    protected $repository;

    public function __construct(TransactionCategoryRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        $categories = $this->repository->all(['*'], ['entity']);
        return TransactionCategoryResource::collection($categories);
    }

    public function store(StoreTransactionCategoryRequest $request)
    {
        $category = $this->repository->create($request->validated());
        return new TransactionCategoryResource($category);
    }

    public function show($id)
    {
        $category = $this->repository->getById($id, ['*'], ['entity']);
        return new TransactionCategoryResource($category);
    }

    public function update(UpdateTransactionCategoryRequest $request, $id)
    {
        $category = $this->repository->update($id, $request->validated());
        return new TransactionCategoryResource($category);
    }

    public function destroy($id)
    {
        $this->repository->deleteById($id);
        return response()->json(null, 204);
    }
}