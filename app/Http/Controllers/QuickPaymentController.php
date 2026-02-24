<?php

namespace App\Http\Controllers;

use App\Models\RegistrationPayment;
use Illuminate\Http\Request;

class QuickPaymentController extends Controller
{
    /**
     * Toggle status boolean pada RegistrationPayment via AJAX.
     */
    public function toggle(Request $request, RegistrationPayment $registrationPayment)
    {
        $request->validate([
            'field' => 'required|in:is_fee_paid,is_books_paid,is_books_received,is_uniform_paid,is_uniform_received',
        ]);

        $field = $request->field;
        $newValue = !$registrationPayment->{$field};

        $registrationPayment->update([$field => $newValue]);

        return response()->json([
            'success' => true,
            'field' => $field,
            'value' => $newValue,
        ]);
    }
}
