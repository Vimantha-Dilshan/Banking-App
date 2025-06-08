<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\CustomerDebitCard;
use App\Models\DebitCardBilling;
use Illuminate\Database\Eloquent\Factories\Factory;

class DebitCardBillingFactory extends Factory
{
    protected $model = DebitCardBilling::class;

    public function definition(): array
    {
        $customer = Customer::factory()->create([
            'disabled' => false,
        ]);

        $customerCreditCard = CustomerDebitCard::factory()->create([
            'customer_id' => $customer->id,
            'status' => CustomerDebitCard::STATUS_ACTIVE,
        ]);

        return [
            'card_id' => $customerCreditCard->id,
            'customer_id' => $customer->id,
            'last_billed_year' => fake()->year(),
            'last_billed_month' => fake()->numberBetween(1, 12),
            'billing_status' => fake()->randomElement([
                DebitCardBilling::BILLING_STATUS_SUCCESS,
                DebitCardBilling::BILLING_STATUS_FAILED,
            ]),
        ];
    }
}
