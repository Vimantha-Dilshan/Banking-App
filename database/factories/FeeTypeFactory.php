<?php

namespace Database\Factories;

use App\Models\FeeType;
use Illuminate\Database\Eloquent\Factories\Factory;

class FeeTypeFactory extends Factory
{
    protected $model = FeeType::class;

    public function definition(): array
    {
        return [
            'type' => fake()->text(10),
            'amount' => fake()->randomFloat(2, 5, 500),
            'description' => fake()->text(),
            'start_date' => fake()->date(),
            'end_date' => fake()->optional()->date(),
            'is_active' => fake()->boolean(90),
        ];
    }
}
