<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Transaction extends Model
{
    use HasFactory, Searchable;

    const TRANSACTION_TYPE_DEPOSIT = 'DEPOSIT';

    const TRANSACTION_TYPE_WITHDRAWAL = 'WITHDRAWAL';

    const TRANSACTION_TYPE_TRANSFER = 'TRANSFER';

    const TRANSACTION_TYPE_PAYMENT = 'PAYMENT';

    const STATUS_PENDING = 'PENDING';

    const STATUS_COMPLETED = 'COMPLETED';

    const STATUS_FAILED = 'FAILED';

    const STATUS_CANCELLED = 'CANCELLED';

    protected $guarded = [];

    public function customerAccount()
    {
        return $this->belongsTo(CustomerAccount::class);
    }
}
