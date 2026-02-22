<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GeneralTransaction extends Model
{
    protected $fillable = [
        'unit_id',
        'category_id',
        'cash_account_id',
        'user_id',
        'type',
        'amount',
        'transaction_date',
        'description',
        'status',
    ];

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
    public function category()
    {
        return $this->belongsTo(TransactionCategory::class);
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