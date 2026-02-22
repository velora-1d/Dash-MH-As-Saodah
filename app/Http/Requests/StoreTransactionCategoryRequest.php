<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTransactionCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'entity_id' => 'required|exists:entities,id',
            'type' => 'required|in:pemasukan,pengeluaran,spp,tabungan',
            'name' => 'required|string|max:100',
            'is_active' => 'required|boolean',
        ];
    }
}