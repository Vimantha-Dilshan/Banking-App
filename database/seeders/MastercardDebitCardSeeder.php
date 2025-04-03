<?php

namespace Database\Seeders;

use App\Models\MastercardDebitCard;
use Illuminate\Database\Seeder;

class MastercardDebitCardSeeder extends Seeder
{
    public function run(): void
    {
        MastercardDebitCard::factory()->count(50)->create();
    }
}
