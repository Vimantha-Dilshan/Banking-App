<?php

namespace App\Http\Resources\V1\CustomerManagement;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LoanResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'loanType' => $this->loan_type,
            'loanAmount' => $this->loan_amount,
            'outstandingBalance' => $this->outstanding_balance,
            'interestRate' => $this->interest_rate,
            'monthlyInstallment' => $this->monthly_installment,
            'startDate' => $this->start_date,
            'endDate' => $this->end_date,
            'status' => $this->status,
            $this->mergeWhen(isset($this->notes), [
                'notes' => $this->notes,
            ]),
        ];
    }
}
