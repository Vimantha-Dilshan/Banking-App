<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Vault extends Model
{
    use HasFactory, Searchable;

    protected $guarded = [];

    public const TYPE_MAIN = 'MAIN';
    public const TYPE_SUB = 'SUB';

    public const STATUS_ACTIVE = 'ACTIVE';
    public const STATUS_INACTIVE = 'INACTIVE';

    public function transactions()
    {
        return $this->hasMany(VaultTransaction::class);
    }
}
