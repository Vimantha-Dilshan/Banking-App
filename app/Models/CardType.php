<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class CardType extends Model
{
    use HasFactory, Searchable;

    protected $guarded = [];

    const VISA = 'VISA';

    const MASTERCARD = 'MASTERCARD';

    const AMEX = 'AMEX';

    const DISCOVER = 'DISCOVER';

    const DINERS = 'DINERS';
}
