<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class VisaDebitCard extends Model
{
    use HasFactory, Searchable;

    protected $guarded = [];

    protected $casts = [
        'expiry_date' => 'date',
    ];

    public const STATUS_AVAILABLE = 'AVAILABLE';

    public const STATUS_ALLOCATED = 'ALLOCATED';

    public const STATUS_EXPIRED = 'EXPIRED';

    public const STATUS_BLOCKED = 'BLOCKED';

    public function scopeAvailable($query)
    {
        return $query->where('status', self::STATUS_AVAILABLE);
    }
}
