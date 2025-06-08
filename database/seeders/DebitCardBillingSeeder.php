<?php

namespace Database\Seeders;

use App\Models\DebitCardBilling;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DebitCardBillingSeeder extends Seeder
{
    public function run(): void
    {
        DebitCardBilling::factory()->count(20)->create();
    }
}
