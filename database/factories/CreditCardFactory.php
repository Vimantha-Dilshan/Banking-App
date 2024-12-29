<?php

namespace Database\Factories;

use App\Models\CreditCard;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

class CreditCardFactory extends Factory
{
    protected $model = CreditCard::class;

    public function definition()
    {
        $customer = Customer::factory()->create();

        return [
            'customer_id' => $customer->id,
            'card_number' => fake()->creditCardNumber,
            'card_type' => fake()->randomElement([
                CreditCard::CARD_TYPE_VISA,
                CreditCard::CARD_TYPE_MASTERCARD,
                CreditCard::CARD_TYPE_AMEX,
                CreditCard::CARD_TYPE_DISCOVER,
                CreditCard::CARD_TYPE_MAESTRO,
                CreditCard::CARD_TYPE_JCB,
            ]),
            'status' => fake()->randomElement([
                CreditCard::STATUS_ACTIVE,
                CreditCard::STATUS_INACTIVE,
                CreditCard::STATUS_SUSPENDED,
                CreditCard::STATUS_CLOSED,
            ]),
            'credit_limit' => fake()->randomFloat(2, 50000, 5000000),
            'available_credit' => fake()->randomFloat(2, 0, 50000),
            'outstanding_balance' => fake()->randomFloat(2, 0, 50000),
            'interest_rate' => fake()->randomFloat(2, 10, 30),
            'expiry_date' => fake()->date('m/Y', 'now +5 years'),
            'cardholder_name' => strtoupper($customer->first_name.' '.$customer->last_name),
            'notes' => fake()->optional()->sentence(),
        ];
    }
}
