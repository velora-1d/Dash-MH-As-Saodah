<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SppPayment extends Model
{
    protected $fillable = [
        'spp_bill_id',
        'cash_account_id',
        'user_id',
        'amount',
        'payment_date',
        'status',
    ];

    public function sppBill()
    {
        return $this->belongsTo(SppBill::class);
    }
    public function cashAccount()
    {
        return $this->belongsTo(CashAccount::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}