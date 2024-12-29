<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class AccountType extends Model
{
    use HasFactory, Searchable;

    public const STATUS_ACTIVE = 'A';

    public const STATUS_INACTIVE = 'I';

    public const STATUS_PENDING = 'P';

    public const CATEGORY_KIDS = 'KIDS';

    public const CATEGORY_TEEN = 'TEEN';

    public const CATEGORY_COMMERCIAL = 'COMMERCIAL';

    public const KIDS_SMARTY_PIGGY = [
        'name' => 'Smarty Piggy Savings',
        'description' => 'Encourages kids to save in a fun and engaging way.',
        'category' => self::CATEGORY_KIDS,
    ];

    public const KIDS_LITTLE_CHAMPS = [
        'name' => 'Little Champs Rewards',
        'description' => 'A rewards-based account for young achievers.',
        'category' => self::CATEGORY_KIDS,
    ];

    public const KIDS_BRIGHT_FUTURES = [
        'name' => 'Bright Futures Fund',
        'description' => 'Designed to help parents save for their child’s education.',
        'category' => self::CATEGORY_KIDS,
    ];

    public const TEEN_FREEDOM_SAVERS = [
        'name' => 'Freedom Savers',
        'description' => 'Offers teens their first taste of financial independence.',
        'category' => self::CATEGORY_TEEN,
    ];

    public const TEEN_CAMPUS_PLUS = [
        'name' => 'Campus Plus Account',
        'description' => 'A student-friendly account with low fees and added perks.',
        'category' => self::CATEGORY_TEEN,
    ];

    public const TEEN_MY_STASH = [
        'name' => 'My Stash Account',
        'description' => 'A fun account for teens to save their allowances and pocket money.',
        'category' => self::CATEGORY_TEEN,
    ];

    public const TEEN_DREAM_BUILDER = [
        'name' => 'Dream Builder Savings',
        'description' => 'Helps teens save for their dreams, like a new gadget or a trip.',
        'category' => self::CATEGORY_TEEN,
    ];

    public const TEEN_VAULT_PREPAID = [
        'name' => 'Teen Vault Prepaid',
        'description' => 'A secure account linked to a prepaid card for responsible spending.',
        'category' => self::CATEGORY_TEEN,
    ];

    public const COMM_PAYSTREAM_SALARY = [
        'name' => 'PayStream Salary Account',
        'description' => 'A hassle-free account for salary deposits with exclusive benefits.',
        'category' => self::CATEGORY_COMMERCIAL,
    ];

    public const COMM_PRIME_SAVER = [
        'name' => 'Prime Saver Account',
        'description' => 'A classic savings account with a competitive interest rate.',
        'category' => self::CATEGORY_COMMERCIAL,
    ];

    public const COMM_BIZFLOW_CHECKING = [
        'name' => 'BizFlow Checking',
        'description' => 'A streamlined account for businesses to manage their finances.',
        'category' => self::CATEGORY_COMMERCIAL,
    ];

    public const COMM_GOLD_RESERVE = [
        'name' => 'Gold Reserve Deposit',
        'description' => 'A fixed-term account offering higher returns for long-term savings.',
        'category' => self::CATEGORY_COMMERCIAL,
    ];

    public const COMM_WEALTHGROW_PREMIUM = [
        'name' => 'WealthGrow Premium',
        'description' => 'A high-yield savings account for customers with substantial balances.',
        'category' => self::CATEGORY_COMMERCIAL,
    ];

    protected $guarded = [];

    public function customerAccounts()
    {
        return $this->hasMany(CustomerAccount::class, 'account_id');
    }
}
