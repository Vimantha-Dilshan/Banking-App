<?php

namespace App\Http\Resources\V1\CustomerManagement;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CreateCustomerResource extends JsonResource
{
    public function toArray(Request $request): array
    {

        return [
            'salutation' => $this->salutation,
            'firstName' => $this->first_name,
            'lastName' => $this->last_name,
            'occupation' => $this->occupation,
            'employerName' => $this->employer_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'nic' => $this->national_id,
            'addressLine1' => $this->address_line_1,
            'addressLine2' => $this->address_line_2,
            'city' => $this->city,
            'postalCode' => $this->postal_code,
            'province' => $this->province,
            'country' => $this->country,
            'dateOfBirth' => $this->date_of_birth,
            'gender' => $this->gender,
            'isVip' => $this->is_vip,
            'notes' => $this->notes,
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
        ];
    }
}
