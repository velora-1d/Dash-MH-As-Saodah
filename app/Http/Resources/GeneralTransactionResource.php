<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GeneralTransactionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'unit_id' => $this->unit_id,
            'category_id' => $this->category_id,
            'cash_account_id' => $this->cash_account_id,
            'user_id' => $this->user_id,
            'type' => $this->type,
            'amount' => (float)$this->amount,
            'transaction_date' => $this->transaction_date,
            'description' => $this->description,
            'status' => $this->status,
            'unit' => $this->whenLoaded('unit'),
            'category' => $this->whenLoaded('category'),
            'cash_account' => $this->whenLoaded('cashAccount'),
            'user' => $this->whenLoaded('user'),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}