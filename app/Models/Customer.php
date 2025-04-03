<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Customer extends Model
{
    use HasFactory, Searchable;

    protected $guarded = [];

    protected $casts = [
        'is_vip' => 'boolean',
        'disabled' => 'boolean',
    ];

    public const SALUTATION_MR = 'MR';

    public const SALUTATION_MISS = 'MISS';

    public const SALUTATION_MRS = 'MRS';

    public const SALUTATION_REV = 'REV';

    public const GENDER_MALE = 'MALE';

    public const GENDER_FEMALE = 'FEMALE';

    public const GENDER_OTHER = 'OTHER';

    public function creditCards()
    {
        return $this->hasMany(CreditCard::class);
    }

    public function debitCards()
    {
        return $this->hasMany(DebitCard::class);
    }

    public function loans()
    {
        return $this->hasMany(Loan::class);
    }

    public function fixedDeposits()
    {
        return $this->hasMany(FixedDeposit::class);
    }

    public function customerAccounts()
    {
        return $this->hasMany(CustomerAccount::class);
    }

    public function accounts()
    {
        return $this->belongsToMany(AccountType::class, 'customer_accounts', 'customer_id', 'account_id');
    }
}
