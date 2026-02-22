<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SppBillResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'student_id' => $this->student_id,
            'unit_id' => $this->unit_id,
            'academic_year_id' => $this->academic_year_id,
            'month_period' => $this->month_period,
            'amount' => (float)$this->amount,
            'paid_amount' => (float)$this->paid_amount,
            'status' => $this->status,
            'student' => $this->whenLoaded('student'),
            'unit' => $this->whenLoaded('unit'),
            'academic_year' => $this->whenLoaded('academicYear'),
            'payments' => SppPaymentResource::collection($this->whenLoaded('payments')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}