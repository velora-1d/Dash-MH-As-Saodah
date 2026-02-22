<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClassroomRequest;
use App\Http\Requests\UpdateClassroomRequest;
use App\Http\Resources\ClassroomResource;
use App\Repositories\Contracts\ClassroomRepositoryInterface;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    protected $repository;

    public function __construct(ClassroomRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        $classrooms = $this->repository->all(['*'], ['unit', 'academicYear']);
        return ClassroomResource::collection($classrooms);
    }

    public function store(StoreClassroomRequest $request)
    {
        $classroom = $this->repository->create($request->validated());
        return new ClassroomResource($classroom);
    }

    public function show($id)
    {
        $classroom = $this->repository->getById($id, ['*'], ['unit', 'academicYear', 'students']);
        return new ClassroomResource($classroom);
    }

    public function update(UpdateClassroomRequest $request, $id)
    {
        $classroom = $this->repository->update($id, $request->validated());
        return new ClassroomResource($classroom);
    }

    public function destroy($id)
    {
        $this->repository->deleteById($id);
        return response()->json(null, 204);
    }
}