<?php

namespace Database\Factories;

use App\Models\AccountType;
use Illuminate\Database\Eloquent\Factories\Factory;

class AccountTypeFactory extends Factory
{
    protected $model = AccountType::class;

    public function definition()
    {
        $accountTypes = [
            AccountType::KIDS_SMARTY_PIGGY,
            AccountType::KIDS_LITTLE_CHAMPS,
            AccountType::KIDS_BRIGHT_FUTURES,
            AccountType::TEEN_FREEDOM_SAVERS,
            AccountType::TEEN_CAMPUS_PLUS,
            AccountType::TEEN_MY_STASH,
            AccountType::TEEN_DREAM_BUILDER,
            AccountType::TEEN_VAULT_PREPAID,
            AccountType::COMM_PAYSTREAM_SALARY,
            AccountType::COMM_PRIME_SAVER,
            AccountType::COMM_BIZFLOW_CHECKING,
            AccountType::COMM_GOLD_RESERVE,
            AccountType::COMM_WEALTHGROW_PREMIUM,
        ];

        $accountType = fake()->randomElement($accountTypes);

        return [
            'account_name' => $accountType['name'],
            'category' => $accountType['category'],
            'currency' => fake()->currencyCode,
            'description' => $accountType['description'],
            'status' => fake()->randomElement([
                AccountType::STATUS_ACTIVE,
                AccountType::STATUS_INACTIVE,
                AccountType::STATUS_PENDING,
            ]),
        ];
    }
}
