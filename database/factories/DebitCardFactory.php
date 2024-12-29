<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\DebitCard;
use Illuminate\Database\Eloquent\Factories\Factory;

class DebitCardFactory extends Factory
{
    protected $model = DebitCard::class;

    public function definition()
    {
        $customer = Customer::factory()->create();

        return [
            'customer_id' => $customer->id,
            'linked_account' => fake()->unique()->numerify('101#########'),
            'card_number' => fake()->creditCardNumber,
            'card_type' => fake()->randomElement([
                DebitCard::CARD_TYPE_VISA,
                DebitCard::CARD_TYPE_MASTERCARD,
                DebitCard::CARD_TYPE_AMEX,
                DebitCard::CARD_TYPE_DISCOVER,
                DebitCard::CARD_TYPE_MAESTRO,
                DebitCard::CARD_TYPE_JCB,
            ]),
            'status' => fake()->randomElement([
                DebitCard::STATUS_ACTIVE,
                DebitCard::STATUS_INACTIVE,
                DebitCard::STATUS_SUSPENDED,
                DebitCard::STATUS_CLOSED,
            ]),
            'expiry_date' => fake()->date('m/Y', 'now +5 years'),
            'cardholder_name' => strtoupper($customer->first_name.' '.$customer->last_name),
            'notes' => fake()->optional()->sentence(),
        ];
    }
}
