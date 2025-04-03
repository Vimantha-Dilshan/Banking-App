<?php

namespace App\Actions\Cards;

use App\Http\Resources\V1\CustomerManagement\DebitCardResource;
use App\Models\CardType;
use App\Models\Customer;
use App\Models\CustomerAccount;
use App\Models\CustomerAccountTransaction;
use App\Models\CustomerDebitCard;
use App\Models\FeeType;
use App\Traits\CardTrait;
use App\Traits\PaymentTrait;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DebitCard
{
    use CardTrait, PaymentTrait;

    public function handle(Request $request, Closure $next)
    {
        if (! $request->cardDetails['debitCard']) {
            return $next($request);
        }

        if (! $this->checkCardAvailability(
            $request->cardDetails['cardNumber'],
            $request->cardDetails['cardType'],
            false,
            true,
        )) {
            return response()->json(
                ['message' => $request->cardDetails['cardType'].' card number '.$request->cardDetails['cardNumber'].' is not available.'],
                Response::HTTP_UNPROCESSABLE_ENTITY,
            );
        }

        $customer = Customer::find($request->customerId);

        $this->debitAnnualCharges($request->accountDetails['accountId'], $request->cardDetails['cardType']);

        $customerDebitCard = CustomerDebitCard::create([
            'customer_id' => $request->customerId,
            'linked_account' => $request->accountDetails['accountId'],
            'card_type' => $request->cardDetails['cardType'],
            'status' => CustomerDebitCard::STATUS_ACTIVE,
            'expiry_date' => now()->addYears(4)->format('m/Y'),
            'cardholder_name' => $request->cardDetails['cardHolderName'] ?? strtoupper($customer->first_name.' '.$customer->last_name),
            'notes' => $request->cardDetails['notes'] ?? null,
        ]);

        // TODO: Setup the annual billing charge

        return DebitCardResource::make($customerDebitCard);
    }

    public function debitAnnualCharges(CustomerAccount $customerAccount, $cardType)
    {
        $feeTypeIds = [
            CardType::VISA => FeeType::DEBIT_CARD_VISA_ANNAUL_CHARGE_ID,
            CardType::MASTERCARD => FeeType::DEBIT_CARD_MASTERCARD_ANNAUL_CHARGE_ID,
        ];

        $feeType = FeeType::find($feeTypeIds[$cardType]);

        if (! $this->paymentSufficientBalanceHave($customerAccount, $feeType->amount)) {
            return response()->json(
                ['message' => 'Account balance is insufficient for this action.'],
                Response::HTTP_UNPROCESSABLE_ENTITY,
            );
        }

        CustomerAccountTransaction::create([
            'customer_account_id' => $customerAccount->id,
            'transaction_mode' => CustomerAccountTransaction::TRANSACTION_MODE_OUT,
            'transaction_date' => now(),
            'amount' => $feeType->amount,
            'balance_after_transaction' => $customerAccount->balance - $feeType->amount,
            'reference_number' => fake()->uuid,
            'notes' => 'Debit Card Annual Charge'.now()->year,
            'status' => CustomerAccountTransaction::STATUS_COMPLETED,
        ]);
    }
}
