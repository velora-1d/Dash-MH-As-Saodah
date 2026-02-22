<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCashAccountRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // initial_balance dan current_balance tidak dimasukkan ke update. 
        // current_balance diurus oleh audit/transaksi log.
        return [
            'unit_id' => 'sometimes|required|exists:units,id',
            'name' => 'sometimes|required|string|max:100',
            'is_active' => 'sometimes|required|boolean',
        ];
    }
}