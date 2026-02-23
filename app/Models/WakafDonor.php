<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WakafDonor extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'address',
        'notes',
    ];

    public function transactions()
    {
        return $this->hasMany(GeneralTransaction::class, 'wakaf_donor_id');
    }

    public function getTotalDonationAttribute()
    {
        return $this->transactions()->where('status', 'valid')->sum('amount');
    }
}
