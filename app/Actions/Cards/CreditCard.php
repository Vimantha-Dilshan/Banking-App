<?php

namespace App\Actions\Cards;

use App\Traits\CardTrait;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CreditCard
{
    use CardTrait;

    public function handle(Request $request, Closure $next)
    {
        if (! $request->cardDetails['creditCard']) {
            return $next($request);
        }

        if (! $this->checkCardAvailability(
            $request->cardDetails['cardNumber'],
            $request->cardDetails['cardType'],
            true,
            false,
        )) {
            return response()->json(
                ['message' => $request->cardDetails['cardType'].' card number '.$request->cardDetails['cardNumber'].' is not available.'],
                Response::HTTP_UNPROCESSABLE_ENTITY,
            );
        }
    }
}
