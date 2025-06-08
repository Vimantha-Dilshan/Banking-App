<?php

namespace Database\Seeders;

use App\Models\StaffMember;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StaffMemberSeeder extends Seeder
{
    public function run(): void
    {
        StaffMember::factory()->count(50)->create();
    }
}
