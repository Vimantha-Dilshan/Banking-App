<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class DebitCardBilling extends Model
{
    use HasFactory, Searchable;

    protected $guarded = [];

    public const BILLING_STATUS_SUCCESS = 'SUCCESS';

    public const BILLING_STATUS_FAILED = 'FAILED';
}
