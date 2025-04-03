<?php

namespace Database\Factories;

use App\Models\CustomerAccount;
use App\Models\CustomerAccountTransaction;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerAccountTransactionFactory extends Factory
{
    protected $model = CustomerAccountTransaction::class;

    public function definition(): array
    {
        return [
            'customer_account_id' => CustomerAccount::factory()->create()->id,
            'transaction_type' => fake()->randomElement(CustomerAccountTransaction::getTransactionTypes()),
            'transaction_mode' => fake()->randomElement([CustomerAccountTransaction::TRANSACTION_MODE_IN, CustomerAccountTransaction::TRANSACTION_MODE_OUT]),
            'transaction_date' => fake()->dateTimeThisYear(),
            'amount' => fake()->randomFloat(2, 1, 1000),
            'balance_after_transaction' => fake()->randomFloat(2, 1000, 10000),
            'reference_number' => fake()->optional()->uuid(),
            'notes' => fake()->optional()->text(),
            'status' => fake()->randomElement(CustomerAccountTransaction::getStatuses()),
        ];
    }
}
