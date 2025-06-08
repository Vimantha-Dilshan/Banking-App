<?php

namespace Database\Seeders;

use App\Models\Vault;
use Illuminate\Database\Seeder;

class VaultSeeder extends Seeder
{
    public function run(): void
    {
        Vault::factory()->count(10)->create();
    }
}
