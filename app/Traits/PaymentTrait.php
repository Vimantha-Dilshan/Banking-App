<?php

namespace App\Traits;

use App\Models\CustomerAccount;
use App\Models\FeeType;

trait PaymentTrait
{
    public function paymentSufficientBalanceHave(CustomerAccount $customerAccount, $transactionAmount)
    {
        $feeType = FeeType::find(FeeType::CUSTOMER_ACCOUNT_MINIMUM_CHARGE);

        if ($customerAccount->balance > ($feeType->amount + $transactionAmount)) {
            return true;
        }

        return false;
    }
}
