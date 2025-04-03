<?php

namespace Database\Seeders;

use App\Models\MastercardCreditCard;
use Illuminate\Database\Seeder;

class MastercardCreditCardSeeder extends Seeder
{
    public function run(): void
    {
        MastercardCreditCard::factory()->count(30)->create();
    }
}
