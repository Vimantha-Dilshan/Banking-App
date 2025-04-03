<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class CustomerAccount extends Model
{
    use HasFactory, Searchable;

    protected $guarded = [];

    public const STATUS_ACTIVE = 'A';

    public const STATUS_INACTIVE = 'I';

    public const STATUS_PENDING = 'P';

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function accountType()
    {
        return $this->belongsTo(AccountType::class, 'account_id');
    }

    public function transactions()
    {
        return $this->hasMany(CustomerAccountTransaction::class);
    }
}
