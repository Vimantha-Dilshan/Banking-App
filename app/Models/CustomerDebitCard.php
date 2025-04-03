<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class CustomerDebitCard extends Model
{
    use HasFactory, Searchable;

    protected $guarded = [];

    const CARD_TYPE_VISA = 'VISA';

    const CARD_TYPE_MASTERCARD = 'MASTERCARD';

    const CARD_TYPE_AMEX = 'AMEX';

    const CARD_TYPE_DISCOVER = 'DISCOVER';

    const CARD_TYPE_MAESTRO = 'MAESTRO';

    const CARD_TYPE_JCB = 'JCB';

    const STATUS_ACTIVE = 'ACTIVE';

    const STATUS_INACTIVE = 'INACTIVE';

    const STATUS_SUSPENDED = 'SUSPENDED';

    const STATUS_CLOSED = 'CLOSED';

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
