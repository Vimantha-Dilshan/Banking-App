<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class CustomerAccountTransaction extends Model
{
    use HasFactory, Searchable;

    protected $guarded = [];

    const TRANSACTION_TYPE_DEPOSIT = 'DEPOSIT';

    const TRANSACTION_TYPE_WITHDRAWAL = 'WITHDRAWAL';

    const TRANSACTION_TYPE_TRANSFER = 'TRANSFER';

    const TRANSACTION_TYPE_FEE = 'FEE';

    const TRANSACTION_TYPE_INTEREST = 'INTEREST';

    const TRANSACTION_TYPE_ADJUSTMENT = 'ADJUSTMENT';

    const STATUS_PENDING = 'PENDING';

    const STATUS_COMPLETED = 'COMPLETED';

    const STATUS_FAILED = 'FAILED';

    const TRANSACTION_MODE_IN = 'IN';

    const TRANSACTION_MODE_OUT = 'OUT';

    public static function getTransactionTypes(): array
    {
        return [
            self::TRANSACTION_TYPE_DEPOSIT,
            self::TRANSACTION_TYPE_WITHDRAWAL,
            self::TRANSACTION_TYPE_TRANSFER,
            self::TRANSACTION_TYPE_FEE,
            self::TRANSACTION_TYPE_INTEREST,
            self::TRANSACTION_TYPE_ADJUSTMENT,
        ];
    }

    public static function getStatuses(): array
    {
        return [
            self::STATUS_PENDING,
            self::STATUS_COMPLETED,
            self::STATUS_FAILED,
        ];
    }

    public function customerAccount()
    {
        return $this->belongsTo(CustomerAccount::class);
    }
}
