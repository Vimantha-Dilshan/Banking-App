<?php

namespace Database\Seeders;

use App\Models\CustomerCreditCard;
use Illuminate\Database\Seeder;

class CreditCardSeeder extends Seeder
{
    public function run(): void
    {
        CustomerCreditCard::factory()->count(20)->create();
    }
}
