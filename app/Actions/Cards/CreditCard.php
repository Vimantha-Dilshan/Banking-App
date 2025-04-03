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
        if (! $request->creditCard) {
            return $next($request);
        }

        if (! $this->checkCardAvailability(
            $request->cardNumber,
            $request->cardType,
            true,
        )) {
            return response()->json(
                ['message' => $request->cardType.' card number '.$request->cardNumber.' is not available.'],
                Response::HTTP_UNPROCESSABLE_ENTITY,
            );
        }
    }
}
