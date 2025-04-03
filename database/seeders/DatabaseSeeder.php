<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Administrator',
            'email' => 'dev-administrator@codex.com',
        ]);

        $this->call([
            UserSeeder::class,
            AccountTypeSeeder::class,
            CustomerSeeder::class,
            VisaDebitCardSeeder::class,
            VisaCreditCardSeeder::class,
            MastercardCreditCardSeeder::class,
            MastercardDebitCardSeeder::class,
            CardTypeSeeder::class,
            CustomerAccountTransactionSeeder::class,
        ]);
    }
}
