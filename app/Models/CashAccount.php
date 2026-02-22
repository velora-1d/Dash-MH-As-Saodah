<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CashAccount extends Model
{
    protected $fillable = [
        'unit_id',
        'name',
        'initial_balance',
        'current_balance',
        'is_active',
    ];

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
}