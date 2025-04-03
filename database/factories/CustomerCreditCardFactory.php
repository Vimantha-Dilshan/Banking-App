<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\CustomerCreditCard;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerCreditCardFactory extends Factory
{
    protected $model = CustomerCreditCard::class;

    public function definition()
    {
        $customer = Customer::factory()->create();

        return [
            'customer_id' => $customer->id,
            'card_number' => fake()->creditCardNumber,
            'card_type' => fake()->randomElement([
                CustomerCreditCard::CARD_TYPE_VISA,
                CustomerCreditCard::CARD_TYPE_MASTERCARD,
                CustomerCreditCard::CARD_TYPE_AMEX,
                CustomerCreditCard::CARD_TYPE_DISCOVER,
                CustomerCreditCard::CARD_TYPE_MAESTRO,
                CustomerCreditCard::CARD_TYPE_JCB,
            ]),
            'status' => fake()->randomElement([
                CustomerCreditCard::STATUS_ACTIVE,
                CustomerCreditCard::STATUS_INACTIVE,
                CustomerCreditCard::STATUS_SUSPENDED,
                CustomerCreditCard::STATUS_CLOSED,
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
