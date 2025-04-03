<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class FeeType extends Model
{
    use HasFactory, Searchable;

    protected $guarded = [];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public const CUSTOMER_ACCOUNT_MINIMUM_CHARGE = 1;

    public const DEBIT_CARD_VISA_ANNAUL_CHARGE_ID = 2;

    public const DEBIT_CARD_MASTERCARD_ANNAUL_CHARGE_ID = 3;
}
