<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGeneralTransactionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'unit_id' => 'required|exists:units,id',
            'category_id' => 'required|exists:transaction_categories,id',
            'cash_account_id' => 'required|exists:cash_accounts,id',
            'type' => 'required|in:income,expense',
            'amount' => 'required|numeric|min:1',
            'transaction_date' => 'required|date',
            'description' => 'nullable|string',
        ];
    }
}