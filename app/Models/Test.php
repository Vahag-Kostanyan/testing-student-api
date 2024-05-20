<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Test extends Model
{
    use HasFactory;

    public $table = "test";
    public const DEFINER = "get_test";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'test_type_id',
        'user_id',
        'subject_id',
        'name',
        'created_at',
        'updated_at'
    ];

    
    /**
     * @return HasOne
     */
    public function type() : HasOne
    {
        return $this->hasOne(TestType::class, 'id', 'test_type_id');
    }

    /**
     * @return HasOne
     */
    public function user() : HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    /**
     * @return HasOne
     */
    public function testUsers() : HasMany
    {
        return $this->hasMany(UserTest::class, 'test_id', 'id');
    }

    /**
     * @return HasOne
     */
    public function subject() : HasOne
    {
        return $this->hasOne(Subject::class, 'id', 'subject_id');
    }
}
