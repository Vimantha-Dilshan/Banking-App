<?php

namespace Database\Factories;

use App\Models\AccountType;
use App\Models\Customer;
use App\Models\CustomerAccount;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerAccountFactory extends Factory
{
    protected $model = CustomerAccount::class;

    public function definition()
    {
        $status = fake()->randomElement(
            array_merge(
                array_fill(0, 9, CustomerAccount::STATUS_ACTIVE),
                [CustomerAccount::STATUS_INACTIVE, CustomerAccount::STATUS_PENDING]
            )
        );

        $startDate = fake()->dateTimeBetween('-5 years', 'now');
        $deactivationDate = fake()->dateTimeBetween($startDate, 'now');

        return [
            'customer_id' => Customer::factory()->create()->id,
            'account_id' => AccountType::factory()->create()->id,
            'account_number' => fake()->unique()->numerify('101#########'),
            'status' => fake()->randomElement([
                CustomerAccount::STATUS_ACTIVE,
                CustomerAccount::STATUS_INACTIVE,
                CustomerAccount::STATUS_PENDING,
            ]),
            'balance' => fake()->numberBetween(10000, 50000000),
            'branch' => fake()->city,
            'start_date' => $startDate,
            'deactivation_date' => $status === CustomerAccount::STATUS_INACTIVE ? $deactivationDate : null,
            'deactivation_reason' => $status === CustomerAccount::STATUS_INACTIVE ? fake()->sentence : null,
            'notes' => fake()->text(),
        ];
    }
}
