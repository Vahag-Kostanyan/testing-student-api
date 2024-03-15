<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @var string $name
 * @var string $definer
 * @var string $permission
 * @var string $created_at
 * @var string $updated_at
 */
class Permission extends Model
{
    use HasFactory;

    public const DEFINER = "get_permission";
    public $table = 'permission';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'page',
        'method',
        'created_at',
        'updated_at'
    ];

    /**
     * @return HasMany
     */
    public function rolePermission() : HasMany
    {
        return $this->hasMany(RolePermission::class, 'permission_id', 'id');
    }


    /**
     * @return HasMany
     */
    public function subPermission() : HasMany
    {
        return $this->hasMany(SubPermission::class, 'permission_id', 'id');
    }

}
