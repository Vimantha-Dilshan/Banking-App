<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class StaffMember extends Model
{
    use HasFactory, Searchable;

    protected $guarded = [];

    public const STATUS_ACTIVE = 'ACTIVE';

    public const STATUS_INACTIVE = 'INACTIVE';

    public const STATUS_SUSPENDED = 'SUSPENDED';

    public const GENDER_MALE = 'MALE';

    public const GENDER_FEMALE = 'FEMALE';

    public const GENDER_OTHER = 'OTHER';

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
}
