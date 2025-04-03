<?php

namespace App\Http\Resources\V1\CustomerManagement;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerAccountResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'accountNumber' => $this->account_number,
            'status' => $this->status,
            'availableBalance' => $this->balance,
            'branch' => $this->branch,
            'startDate' => $this->start_date,
            $this->mergeWhen(isset($this->deactivation_date), [
                'deactivationDate' => $this->deactivation_date,
            ]),
            $this->mergeWhen(isset($this->deactivation_reason), [
                'deactivationReason' => $this->deactivation_reason,
            ]),
            $this->mergeWhen(isset($this->notes), [
                'notes' => $this->notes,
            ]),
        ];
    }
}
