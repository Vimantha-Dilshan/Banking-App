<?php

namespace App\Http\Resources\V1\CustomerManagement;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AccountResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'accountName' => $this->account_name,
            'category' => $this->category,
            'currency' => $this->currency,
            'status' => $this->status,
            'description' => $this->description,
        ];
    }
}
