<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasUnitIsolation;

use Illuminate\Database\Eloquent\SoftDeletes;

class Inventory extends Model
{
    use HasUnitIsolation;
    use SoftDeletes;

    protected $fillable = [
        'entity_id',
        'unit_id',
        'item_code',
        'name',
        'category',
        'location',
        'quantity',
        'condition',
        'unit_price',
        'acquire_date',
        'notes',
    ];

    public function logs()
    {
        return $this->hasMany(InventoryLog::class);
    }
}
