<?php

namespace Database\Seeders;

use App\Models\FixedDeposit;
use Illuminate\Database\Seeder;

class FixedDepositSeeder extends Seeder
{
    public function run(): void
    {
        FixedDeposit::factory(10)->create();
    }
}
