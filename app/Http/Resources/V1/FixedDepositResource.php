<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FixedDepositResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'depositAmount' => $this->deposit_amount,
            'interestRate' => $this->interest_rate,
            'depositTerm' => $this->deposit_term,
            'status' => $this->status,
            'startDate' => $this->start_date,
            'maturityDate' => $this->maturity_date,
            'maturityAmount' => $this->maturity_amount,
            'closed' => $this->closed,
            $this->mergeWhen(isset($this->notes), [
                'notes' => $this->notes,
            ]),
        ];
    }
}
