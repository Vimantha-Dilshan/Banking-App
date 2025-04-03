<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\CustomerDebitCard;
use Illuminate\Database\Eloquent\Factories\Factory;

class DebitCardFactory extends Factory
{
    protected $model = CustomerDebitCard::class;

    public function definition()
    {
        $customer = Customer::factory()->create();

        return [
            'customer_id' => $customer->id,
            'linked_account' => fake()->unique()->numerify('101#########'),
            'card_number' => fake()->creditCardNumber,
            'card_type' => fake()->randomElement([
                CustomerDebitCard::CARD_TYPE_VISA,
                CustomerDebitCard::CARD_TYPE_MASTERCARD,
                CustomerDebitCard::CARD_TYPE_AMEX,
                CustomerDebitCard::CARD_TYPE_DISCOVER,
                CustomerDebitCard::CARD_TYPE_MAESTRO,
                CustomerDebitCard::CARD_TYPE_JCB,
            ]),
            'status' => fake()->randomElement([
                CustomerDebitCard::STATUS_ACTIVE,
                CustomerDebitCard::STATUS_INACTIVE,
                CustomerDebitCard::STATUS_SUSPENDED,
                CustomerDebitCard::STATUS_CLOSED,
            ]),
            'expiry_date' => fake()->date('m/Y', 'now +5 years'),
            'cardholder_name' => strtoupper($customer->first_name.' '.$customer->last_name),
            'notes' => fake()->optional()->sentence(),
        ];
    }
}
