<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CashAccount extends Model
{
    protected $fillable = [
        'name',
        'balance',
    ];

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
}