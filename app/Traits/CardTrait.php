<?php

namespace App\Traits;

use App\Models\CardType;
use App\Models\MastercardCreditCard;
use App\Models\MastercardDebitCard;
use App\Models\VisaCreditCard;
use App\Models\VisaDebitCard;

trait CardTrait
{
    public function checkCardAvailability($cardNumber, $cardType, $creditCard = false, $debitCard = false)
    {
        if ($creditCard) {
            return $this->checkCreditCardAvailability($cardNumber, $cardType);
        }

        if ($debitCard) {
            return $this->checkDebitCardAvailability($cardNumber, $cardType);
        }

        return false;
    }

    public function checkCreditCardAvailability($cardNumber, $cardType)
    {
        if ($cardType == CardType::VISA) {
            return VisaCreditCard::where('card_number', $cardNumber)
                ->available()
                ->first();
        }

        if ($cardType == CardType::MASTERCARD) {
            return MastercardCreditCard::where('card_number', $cardNumber)
                ->available()
                ->first();
        }

        return false;
    }

    public function checkDebitCardAvailability($cardNumber, $cardType)
    {
        if ($cardType == CardType::VISA) {
            return VisaDebitCard::where('card_number', $cardNumber)
                ->available()
                ->exists();
        }

        if ($cardType == CardType::MASTERCARD) {
            return MastercardDebitCard::where('card_number', $cardNumber)
                ->available()
                ->exists();
        }

        return false;
    }
}
