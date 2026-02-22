<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClassroomRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'unit_id' => 'required|exists:units,id',
            'academic_year_id' => 'required|exists:academic_years,id',
            'name' => 'required|string|max:100',
            'level' => 'required|string|max:50',
        ];
    }
}