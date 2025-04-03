<?php

namespace App\Http\Requests\V1\Card;

use App\Models\CardType;
use App\Models\Customer;
use App\Models\CustomerAccount;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class StoreCardRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'customerId' => [
                'required',
                'integer',
                Rule::exists(Customer::class, 'id'),
            ],
            'cardDetails' => [
                'required',
                'array',
            ],
            'cardDetails.debitCard' => [
                'required',
                'boolean',
            ],
            'cardDetails.creditCard' => [
                'required',
                'boolean',
            ],
            'cardDetails.cardType' => [
                'required',
                'string',
                Rule::in([CardType::VISA, CardType::MASTERCARD]),
            ],
            'cardDetails.cardNumber' => [
                'required',
                'string',
                'size:16',
            ],
            'cardDetails.cardHolderName' => [
                'nullable',
                'string',
                'max:255',
            ],
            'cardDetails.notes' => [
                'nullable',
                'string',
                'max:255',
            ],
            'accountDetails' => [
                'required',
                'array',
            ],
            'accountDetails.accountId' => [
                'required',
                'integer',
                Rule::exists(CustomerAccount::class, 'id'),
            ],
        ];
    }

    public function after(): array
    {
        return [
            function (Validator $validator) {
                $debitCard = $this->input('cardDetails.debitCard');
                $creditCard = $this->input('cardDetails.creditCard');

                if (! $debitCard && ! $creditCard) {
                    $validator->errors()->add('cardDetails', 'At least one card type (debitCard or creditCard) must be true.');
                }
            },
        ];
    }
}
