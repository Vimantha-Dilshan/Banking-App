<?php

namespace Database\Seeders;

use App\Models\CustomerCreditCard;
use Illuminate\Database\Seeder;

class CustomerCreditCardSeeder extends Seeder
{
    public function run(): void
    {
        CustomerCreditCard::factory(20)->create();
    }
}
