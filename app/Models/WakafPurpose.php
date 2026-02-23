<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WakafPurpose extends Model
{
    protected $fillable = [
        'name',
        'description',
        'target_amount',
    ];

    protected $casts = [
        'target_amount' => 'decimal:2',
    ];

    public function transactions()
    {
        return $this->hasMany(GeneralTransaction::class, 'wakaf_purpose_id');
    }

    public function getCollectedAmountAttribute()
    {
        return $this->transactions()->where('status', 'valid')->sum('amount');
    }

    public function getProgressPercentAttribute()
    {
        if (!$this->target_amount || $this->target_amount == 0) return null;
        return min(100, round(($this->collected_amount / $this->target_amount) * 100, 1));
    }
}
