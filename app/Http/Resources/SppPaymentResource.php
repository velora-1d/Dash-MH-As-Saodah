<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SppPaymentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'spp_bill_id' => $this->spp_bill_id,
            'cash_account_id' => $this->cash_account_id,
            'user_id' => $this->user_id,
            'amount' => (float)$this->amount,
            'payment_date' => $this->payment_date,
            'status' => $this->status,
            'cash_account' => $this->whenLoaded('cashAccount'),
            'user' => $this->whenLoaded('user'),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}