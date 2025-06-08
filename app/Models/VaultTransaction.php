<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class VaultTransaction extends Model
{
    use HasFactory, Searchable;

    protected $guarded = [];

    public const TYPE_IN = 'IN';
    public const TYPE_OUT = 'OUT';

    public function vault()
    {
        return $this->belongsTo(Vault::class);
    }

    public function staff()
    {
        return $this->belongsTo(StaffMember::class);
    }
}
