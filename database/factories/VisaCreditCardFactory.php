<?php

namespace Database\Factories;

use App\Models\VisaCreditCard;
use Illuminate\Database\Eloquent\Factories\Factory;

class VisaCreditCardFactory extends Factory
{
    protected $model = VisaCreditCard::class;

    public function definition(): array
    {
        return [
            'card_number' => fake()->creditCardNumber,
            'expiry_date' => fake()->creditCardExpirationDate,
            'cvv' => fake()->numerify('###'),
            'status' => fake()->randomElement([
                VisaCreditCard::STATUS_AVAILABLE,
                VisaCreditCard::STATUS_ALLOCATED,
                VisaCreditCard::STATUS_EXPIRED,
                VisaCreditCard::STATUS_BLOCKED,
            ]),
        ];
    }
}
