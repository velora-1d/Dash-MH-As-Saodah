<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStudentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('student'); // parameter {student} di resource route
        return [
            'entity_id' => 'sometimes|required|exists:entities,id',
            'unit_id' => 'sometimes|required|exists:units,id',
            'classroom_id' => 'sometimes|required|exists:classrooms,id',
            'nisn' => 'sometimes|required|string|unique:students,nisn,' . $id,
            'name' => 'sometimes|required|string|max:255',
            'gender' => 'sometimes|required|in:L,P',
            'parent_phone' => 'nullable|string|max:20',
            'entry_date' => 'sometimes|required|date',
            'status' => 'sometimes|required|in:active,inactive,graduated',
        ];
    }
}