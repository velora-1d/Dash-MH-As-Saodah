<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'entity_id' => $this->entity_id,
            'unit_id' => $this->unit_id,
            'classroom_id' => $this->classroom_id,
            'nisn' => $this->nisn,
            'name' => $this->name,
            'gender' => $this->gender,
            'parent_phone' => $this->parent_phone,
            'entry_date' => $this->entry_date,
            'status' => $this->status,
            'classroom' => $this->whenLoaded('classroom'),
            'unit' => $this->whenLoaded('unit'),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}