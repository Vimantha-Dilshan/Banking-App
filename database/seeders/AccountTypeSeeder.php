<?php

namespace Database\Seeders;

use App\Models\AccountType;
use Illuminate\Database\Seeder;

class AccountTypeSeeder extends Seeder
{
    public function run()
    {
        $accountTypes = [
            AccountType::KIDS_SMARTY_PIGGY + ['status' => AccountType::STATUS_ACTIVE],
            AccountType::KIDS_LITTLE_CHAMPS + ['status' => AccountType::STATUS_ACTIVE],
            AccountType::KIDS_BRIGHT_FUTURES + ['status' => AccountType::STATUS_ACTIVE],
            AccountType::TEEN_FREEDOM_SAVERS + ['status' => AccountType::STATUS_ACTIVE],
            AccountType::TEEN_CAMPUS_PLUS + ['status' => AccountType::STATUS_ACTIVE],
            AccountType::TEEN_MY_STASH + ['status' => AccountType::STATUS_ACTIVE],
            AccountType::TEEN_DREAM_BUILDER + ['status' => AccountType::STATUS_ACTIVE],
            AccountType::TEEN_VAULT_PREPAID + ['status' => AccountType::STATUS_ACTIVE],
            AccountType::COMM_PAYSTREAM_SALARY + ['status' => AccountType::STATUS_ACTIVE],
            AccountType::COMM_PRIME_SAVER + ['status' => AccountType::STATUS_ACTIVE],
            AccountType::COMM_BIZFLOW_CHECKING + ['status' => AccountType::STATUS_ACTIVE],
            AccountType::COMM_GOLD_RESERVE + ['status' => AccountType::STATUS_ACTIVE],
            AccountType::COMM_WEALTHGROW_PREMIUM + ['status' => AccountType::STATUS_ACTIVE],
        ];

        foreach ($accountTypes as $type) {
            AccountType::firstOrCreate(
                ['account_name' => $type['name']],
                [
                    'account_name' => $type['name'],
                    'description' => $type['description'],
                    'category' => $type['category'],
                    'currency' => $this->getCurrency(),
                    'status' => $type['status'],
                ]
            );
        }
    }

    private function getCurrency(): string
    {
        return mt_rand(1, 100) <= 90 ? 'LKR' : fake()->currencyCode;
    }
}
