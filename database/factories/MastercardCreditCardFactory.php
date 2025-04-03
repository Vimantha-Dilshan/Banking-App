<?php

namespace Database\Factories;

use App\Models\MastercardCreditCard;
use Illuminate\Database\Eloquent\Factories\Factory;

class MastercardCreditCardFactory extends Factory
{
    protected $model = MastercardCreditCard::class;

    public function definition(): array
    {
        return [
            'card_number' => fake()->creditCardNumber,
            'expiry_date' => fake()->creditCardExpirationDate,
            'cvv' => fake()->randomNumber(3, true),
            'status' => fake()->randomElement([
                MastercardCreditCard::STATUS_AVAILABLE,
                MastercardCreditCard::STATUS_ALLOCATED,
                MastercardCreditCard::STATUS_EXPIRED,
                MastercardCreditCard::STATUS_BLOCKED,
            ]),
        ];
    }
}
