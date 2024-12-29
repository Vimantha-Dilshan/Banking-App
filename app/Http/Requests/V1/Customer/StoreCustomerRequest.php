<?php

namespace App\Http\Requests\V1\Customer;

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
            'first_name' => [
                'required',
                'string',
                'max:255',
            ],
            'last_name' => [
                'required',
                'string',
                'max:255',
            ],
            'occupation' => [
                'nullable',
                'string',
                'max:255',
            ],
            'employer_name' => [
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
            'national_id' => [
                'required',
                'string',
                'unique:customers,national_id',
            ],
            'address_line_1' => [
                'required',
                'string',
                'max:255',
            ],
            'address_line_2' => [
                'nullable',
                'string',
                'max:255',
            ],
            'city' => [
                'required',
                'string',
                'max:255',
            ],
            'postal_code' => [
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
            'date_of_birth' => [
                'required',
                'date',
            ],
            'gender' => [
                'required',
                Rule::in(['MALE', 'FEMALE', 'OTHER']),
            ],
            'is_vip' => [
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
