<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class SubPermission extends Model
{
    use HasFactory;

    public const DEFINER = "get_sub_permission";
    public $table = 'sub_permission';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'permission_id',
        'page',
        'method',
        'created_at',
        'updated_at'
    ];

    /**
     * @return HasOne
     */
    public function permission() : HasOne
    {
        return $this->hasOne(Permission::class, 'id', 'permission_id');
    }

}
