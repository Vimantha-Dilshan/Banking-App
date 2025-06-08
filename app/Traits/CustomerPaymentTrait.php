<?php

namespace App\Traits;

use App\Models\CustomerAccount;
use App\Models\CustomerAccountTransaction;
use App\Models\FeeType;
use App\Models\Vault;
use App\Models\VaultTransaction;
use Illuminate\Http\Request;

trait CustomerPaymentTrait
{
    public function makePayment(Request $request, CustomerAccount $customerAccount, $transactionAmount, $notes)
    {
        $canMakePayment = $this->canMakePayment($customerAccount, $transactionAmount);

        if (! $canMakePayment) {
            return false;
        }

        $customerAccount = $this->reduceTransactionFee($customerAccount, $transactionAmount);

        $this->storeCustomerAccountTransaction($customerAccount, $transactionAmount, $notes);
        $this->transferToBankVault($request, $transactionAmount);

        return true;
    }

    private function canMakePayment(CustomerAccount $customerAccount, $transactionAmount)
    {
        $feeType = FeeType::find(FeeType::CUSTOMER_ACCOUNT_MINIMUM_CHARGE);

        if ($customerAccount->status != CustomerAccount::STATUS_ACTIVE) {
            return false;
        }

        if ($customerAccount->balance > ($feeType->amount + $transactionAmount)) {
            return true;
        }

        return false;
    }

    private function reduceTransactionFee(CustomerAccount $customerAccount, $transactionAmount)
    {
        $customerAccount->update([
            'balance' => $customerAccount->balance - $transactionAmount,
        ]);

        return $customerAccount;
    }

    private function storeCustomerAccountTransaction(CustomerAccount $customerAccount, $transactionAmount, $notes)
    {
        CustomerAccountTransaction::create([
            'customer_account_id' => $customerAccount->id,
            'transaction_type' => CustomerAccountTransaction::TRANSACTION_TYPE_FEE,
            'transaction_mode' => CustomerAccountTransaction::TRANSACTION_MODE_IN,
            'transaction_date' => now(),
            'amount' => $transactionAmount,
            'balance_after_transaction' => $customerAccount->balance,
            'reference_number' => fake()->uuid,
            'notes' => $notes,
        ]);
    }

    private function transferToBankVault(Request $request, $transactionAmount)
    {
        $vault = $this->storeVault($request, $transactionAmount);
        $this->storeVaultTransaction($request, $vault, $transactionAmount);
    }

    private function storeVault(Request $request, $transactionAmount)
    {
        $vault = Vault::where('brand_id', $request->branchId)
            ->where('status', Vault::STATUS_ACTIVE)
            ->first();

        $vault->update([
            'balance' => $vault->balance + $transactionAmount,
        ]);

        return $vault;
    }

    private function storeVaultTransaction(Request $request, $vault, $transactionAmount)
    {
        VaultTransaction::create([
            'staff_id' => '',
            'vault_id' => $vault->id,
            'transaction_type' => VaultTransaction::TYPE_IN,
            'amount' => $transactionAmount,
            'balance_after' => $vault->balance,
            'reason' => 'Debit Card Fee of CUST-'.$request->customerId.' for '.now()->year.'-'.now()->month,
        ]);
    }
}
