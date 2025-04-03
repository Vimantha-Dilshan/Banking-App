<?php

namespace App\Actions\Cards;

use Closure;
use Illuminate\Http\Request;

class DebitCard
{
    public function handle(Request $request, Closure $next)
    {
        if (! $request->debitCard) {
            return $next($request);
        }
    }
}
