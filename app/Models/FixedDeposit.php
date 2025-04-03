<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class FixedDeposit extends Model
{
    use HasFactory, Searchable;

    protected $guarded = [];

    protected $casts = [
        'closed' => 'boolean',
    ];

    const DEPOSIT_TERM_6_MONTHS = '6 MONTHS';

    const DEPOSIT_TERM_1_YEAR = '1 YEAR';

    const DEPOSIT_TERM_2_YEARS = '2 YEARS';

    const DEPOSIT_TERM_3_YEARS = '3 YEARS';

    const DEPOSIT_TERM_5_YEARS = '5 YEARS';

    const STATUS_ACTIVE = 'ACTIVE';

    const STATUS_MATURED = 'MATURED';

    const STATUS_WITHDRAWN = 'WITHDRAWN';

    const STATUS_CLOSED = 'CLOSED';

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
