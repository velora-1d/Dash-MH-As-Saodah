<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSppBillRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'student_id' => 'required|exists:students,id',
            'unit_id' => 'required|exists:units,id',
            'academic_year_id' => 'required|exists:academic_years,id',
            'month_period' => 'required|integer|min:1|max:12',
            'amount' => 'required|numeric|min:1',
        ];
    }
}