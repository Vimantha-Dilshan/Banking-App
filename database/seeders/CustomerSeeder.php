<?php

namespace Database\Seeders;

use App\Models\AccountType;
use App\Models\Customer;
use App\Models\CustomerAccount;
use App\Models\CustomerCreditCard;
use App\Models\CustomerDebitCard;
use App\Models\FixedDeposit;
use App\Models\Loan;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    public function run(): void
    {
        Customer::factory()
            ->count(30)
            ->create()
            ->each(function ($customer) {
                $cardholderName = strtoupper($customer->first_name.' '.$customer->last_name);
                $accountType = AccountType::inRandomOrder()->first();

                $status = fake()->randomElement(
                    array_merge(
                        array_fill(0, 9, CustomerAccount::STATUS_ACTIVE),
                        [CustomerAccount::STATUS_INACTIVE, CustomerAccount::STATUS_PENDING]
                    )
                );

                $startDate = fake()->dateTimeBetween('-5 years', 'now');
                $deactivationDate = fake()->dateTimeBetween($startDate, 'now');
                $accountNumber = fake()->unique()->numerify('101#########');

                $customer->accounts()->attach($accountType->id, [
                    'account_number' => $accountNumber,
                    'status' => $status,
                    'balance' => fake()->numberBetween(10000, 50000000),
                    'branch' => fake()->city,
                    'start_date' => $startDate,
                    'deactivation_date' => $status === CustomerAccount::STATUS_INACTIVE ? $deactivationDate : null,
                    'deactivation_reason' => $status === CustomerAccount::STATUS_INACTIVE ? fake()->sentence : null,
                    'notes' => fake()->text(),
                ]);

                $customer->creditCards()->create([
                    'card_number' => fake()->creditCardNumber,
                    'card_type' => fake()->randomElement([
                        CustomerCreditCard::CARD_TYPE_VISA,
                        CustomerCreditCard::CARD_TYPE_MASTERCARD,
                        CustomerCreditCard::CARD_TYPE_AMEX,
                        CustomerCreditCard::CARD_TYPE_DISCOVER,
                        CustomerCreditCard::CARD_TYPE_MAESTRO,
                        CustomerCreditCard::CARD_TYPE_JCB,
                    ]),
                    'status' => fake()->randomElement([
                        CustomerCreditCard::STATUS_ACTIVE,
                        CustomerCreditCard::STATUS_INACTIVE,
                        CustomerCreditCard::STATUS_SUSPENDED,
                        CustomerCreditCard::STATUS_CLOSED,
                    ]),
                    'credit_limit' => fake()->randomFloat(2, 50000, 5000000),
                    'available_credit' => fake()->randomFloat(2, 0, 50000),
                    'outstanding_balance' => fake()->randomFloat(2, 0, 50000),
                    'interest_rate' => fake()->randomFloat(2, 10, 30),
                    'expiry_date' => fake()->date('m/Y', 'now +5 years'),
                    'cardholder_name' => $cardholderName,
                    'notes' => fake()->optional()->sentence(),
                ]);

                $customer->debitCards()->create([
                    'linked_account' => $accountNumber,
                    'card_number' => fake()->creditCardNumber,
                    'card_type' => fake()->randomElement([
                        CustomerDebitCard::CARD_TYPE_VISA,
                        CustomerDebitCard::CARD_TYPE_MASTERCARD,
                        CustomerDebitCard::CARD_TYPE_AMEX,
                        CustomerDebitCard::CARD_TYPE_DISCOVER,
                        CustomerDebitCard::CARD_TYPE_MAESTRO,
                        CustomerDebitCard::CARD_TYPE_JCB,
                    ]),
                    'status' => fake()->randomElement([
                        CustomerDebitCard::STATUS_ACTIVE,
                        CustomerDebitCard::STATUS_INACTIVE,
                        CustomerDebitCard::STATUS_SUSPENDED,
                        CustomerDebitCard::STATUS_CLOSED,
                    ]),
                    'expiry_date' => fake()->date('m/Y', 'now +5 years'),
                    'cardholder_name' => $cardholderName,
                    'notes' => fake()->optional()->sentence(),
                ]);

                $customer->loans()->create([
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
                ]);

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

                $customer->fixedDeposits()->create([
                    'deposit_amount' => $depositAmount,
                    'interest_rate' => $interestRate,
                    'deposit_term' => $depositTerm,
                    'status' => $fixedDepositStatus,
                    'start_date' => $startDate,
                    'maturity_date' => $maturityDate,
                    'maturity_amount' => $maturityAmount,
                    'closed' => $isClosed ?? false,
                    'notes' => fake()->optional()->sentence(),
                ]);
            });
    }
}
