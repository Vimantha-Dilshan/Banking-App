<?php

namespace App\Traits;

class CardTrait
{
    public function checkCardAvailability($cardNumber, $cardType, $creditCard = false, $debitCard = false)
    {
        if ($creditCard) {
            return $this->checkCreditCard($cardNumber, $cardType);
        }

        if ($debitCard) {
            return $this->checkDebitCard($cardNumber, $cardType);
        }
    }

    public function checkCreditCard($cardNumber, $cardType)
    {
        return true;
    }

    public function checkDebitCard($cardNumber, $cardType)
    {
        return true;
    }
}
