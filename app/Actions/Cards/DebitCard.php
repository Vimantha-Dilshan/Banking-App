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
use App\Traits\CustomerPaymentTrait;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DebitCard
{
    use CardTrait, CustomerPaymentTrait;

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
        $transactionAmount = $this->getDebitCardAnnualCharges($request->cardDetails['cardType']);

        $makePayment = $this->makePayment(
            $customer->primaryAccount,
            $transactionAmount,
            'Debit Card Annual Charge'.now()->year
        );

        if (! $makePayment) {
            return response()->json(
                ['message' => 'The customer\'s primary account is not active or didn\'t have sufficient funds.'],
                Response::HTTP_UNPROCESSABLE_ENTITY,
            );
        }

        $customerDebitCard = $this->storeDebitCard($customer,$request);

        // TODO: Setup the annual billing charge

        return DebitCardResource::make($customerDebitCard);
    }

    private function getDebitCardAnnualCharges($cardType)
    {
        $feeTypeIds = [
            CardType::VISA => FeeType::DEBIT_CARD_VISA_ANNAUL_CHARGE_ID,
            CardType::MASTERCARD => FeeType::DEBIT_CARD_MASTERCARD_ANNAUL_CHARGE_ID,
        ];

        $feeType = FeeType::find($feeTypeIds[$cardType]);

        return $feeType->amount;
    }

    private function storeDebitCard(Customer $customer, Request $request){
        return CustomerDebitCard::create([
            'customer_id' => $request->customerId,
            'linked_account' => $request->accountDetails['accountId'],
            'card_type' => $request->cardDetails['cardType'],
            'status' => CustomerDebitCard::STATUS_ACTIVE,
            'expiry_date' => now()->addYears(4)->format('m/Y'),
            'cardholder_name' => $request->cardDetails['cardHolderName'] ?? strtoupper($customer->first_name.' '.$customer->last_name),
            'notes' => $request->cardDetails['notes'] ?? null,
        ]);
    }
}
