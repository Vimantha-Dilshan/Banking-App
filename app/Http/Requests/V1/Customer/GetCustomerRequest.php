<?php

namespace App\Http\Requests\V1\Customer;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GetCustomerRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'include' => [
                'nullable',
                'array',
            ],

            'include.*' => [
                'nullable',
                Rule::in(['creditCards', 'debitCards', 'loans', 'accounts', 'fixedDeposits']),
            ],
        ];
    }

    protected function prepareForValidation()
    {
        if (is_string($this->include)) {
            $this->merge([
                'include' => explode(',', $this->include),
            ]);
        }
    }
}
