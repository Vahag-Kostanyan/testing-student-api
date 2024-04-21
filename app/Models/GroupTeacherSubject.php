<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class GroupTeacherSubject extends Model
{
    use HasFactory;

    public $table = "group_teacher_subject";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'group_id',
        'subject_id',
        'created_at',
        'updated_at'
    ];

    /**
     * @return HasOne
     */
    public function techer() : HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
 
}
