<?php

namespace Database\Seeders;

use App\Models\CreditCardBilling;
use Illuminate\Database\Seeder;

class CreditCardBillingSeeder extends Seeder
{
    public function run(): void
    {
        CreditCardBilling::factory()->count(20)->create();
    }
}
