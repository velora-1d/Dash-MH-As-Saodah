<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasUnitIsolation;

class SppPayment extends Model
{
    use HasUnitIsolation;
    protected $table = 'infaq_payments';

    protected $fillable = [
        'entity_id',
        'unit_id',
        'bill_id',
        'cash_account_id',
        'payment_method',
        'amount',
        'date',
        'user_id',
    ];

    public function sppBill()
    {
        return $this->belongsTo(SppBill::class, 'bill_id');
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