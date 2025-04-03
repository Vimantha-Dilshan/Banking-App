<?php

namespace App\Actions\Cards;

use Closure;
use Illuminate\Http\Request;

class CreditCard
{
    public function handle(Request $request, Closure $next)
    {
        if (! $request->creditCard) {
            return $next($request);
        }
    }
}
