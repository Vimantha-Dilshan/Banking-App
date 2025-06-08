<?php

namespace Database\Factories;

use App\Models\StaffMember;
use App\Models\Vault;
use App\Models\VaultTransaction;
use Illuminate\Database\Eloquent\Factories\Factory;

class VaultTransactionFactory extends Factory
{
    protected $model = VaultTransaction::class;

    public function definition(): array
    {
        $vault = Vault::factory()->create();
        $amount = fake()->randomFloat(2, 1000, 50000);
        $newBalance = $vault->balance + $amount;

        return [
            'staff_id' => StaffMember::factory()->create()->id,
            'vault_id' => $vault->id,
            'transaction_type' => fake()->randomElement([
                VaultTransaction::TYPE_IN,
                VaultTransaction::TYPE_OUT,
            ]),
            'amount' => $amount,
            'balance_after' => $newBalance,
            'reason' => fake()->words(3, true),
            'description' => fake()->sentence(),
            'reference_id' => fake()->uuid(),
        ];
    }
}
