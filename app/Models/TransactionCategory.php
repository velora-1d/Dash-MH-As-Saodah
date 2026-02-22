<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionCategory extends Model
{
    protected $fillable = [
        'type',
        'name',
        'description',
        'is_active',
    ];

    public function transactions()
    {
        return $this->hasMany(GeneralTransaction::class, 'category_id');
    }
}