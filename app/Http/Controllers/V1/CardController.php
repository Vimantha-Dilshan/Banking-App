<?php

namespace App\Http\Controllers\V1;

use App\Actions\Cards\CreditCard;
use App\Actions\Cards\DebitCard;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Card\StoreCardRequest;
use Illuminate\Pipeline\Pipeline;

/**
 * @group Card Management
 *
 * @authenticated
 */
class CardController extends Controller
{
    /**
     * Store New Card for Customer
     *
     * Creates a new debit or credit card along with customer and account details.
     * Optionally, you can specify debit card and credit card types, along with card details.
     *
     * @bodyParam customerId integer required The ID of the customer for whom the card is being created. Example: 1234
     * @bodyParam cardDetails object required The details of the card to be stored.
     * @bodyParam cardDetails.debitCard boolean required Indicates whether the card is a debit card (true/false). Example: true
     * @bodyParam cardDetails.creditCard boolean required Indicates whether the card is a credit card (true/false). Example: true
     * @bodyParam cardDetails.cardType string required The type of the card, can be "VISA", "MASTERCARD", etc. Example: MASTERCARD
     * @bodyParam cardDetails.cardNumber string required The card number (valid card number). Example: 4916659541180962
     * @bodyParam cardDetails.cardHolderName string nullable The name of the cardholder. Example: JOE ROOT
     * @bodyParam cardDetails.notes string nullable Additional notes about the card. Example: Loerum Ipsum
     * @bodyParam accountDetails object required The associated account details.
     * @bodyParam accountDetails.accountId integer required The account ID to link the card to. Example: 1234
     *
     * @response 422 {
     *     "message": "Card not available."
     * }
     * @response 200 {
     *     "linkedAccount": 1,
     *     "cardNumber": "4954327659059906",
     *     "cardType": "VISA",
     *     "status": "AVAILABLE",
     *     "expiryDate": "09/2025",
     *     "cardholderName": "VIMANTHA DILSHAN",
     *     "notes": "Test Note!"
     * }
     * @response 200 {
     *     "cardNumber": "4954327659059906",
     *     "cardType": "VISA",
     *     "status": "AVAILABLE",
     *     "creditLimit": 5000.00,
     *     "availableCredit": 4500.00,
     *     "outstandingBalance": 500.00,
     *     "interestRate": 14.5,
     *     "expiryDate": "09/2025",
     *     "cardholderName": "VIMANTHA DILSHAN",
     *     "notes": "Test Note!"
     * }
     */
    public function store(StoreCardRequest $request)
    {
        return app(Pipeline::class)
            ->send($request)
            ->through([
                CreditCard::class,
                DebitCard::class,
            ])
            ->then(fn ($results) => $results);
    }
}
