<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCashAccountRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'unit_id' => 'required|exists:units,id',
            'name' => 'required|string|max:100',
            'initial_balance' => 'required|numeric|min:0',
            'is_active' => 'required|boolean',
        ];
    }
}