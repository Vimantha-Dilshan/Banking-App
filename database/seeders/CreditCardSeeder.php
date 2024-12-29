<?php

namespace Database\Seeders;

use App\Models\CreditCard;
use Illuminate\Database\Seeder;

class CreditCardSeeder extends Seeder
{
    public function run(): void
    {
        CreditCard::factory()->count(20)->create();
    }
}
