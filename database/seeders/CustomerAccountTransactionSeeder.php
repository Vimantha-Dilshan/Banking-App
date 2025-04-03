<?php

namespace Database\Seeders;

use App\Models\CustomerAccountTransaction;
use Illuminate\Database\Seeder;

class CustomerAccountTransactionSeeder extends Seeder
{
    public function run(): void
    {
        CustomerAccountTransaction::factory(30)->create();
    }
}
