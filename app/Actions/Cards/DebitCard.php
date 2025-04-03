<?php

namespace App\Actions\Cards;

use App\Http\Resources\V1\CustomerManagement\DebitCardResource;
use App\Models\Customer;
use App\Models\CustomerDebitCard;
use App\Traits\CardTrait;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DebitCard
{
    use CardTrait;

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
}
