<?php

namespace App\Actions\Cards;

use App\Http\Resources\V1\CustomerManagement\DebitCardResource;
use App\Models\CardType;
use App\Models\Customer;
use App\Models\CustomerDebitCard;
use App\Models\DebitCardBilling;
use App\Models\FeeType;
use App\Notifications\DebitCardAssigned;
use App\Notifications\DebitCardPasscodeInform;
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

        if (! $cardBank = $this->checkCardAvailability(
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

        if (! $this->makePayment(
            $request,
            $customer->primaryAccount,
            $transactionAmount,
            'Debit Card Annual Charge'.now()->year
        )) {
            return response()->json(
                ['message' => 'The customer\'s primary account is not active or didn\'t have sufficient funds.'],
                Response::HTTP_UNPROCESSABLE_ENTITY,
            );
        }

        $customerDebitCard = $this->storeDebitCard($customer, $request);
        $this->updateCardBank($cardBank);
        $this->storeDebitCardBilling($customer);
        $this->sendEmailNotification($customer);

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

    private function storeDebitCard(Customer $customer, Request $request)
    {
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

    private function updateCardBank($cardBank)
    {
        $cardBank->update([
            'status' => 'ALLOCATED',
        ]);
    }

    private function storeDebitCardBilling(Customer $customer)
    {
        DebitCardBilling::create([
            'card_id' => $customer->debitCard->id,
            'customer' => $customer->id,
            'last_billed_year' => now()->year,
            'last_billed_month' => now()->month,
            'billing_status' => DebitCardBilling::BILLING_STATUS_SUCCESS,
        ]);
    }

    private function sendEmailNotification(Customer $customer)
    {
        $customer->notify(new DebitCardAssigned);
        $customer->notify(new DebitCardPasscodeInform(fake()->numerify('######')));
    }
}
