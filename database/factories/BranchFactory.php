<?php

namespace Database\Factories;

use App\Models\Branch;
use Illuminate\Database\Eloquent\Factories\Factory;

class BranchFactory extends Factory
{
    protected $model = Branch::class;

    public function definition(): array
    {
        $branch = fake()->city();
        $email = strtolower(str_replace(' ', '.', $branch)).'.branch@codex.com';

        return [
            'code' => 'BR'.fake()->numerify('######'),
            'name' => $branch.' Branch',
            'address_line1' => fake()->streetAddress(),
            'address_line2' => fake()->secondaryAddress(),
            'city' => $branch,
            'district' => fake()->state(),
            'postal_code' => fake()->postcode(),
            'country' => 'Sri Lanka',
            'phone' => fake()->phoneNumber(),
            'email' => $email,
            'manager_id' => 1,
            'status' => fake()->randomElement([
                Branch::STATUS_ACTIVE,
                Branch::STATUS_INACTIVE,
                Branch::STATUS_CLOSED,
            ]),
            'latitude' => fake()->latitude(),
            'longitude' => fake()->longitude(),
        ];
    }
}
