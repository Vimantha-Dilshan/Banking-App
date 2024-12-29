<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    protected $model = Customer::class;

    public function definition(): array
    {
        $firstName = fake()->firstName;
        $lastName = fake()->lastName;

        return [
            'salutation' => fake()->randomElement([
                Customer::SALUTATION_MR,
                Customer::SALUTATION_MISS,
                Customer::SALUTATION_MRS,
                Customer::SALUTATION_REV,
            ]),
            'first_name' => $firstName,
            'last_name' => $lastName,
            'occupation' => fake()->jobTitle,
            'employer_name' => fake()->company,
            'email' => strtolower($firstName.'.'.$lastName.'@codex.com'),
            'phone' => fake()->phoneNumber,
            'national_id' => fake()->unique()->numerify('###########'),
            'address_line_1' => fake()->streetAddress,
            'address_line_2' => fake()->secondaryAddress,
            'city' => fake()->city,
            'postal_code' => fake()->postcode,
            'province' => fake()->state,
            'country' => fake()->country,
            'date_of_birth' => fake()->date('Y-m-d', '-18 years'),
            'gender' => fake()->randomElement([
                Customer::GENDER_MALE,
                Customer::GENDER_FEMALE,
                Customer::GENDER_OTHER,
            ]),
            'is_vip' => fake()->boolean(10),
            'disabled' => false,
            'notes' => fake()->sentence(),
        ];
    }
}
