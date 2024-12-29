<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DebitCardResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'linkedAccount' => $this->linked_account,
            'cardNumber' => $this->card_number,
            'cardType' => $this->card_type,
            'status' => $this->status,
            'expiryDate' => $this->expiry_date,
            'cardholderName' => $this->cardholder_name,
            $this->mergeWhen(isset($this->notes), [
                'notes' => $this->notes,
            ]),
        ];
    }
}
