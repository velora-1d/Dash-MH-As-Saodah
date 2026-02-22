<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClassroomResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'unit_id' => $this->unit_id,
            'academic_year_id' => $this->academic_year_id,
            'name' => $this->name,
            'level' => $this->level,
            'unit' => $this->whenLoaded('unit'),
            'academic_year' => $this->whenLoaded('academicYear'),
            'students' => StudentResource::collection($this->whenLoaded('students')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}