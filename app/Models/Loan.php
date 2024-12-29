<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Loan extends Model
{
    use HasFactory, Searchable;

    protected $guarded = [];

    const LOAN_TYPE_PERSONAL = 'PERSONAL';

    const LOAN_TYPE_MORTGAGE = 'MORTGAGE';

    const LOAN_TYPE_CAR = 'CAR';

    const LOAN_TYPE_STUDENT = 'STUDENT';

    const LOAN_TYPE_BUSINESS = 'BUSINESS';

    const STATUS_PENDING = 'PENDING';

    const STATUS_APPROVED = 'APPROVED';

    const STATUS_REJECTED = 'REJECTED';

    const STATUS_COMPLETED = 'COMPLETED';

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
