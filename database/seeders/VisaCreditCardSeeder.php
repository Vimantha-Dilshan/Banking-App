<?php

namespace Database\Seeders;

use App\Models\VisaCreditCard;
use Illuminate\Database\Seeder;

class VisaCreditCardSeeder extends Seeder
{
    public function run(): void
    {
        VisaCreditCard::factory()->count(30)->create();
    }
}
