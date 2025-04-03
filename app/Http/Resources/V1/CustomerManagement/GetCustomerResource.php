<?php

namespace App\Http\Resources\V1\CustomerManagement;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GetCustomerResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $mergedAccounts = collect($this->whenLoaded('accounts'))->map(function ($account) {
            return [
                'accountMisc' => AccountResource::make($account),
                'details' => CustomerAccountResource::collection($this->customerAccounts->where('account_id', $account->id)),
            ];
        });

        return [
            'id' => $this->id,
            'firstName' => $this->first_name,
            'lastName' => $this->last_name,
            'occupation' => $this->occupation,
            'employerName' => $this->employer_name,
            'email' => $this->email,
            'phoneNumber' => $this->phone,
            'nic' => $this->national_id,
            'dateOfBirth' => $this->date_of_birth,
            'gender' => $this->gender,
            'vip' => $this->is_vip,
            'discontinued' => $this->disabled,
            'address' => [
                $this->address_line_1,
                $this->address_line_2,
                $this->city,
                $this->province,
                $this->country,
                $this->postal_code,
            ],
            'accounts' => $mergedAccounts,
            'debitCards' => DebitCardResource::collection($this->whenLoaded('debitCards')),
            'fixedDeposits' => FixedDepositResource::collection($this->whenLoaded('fixedDeposits')),
            'creditCards' => CreditCardResource::collection($this->whenLoaded('creditCards')),
            'loans' => LoanResource::collection($this->whenLoaded('loans')),
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
        ];
    }
}
