<?php

namespace App\Http\Resources\V1\CustomerManagement;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CreditCardResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'cardNumber' => $this->card_number,
            'cardType' => $this->card_type,
            'status' => $this->status,
            'creditLimit' => $this->credit_limit,
            'availableCredit' => $this->available_credit,
            'outstandingBalance' => $this->outstanding_balance,
            'interestRate' => $this->interest_rate,
            'expiryDate' => $this->expiry_date,
            'cardholderName' => $this->cardholder_name,
            $this->mergeWhen(isset($this->notes), [
                'notes' => $this->notes,
            ]),
        ];
    }
}
