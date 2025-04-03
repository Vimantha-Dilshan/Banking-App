<?php

namespace Database\Seeders;

use App\Models\CustomerDebitCard;
use Illuminate\Database\Seeder;

class CustomerDebitCardSeeder extends Seeder
{
    public function run(): void
    {
        CustomerDebitCard::factory(20)->create();
    }
}
