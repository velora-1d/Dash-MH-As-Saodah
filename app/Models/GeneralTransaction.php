<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasUnitIsolation;
use Illuminate\Database\Eloquent\SoftDeletes;

class GeneralTransaction extends Model
{
    use HasUnitIsolation;
    use SoftDeletes;
    protected $fillable = [
        'entity_id',
        'unit_id',
        'category_id',
        'cash_account_id',
        'user_id',
        'wakaf_donor_id',
        'wakaf_purpose_id',
        'type',
        'amount',
        'date',
        'description',
        'status',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'date' => 'date',
    ];

    public function wakafDonor()
    {
        return $this->belongsTo(WakafDonor::class);
    }

    public function wakafPurpose()
    {
        return $this->belongsTo(WakafPurpose::class);
    }

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