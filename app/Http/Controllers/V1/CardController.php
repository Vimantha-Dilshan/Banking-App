<?php

namespace App\Http\Controllers\V1;

use App\Actions\Cards\CreditCard;
use App\Actions\Cards\DebitCard;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;

/**
 * @group Card Management
 *
 * @authenticated
 */
class CardController extends Controller
{
    public function store(Request $request)
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
