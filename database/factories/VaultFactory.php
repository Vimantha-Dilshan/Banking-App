<?php

namespace Database\Factories;

use App\Models\Branch;
use App\Models\Vault;
use Illuminate\Database\Eloquent\Factories\Factory;

class VaultFactory extends Factory
{
    protected $model = Vault::class;

    public function definition(): array
    {
        return [
            'name' => fake()->randomElement(['Main Vault', 'Sub Vault CAT-A', 'Sub Vault CAT-B', 'Reserve Vault']),
            'branch_id' => Branch::factory()->create()->id,
            'type' => fake()->randomElement([
                Vault::TYPE_MAIN,
                Vault::TYPE_SUB,
            ]),
            'currency' => 'LKR',
            'balance' => fake()->randomFloat(2, 10000, 500000),
            'status' => fake()->randomElement([
                Vault::STATUS_ACTIVE,
                Vault::STATUS_INACTIVE,
            ]),
        ];
    }
}
