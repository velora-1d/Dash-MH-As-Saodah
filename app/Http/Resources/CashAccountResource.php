<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CashAccountResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'unit_id' => $this->unit_id,
            'name' => $this->name,
            'initial_balance' => (float)$this->initial_balance,
            'current_balance' => (float)$this->current_balance,
            'is_active' => $this->is_active,
            'unit' => $this->whenLoaded('unit'),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}