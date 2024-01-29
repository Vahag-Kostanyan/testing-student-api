<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


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

    public $table = 'permission';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'definer',
        'page',
        'permission',
        'parent_id',
        'created_at',
        'updated_at'
    ];

}
