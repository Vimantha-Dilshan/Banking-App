<?php

namespace Database\Factories;

use App\Models\CreditCardBilling;
use App\Models\Customer;
use App\Models\CustomerCreditCard;
use Illuminate\Database\Eloquent\Factories\Factory;

class CreditCardBillingFactory extends Factory
{
    protected $model = CreditCardBilling::class;

    public function definition(): array
    {
        $customer = Customer::factory()->create([
            'disabled' => false,
        ]);

        $customerCreditCard = CustomerCreditCard::factory()->create([
            'customer_id' => $customer->id,
            'status' => CustomerCreditCard::STATUS_ACTIVE
        ]);

        return [
            'card_id' => $customerCreditCard->id,
            'customer_id' => $customer->id,
            'last_billed_year' => fake()->year(),
            'last_billed_month' => fake()->numberBetween(1, 12),
            'billing_status' => fake()->randomElement([
                CreditCardBilling::BILLING_STATUS_SUCCESS,
                CreditCardBilling::BILLING_STATUS_FAILED,
            ]),
        ];
    }
}
