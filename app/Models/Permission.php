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
    public const TYPE_MENU = 'menu';
    public const TYPE_SUB_MENU = 'sub_menu';
    public const TYPE_SUB_MENU_CONTENT = 'sub_menu_content';
    public const TYPE_UNIQUE_MENU = 'unique_menu';
    
    public $table = 'permission';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'type',
        'page',
        'method',
        'group_id',
        'parent_group_id',
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
