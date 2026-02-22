<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTransactionCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'entity_id' => 'sometimes|required|exists:entities,id',
            'type' => 'sometimes|required|in:pemasukan,pengeluaran,spp,tabungan',
            'name' => 'sometimes|required|string|max:100',
            'is_active' => 'sometimes|required|boolean',
        ];
    }
}