<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class UserTest extends Model
{
    use HasFactory;

    public const DEFINER = "get_user_test";

    public $table = "user_test";

    public const STATUS_PENDING = 'pending';
    public const STATUS_CANCEL = 'cancel';
    public const STATUS_SUCCESS = 'success';
    public const STATUS_FAILED = 'failed';
    
     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'test_id',
        'user_id',
        'status',
        'mark',
        'test_data_from',
        'test_data_to',
        'created_at',
        'updated_at'
    ];

    
    /**
     * @return HasOne
     */
    public function test() : HasOne
    {
        return $this->hasOne(Test::class, 'id', 'test_id');
    }

    /**
     * @return HasOne
     */
    public function user() : HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
