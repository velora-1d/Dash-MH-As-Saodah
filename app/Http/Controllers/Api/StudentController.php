<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Http\Resources\StudentResource;
use App\Repositories\Contracts\StudentRepositoryInterface;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    protected $repository;

    public function __construct(StudentRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        // Default we get all, possibly with relations like classroom, unit
        $students = $this->repository->all(['*'], ['classroom', 'unit']);
        return StudentResource::collection($students);
    }

    public function store(StoreStudentRequest $request)
    {
        $student = $this->repository->create($request->validated());
        return new StudentResource($student);
    }

    public function show($id)
    {
        $student = $this->repository->getById($id, ['*'], ['classroom', 'unit', 'entity']);
        return new StudentResource($student);
    }

    public function update(UpdateStudentRequest $request, $id)
    {
        $student = $this->repository->update($id, $request->validated());
        return new StudentResource($student);
    }

    public function destroy($id)
    {
        $this->repository->deleteById($id);
        return response()->json(null, 204);
    }
}