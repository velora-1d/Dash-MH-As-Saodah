<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionCategoryResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'entity_id' => $this->entity_id,
            'type' => $this->type,
            'name' => $this->name,
            'is_active' => $this->is_active,
            'entity' => $this->whenLoaded('entity'),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}