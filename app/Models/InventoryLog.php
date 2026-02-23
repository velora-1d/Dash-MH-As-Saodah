<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasUnitIsolation;

class InventoryLog extends Model
{
    use HasUnitIsolation;
    protected $fillable = [
        'entity_id',
        'unit_id',
        'inventory_id',
        'action_type',
        'previous_value',
        'new_value',
        'description',
        'user_id',
    ];

    public function inventory()
    {
        return $this->belongsTo(Inventory::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
