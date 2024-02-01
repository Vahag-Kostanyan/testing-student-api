<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class UserProfile extends Model
{
    use HasFactory;


    protected $table = 'user_profile';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'first_name',
        'last_name',
        'middle_name',
        'age',
        'courses',
        'created_at',
        'updated_at'
    ];

    /**
     * @return HasOne
     */
    public function user() : HasOne 
    {
        return $this->hasOne(UserProfile::class, 'user_id', 'id');
    }
}
