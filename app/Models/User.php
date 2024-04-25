<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @var string $username
 * @var string $email
 * @var string $password
 * @var string $remember_token
 * @var bool $status
 * @var string $email_verified_code
 * @var string $email_verified_at
 * @var int $role_id
 * @var string $created_at
 * @var string $updated_at
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public const DEFINER = "get_user";
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'status',
        'role_id',
        'email',
        'password',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'email_verified_code',
        'email_verified_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * @return HasOne
     */
    public function role() : HasOne 
    {
        return $this->hasOne(Role::class,'id','role_id');
    }


    /**
     * @return HasOne
     */
    public function userProfile() : HasOne 
    {
        return $this->hasOne(UserProfile::class,'user_id','id');
    }

    /**
     * @return HasMany
     */
    public function teacherSubjects() : HasMany 
    {
        return $this->hasMany(TeacherSubject::class,'user_id','id');
    }

    /**
     * @return bool
     */
    public function isTeacher() : bool
    {
        return $this->role_id == Role::where('name', 'teacher')->first()->id;
    }

    /**
     * @return bool
     */
    public function isSuperAdmin() : bool
    {
        return $this->role_id == Role::where('name', 'superAdmin')->first()->id;
    }

}
