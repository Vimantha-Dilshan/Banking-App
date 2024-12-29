<?php

namespace Database\Seeders;

use App\Models\CustomerAccount;
use Illuminate\Database\Seeder;

class CustomerAccountSeeder extends Seeder
{
    public function run(): void
    {
        CustomerAccount::factory()->count(50)->create();
    }
}
