<?php

namespace Database\Factories;

use App\Models\Branch;
use App\Models\StaffMember;
use Illuminate\Database\Eloquent\Factories\Factory;

class StaffMemberFactory extends Factory
{
    protected $model = StaffMember::class;

    public function definition(): array
    {
        $firstName = fake()->firstName;
        $lastName = fake()->lastName;

        return [
            'first_name' => $firstName,
            'last_name' => $lastName,
            'email' => strtolower($firstName.'.'.$lastName.'@codex.com'),
            'phone' => fake()->phoneNumber(),
            'nic' => fake()->numerify('#########V'),
            'date_of_birth' => fake()->date('Y-m-d', '-18 years'),
            'gender' => fake()->randomElement([
                StaffMember::GENDER_MALE,
                StaffMember::GENDER_FEMALE,
                StaffMember::GENDER_OTHER,
            ]),
            'position' => fake()->randomElement(['Teller', 'Manager', 'Analyst']),
            'department' => fake()->randomElement(['Loans', 'IT', 'Operations', 'Administration']),
            'branch_id' => Branch::factory()->create()->id,
            'status' => fake()->randomElement([
                StaffMember::STATUS_ACTIVE,
                StaffMember::STATUS_INACTIVE,
                StaffMember::STATUS_SUSPENDED,
            ]),
            'date_joined' => fake()->date(),
            'date_left' => fake()->optional()->date(),
        ];
    }
}
