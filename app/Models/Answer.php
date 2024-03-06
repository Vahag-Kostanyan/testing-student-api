<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Answer extends Model
{
    use HasFactory;

    public const DEFINER = "get_answer";
    public $table = "answer";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'question_id',
        'is_right',
        'name',
        'created_at',
        'updated_at'
    ];


    /**
     * @return HasOne
     */
    public function question() : HasOne
    {
        return $this->hasOne(Question::class, 'id', 'question_id');
    }
}
