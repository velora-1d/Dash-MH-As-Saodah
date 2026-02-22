<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentSavingRequest extends FormRequest
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
            'cash_account_id' => 'required|exists:cash_accounts,id',
            'type' => 'required|in:deposit,withdrawal,refund',
            'amount' => 'required|numeric|min:1',
            'transaction_date' => 'required|date',
        ];
    }
}