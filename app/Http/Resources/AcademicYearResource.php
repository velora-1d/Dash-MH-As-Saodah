<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AcademicYearResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'entity_id' => $this->entity_id,
            'name' => $this->name,
            'is_active' => $this->is_active,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'entity' => $this->whenLoaded('entity'),
            'classrooms' => ClassroomResource::collection($this->whenLoaded('classrooms')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}