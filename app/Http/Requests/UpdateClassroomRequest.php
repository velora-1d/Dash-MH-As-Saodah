<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClassroomRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'unit_id' => 'sometimes|required|exists:units,id',
            'academic_year_id' => 'sometimes|required|exists:academic_years,id',
            'name' => 'sometimes|required|string|max:100',
            'level' => 'sometimes|required|string|max:50',
        ];
    }
}