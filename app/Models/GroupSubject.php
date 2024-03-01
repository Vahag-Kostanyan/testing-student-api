<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class GroupSubject extends Model
{
    use HasFactory;

    public static const DEFINER = "get_group_subject";

    public $table = "group_subject";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'group_id',
        'subject_id',
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


    /**
     * @return HasOne
     */
    public function subject() : HasOne
    {
        return $this->hasOne(Subject::class, 'id', 'subject_id');
    }
}
