<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Branch extends Model
{
    use HasFactory, Searchable;

    protected $guarded = [];

    public const STATUS_ACTIVE = 'ACTIVE';
    public const STATUS_INACTIVE = 'INACTIVE';
    public const STATUS_CLOSED = 'CLOSED';

    public function manager()
    {
        return $this->hasOne(StaffMember::class);
    }
}
