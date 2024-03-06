<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class GroupProfile extends Model
{
    use HasFactory;

    public const DEFINER = "get_group_profile";
    public $table = "group_profile";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'group_id',
        'name',
        'created_at',
        'updated_at'
    ];


    /**
     * @return HasOne
     */
    public function group() : HasOne
    {
        return $this->hasOne(Group::class, 'id', 'group_id');
    }

}
