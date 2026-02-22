<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentSavingResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'student_id' => $this->student_id,
            'unit_id' => $this->unit_id,
            'cash_account_id' => $this->cash_account_id,
            'user_id' => $this->user_id,
            'type' => $this->type,
            'amount' => (float)$this->amount,
            'transaction_date' => $this->transaction_date,
            'status' => $this->status,
            'student' => $this->whenLoaded('student'),
            'unit' => $this->whenLoaded('unit'),
            'cash_account' => $this->whenLoaded('cashAccount'),
            'user' => $this->whenLoaded('user'),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}