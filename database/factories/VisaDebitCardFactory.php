<?php

namespace Database\Factories;

use App\Models\VisaDebitCard;
use Illuminate\Database\Eloquent\Factories\Factory;

class VisaDebitCardFactory extends Factory
{
    protected $model = VisaDebitCard::class;

    public function definition(): array
    {
        return [
            'card_number' => fake()->creditCardNumber,
            'expiry_date' => fake()->creditCardExpirationDate,
            'cvv' => fake()->numerify('###'),
            'status' => fake()->randomElement([
                VisaDebitCard::STATUS_AVAILABLE,
                VisaDebitCard::STATUS_ALLOCATED,
                VisaDebitCard::STATUS_EXPIRED,
                VisaDebitCard::STATUS_BLOCKED,
            ]),
        ];
    }
}
