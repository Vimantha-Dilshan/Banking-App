<?php

namespace Database\Factories;

use App\Models\CustomerAccount;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    protected $model = Transaction::class;

    public function definition()
    {
        return [
            'customer_account_id' => CustomerAccount::factory()->create()->id,
            'transaction_type' => fake()->randomElement([
                Transaction::TRANSACTION_TYPE_DEPOSIT,
                Transaction::TRANSACTION_TYPE_WITHDRAWAL,
                Transaction::TRANSACTION_TYPE_TRANSFER,
                Transaction::TRANSACTION_TYPE_PAYMENT,
            ]),
            'amount' => fake()->randomFloat(2, 10, 99999999),
            'balance_after_transaction' => fake()->randomFloat(2, 10, 10000),
            'status' => fake()->randomElement([
                Transaction::STATUS_PENDING,
                Transaction::STATUS_COMPLETED,
                Transaction::STATUS_FAILED,
                Transaction::STATUS_CANCELLED,
            ]),
            'transaction_date' => fake()->dateTimeThisYear(),
            'notes' => fake()->sentence(),
        ];
    }
}
