<?php

namespace Database\Seeders;

use App\Models\VisaDebitCard;
use Illuminate\Database\Seeder;

class VisaDebitCardSeeder extends Seeder
{
    public function run(): void
    {
        VisaDebitCard::factory()->count(30)->create();
    }
}
