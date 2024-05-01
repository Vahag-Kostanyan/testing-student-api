<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Question extends Model
{
    use HasFactory;

    public const DEFINER = "get_question";
    public $table = "questions";

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
        'image',
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

    /**
     * @return HasMany
     */
    public function questionOptions() : HasMany
    {
        return $this->hasMany(QuestionOption::class, 'question_id', 'id');
    }

    /**
     * @return HasMany
     */
    public function questionAnswers() : HasMany
    {
        return $this->hasMany(Answer::class, 'question_id', 'id');
    }
}
