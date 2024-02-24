<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;


/**
 * @var int $role_id
 * @var int $permission_id
 * @var string $created_at
 * @var string $updated_at
 */
class RolePermission extends Model
{
    use HasFactory;

    public $table = 'role_permission';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'role_id',
        'permission_id',
        'created_at',
        'updated_at'
    ];

    /**
     * @return HasOne
     */
    public function role(): HasOne
    {
        return $this->hasOne(Role::class,'id','role_id');
    }

    /**
     * @return HasOne
     */
    public function permission(): HasOne
    {
        return $this->hasOne(Permission::class,'id','permission_id');
    }
}