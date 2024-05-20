<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Group extends Model
{
    use HasFactory;

    public const DEFINER = "get_group";
    public $table = "group";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'parent_id',
        'user_id',
        'group_type_id',
        'name',
        'description',
        'created_at',
        'updated_at'
    ];


    /**
     * @return HasOne
     */
    public function parent() : HasOne{
        return $this->hasOne(self::class, 'id', 'parent_id');
    }

    /**
     * @return HasOne
     */
    public function teacher() : HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    
    /**
     * @return HasOne
     */
    public function groupType() : HasOne
    {
        return $this->hasOne(GroupType::class, 'id', 'group_type_id');
    }

    /**
     * @return HasOne
     */
    public function groupUsers() : HasMany
    {
        return $this->hasMany(GroupUser::class, 'group_id', 'id');
    }
    
    /**
     * @return HasOne
     */
    public function groupTeacherSubject() : HasMany
    {
        return $this->hasMany(GroupTeacherSubject::class, 'group_id', 'id');
    }
}
