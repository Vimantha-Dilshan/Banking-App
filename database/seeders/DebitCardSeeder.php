<?php

namespace Database\Seeders;

use App\Models\DebitCard;
use Illuminate\Database\Seeder;

class DebitCardSeeder extends Seeder
{
    public function run(): void
    {
        DebitCard::factory(20)->create();
    }
}
