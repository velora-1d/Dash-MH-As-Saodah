<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Dikelola oleh middleware RBAC
    }

    public function rules(): array
    {
        return [
            'entity_id' => 'required|exists:entities,id',
            'unit_id' => 'required|exists:units,id',
            'classroom_id' => 'required|exists:classrooms,id',
            'nisn' => 'required|string|unique:students,nisn',
            'name' => 'required|string|max:255',
            'gender' => 'required|in:L,P',
            'parent_phone' => 'nullable|string|max:20',
            'entry_date' => 'required|date',
            'status' => 'required|in:active,inactive,graduated',
        ];
    }
}