<?php

namespace Database\Factories;

use App\Models\MastercardDebitCard;
use Illuminate\Database\Eloquent\Factories\Factory;

class MastercardDebitCardFactory extends Factory
{
    protected $model = MastercardDebitCard::class;

    public function definition(): array
    {
        return [
            'card_number' => fake()->creditCardNumber,
            'expiry_date' => fake()->creditCardExpirationDate,
            'cvv' => fake()->randomNumber(3, true),
            'status' => fake()->randomElement([
                MastercardDebitCard::STATUS_AVAILABLE,
                MastercardDebitCard::STATUS_ALLOCATED,
                MastercardDebitCard::STATUS_EXPIRED,
                MastercardDebitCard::STATUS_BLOCKED,
            ]),
        ];
    }
}
