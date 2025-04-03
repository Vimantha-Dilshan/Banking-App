<?php

namespace Database\Factories;

use App\Models\CardType;
use Illuminate\Database\Eloquent\Factories\Factory;

class CardTypeFactory extends Factory
{
    protected $model = CardType::class;

    public function definition()
    {
        $cardTypes = [
            CardType::VISA => [
                'company' => 'Visa Inc.',
                'description' => 'The most widely used card network globally.',
                'logo_url' => 'https://upload.wikimedia.org/wikipedia/commons/4/4f/Visa_Logo.svg',
            ],
            CardType::MASTERCARD => [
                'company' => 'Mastercard Inc.',
                'description' => 'A globally recognized card brand offering credit, debit, and prepaid cards.',
                'logo_url' => 'https://upload.wikimedia.org/wikipedia/commons/2/2f/Mastercard-logo.svg',
            ],
            CardType::AMEX => [
                'company' => 'American Express',
                'description' => 'A premium card brand known for rewards and high spending limits.',
                'logo_url' => 'https://upload.wikimedia.org/wikipedia/commons/a/a7/American_Express_logo.svg',
            ],
            CardType::DISCOVER => [
                'company' => 'Discover Financial Services',
                'description' => 'A card network offering cash-back benefits and no annual fee.',
                'logo_url' => 'https://upload.wikimedia.org/wikipedia/commons/a/ae/Discover_Logo_2021.svg',
            ],
            CardType::DINERS => [
                'company' => 'Diners Club International',
                'description' => 'A credit card company offering travel benefits and exclusive offers.',
                'logo_url' => 'https://upload.wikimedia.org/wikipedia/commons/2/2e/Diners_Club_logo.svg',
            ],
        ];

        $cardTypeKey = fake()->randomElement(array_keys($cardTypes));
        $cardData = $cardTypes[$cardTypeKey];

        return [
            'name' => $cardTypeKey,
            'company' => $cardData['company'],
            'description' => $cardData['description'],
            'logo_url' => $cardData['logo_url'],
        ];
    }
}
