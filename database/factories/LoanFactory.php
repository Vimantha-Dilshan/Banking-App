<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Loan;
use Illuminate\Database\Eloquent\Factories\Factory;

class LoanFactory extends Factory
{
    protected $model = Loan::class;

    public function definition()
    {
        return [
            'customer_id' => Customer::factory()->create()->id,
            'loan_amount' => fake()->numberBetween(10000, 50000000),
            'interest_rate' => fake()->randomFloat(2, 1, 10),
            'loan_type' => fake()->randomElement([
                Loan::LOAN_TYPE_PERSONAL,
                Loan::LOAN_TYPE_MORTGAGE,
                Loan::LOAN_TYPE_CAR,
                Loan::LOAN_TYPE_STUDENT,
                Loan::LOAN_TYPE_BUSINESS,
            ]),
            'status' => fake()->randomElement([
                Loan::STATUS_PENDING,
                Loan::STATUS_APPROVED,
                Loan::STATUS_REJECTED,
                Loan::STATUS_COMPLETED,
            ]),
            'start_date' => fake()->date('Y-m-d', 'now'),
            'end_date' => fake()->date('Y-m-d', '+5 years'),
            'monthly_repayment' => fake()->numberBetween(2000, 50000),
            'notes' => fake()->optional()->sentence(),
        ];
    }
}
