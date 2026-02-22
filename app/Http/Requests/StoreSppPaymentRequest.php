<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSppPaymentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'spp_bill_id' => 'required|exists:spp_bills,id',
            'cash_account_id' => 'required|exists:cash_accounts,id',
            'amount' => 'required|numeric|min:1',
            'payment_date' => 'required|date',
        ];
    }
}