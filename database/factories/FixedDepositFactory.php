<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\FixedDeposit;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class FixedDepositFactory extends Factory
{
    protected $model = FixedDeposit::class;

    public function definition()
    {
        $interestRates = [
            FixedDeposit::DEPOSIT_TERM_6_MONTHS => 3.5,
            FixedDeposit::DEPOSIT_TERM_1_YEAR => 4.0,
            FixedDeposit::DEPOSIT_TERM_2_YEARS => 5.0,
            FixedDeposit::DEPOSIT_TERM_3_YEARS => 5.5,
            FixedDeposit::DEPOSIT_TERM_5_YEARS => 6.0,
        ];

        $depositTerm = fake()->randomElement([
            FixedDeposit::DEPOSIT_TERM_6_MONTHS,
            FixedDeposit::DEPOSIT_TERM_1_YEAR,
            FixedDeposit::DEPOSIT_TERM_2_YEARS,
            FixedDeposit::DEPOSIT_TERM_3_YEARS,
            FixedDeposit::DEPOSIT_TERM_5_YEARS,
        ]);

        $interestRate = $interestRates[$depositTerm];
        $depositAmount = fake()->numberBetween(100000, 99999999);

        $maturityAmount = $depositAmount * (1 + ($interestRate / 100) * (
            $depositTerm === FixedDeposit::DEPOSIT_TERM_6_MONTHS ? 0.5 :
            ($depositTerm === FixedDeposit::DEPOSIT_TERM_1_YEAR ? 1 :
            ($depositTerm === FixedDeposit::DEPOSIT_TERM_2_YEARS ? 2 :
            ($depositTerm === FixedDeposit::DEPOSIT_TERM_3_YEARS ? 3 : 5)))
        ));

        $startDate = fake()->date('Y-m-d', 'now');

        switch ($depositTerm) {
            case FixedDeposit::DEPOSIT_TERM_6_MONTHS:
                $maturityDate = \Carbon\Carbon::parse($startDate)->addMonths(6)->toDateString();
                break;
            case FixedDeposit::DEPOSIT_TERM_1_YEAR:
                $maturityDate = \Carbon\Carbon::parse($startDate)->addYear()->toDateString();
                break;
            case FixedDeposit::DEPOSIT_TERM_2_YEARS:
                $maturityDate = \Carbon\Carbon::parse($startDate)->addYears(2)->toDateString();
                break;
            case FixedDeposit::DEPOSIT_TERM_3_YEARS:
                $maturityDate = \Carbon\Carbon::parse($startDate)->addYears(3)->toDateString();
                break;
            case FixedDeposit::DEPOSIT_TERM_5_YEARS:
                $maturityDate = \Carbon\Carbon::parse($startDate)->addYears(5)->toDateString();
                break;
            default:
                $maturityDate = $startDate;
                break;
        }

        $isMatured = Carbon::parse($maturityDate)->isPast();

        if ($isMatured) {
            $fixedDepositStatus = fake()->randomElement([
                FixedDeposit::STATUS_MATURED,
                FixedDeposit::STATUS_WITHDRAWN,
                FixedDeposit::STATUS_CLOSED,
            ]);
        } else {
            $fixedDepositStatus = FixedDeposit::STATUS_ACTIVE;
        }

        if ($fixedDepositStatus == FixedDeposit::STATUS_CLOSED) {
            $isClosed = true;
        }

        return [
            'customer_id' => Customer::factory()->create()->id,
            'deposit_amount' => $depositAmount,
            'interest_rate' => $interestRate,
            'deposit_term' => $depositTerm,
            'status' => $fixedDepositStatus,
            'start_date' => $startDate,
            'maturity_date' => $maturityDate,
            'maturity_amount' => $maturityAmount,
            'closed' => $isClosed ?? false,
            'notes' => fake()->optional()->sentence(),
        ];
    }
}
