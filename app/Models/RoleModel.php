<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @var string $name
 * @var string $created_at
 * @var string $updated_at
 */
class RoleModel extends Model
{
    use HasFactory;

    public $table = "role";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'created_at',
        'updated_at'
    ];
}
