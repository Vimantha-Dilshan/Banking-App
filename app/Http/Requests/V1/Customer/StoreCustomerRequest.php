<?php

namespace App\Http\Requests\V1\Customer;

use App\Models\Customer;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCustomerRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'salutation' => [
                'nullable',
                Rule::in(['MR', 'MISS', 'MRS', 'REV']),
            ],
            'firstName' => [
                'required',
                'string',
                'max:255',
            ],
            'lastName' => [
                'required',
                'string',
                'max:255',
            ],
            'occupation' => [
                'nullable',
                'string',
                'max:255',
            ],
            'employerName' => [
                'nullable',
                'string',
                'max:255',
            ],
            'email' => [
                'required',
                'email',
                'unique:customers,email',
            ],
            'phone' => [
                'nullable',
                'string',
                'max:20',
            ],
            'nationalId' => [
                'required',
                'string',
                Rule::unique(Customer::class, 'national_id'),
            ],
            'addressLine1' => [
                'required',
                'string',
                'max:255',
            ],
            'addressLine2' => [
                'nullable',
                'string',
                'max:255',
            ],
            'city' => [
                'required',
                'string',
                'max:255',
            ],
            'postalCode' => [
                'nullable',
                'integer',
            ],
            'province' => [
                'nullable',
                'string',
                'max:255',
            ],
            'country' => [
                'nullable',
                'string',
                'max:255',
            ],
            'dateOfBirth' => [
                'required',
                'date',
            ],
            'gender' => [
                'required',
                Rule::in(['MALE', 'FEMALE', 'OTHER']),
            ],
            'isVip' => [
                'nullable',
                'boolean',
            ],
            'disabled' => [
                'nullable',
                'boolean',
            ],
            'notes' => [
                'nullable',
                'string',
            ],
        ];
    }
}
