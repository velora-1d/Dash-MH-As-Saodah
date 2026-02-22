<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAcademicYearRequest;
use App\Http\Requests\UpdateAcademicYearRequest;
use App\Http\Resources\AcademicYearResource;
use App\Repositories\Contracts\AcademicYearRepositoryInterface;
use Illuminate\Http\Request;

class AcademicYearController extends Controller
{
    protected $repository;

    public function __construct(AcademicYearRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        $academicYears = $this->repository->all(['*'], ['entity', 'classrooms']);
        return AcademicYearResource::collection($academicYears);
    }

    public function store(StoreAcademicYearRequest $request)
    {
        $academicYear = $this->repository->create($request->validated());
        return new AcademicYearResource($academicYear);
    }

    public function show($id)
    {
        $academicYear = $this->repository->getById($id, ['*'], ['entity', 'classrooms']);
        return new AcademicYearResource($academicYear);
    }

    public function update(UpdateAcademicYearRequest $request, $id)
    {
        $academicYear = $this->repository->update($id, $request->validated());
        return new AcademicYearResource($academicYear);
    }

    public function destroy($id)
    {
        $this->repository->deleteById($id);
        return response()->json(null, 204);
    }
}