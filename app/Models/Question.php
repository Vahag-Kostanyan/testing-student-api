<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Question extends Model
{
    use HasFactory;

    public const DEFINER = "get_question";
    public $table = "question";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'question_type_id',
        'user_id',
        'point',
        'title',
        'created_at',
        'updated_at'
    ];


    /**
     * @return HasOne
     */
    public function questionType() : HasOne
    {
        return $this->hasOne(QuestionType::class, 'id', 'question_type_id');
    }
}
