<?php

namespace Database\Seeders;

use App\Models\VaultTransaction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VaultTransactionSeeder extends Seeder
{
    public function run(): void
    {
        VaultTransaction::factory()->count(30)->create();
    }
}
