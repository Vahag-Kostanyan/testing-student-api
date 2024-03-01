<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class TestQuestionAnswer extends Model
{
    use HasFactory;


    public static const DEFINER = "get_test_question_answer";
    public $table = "test_question_answer";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'test_id',
        'question_id',
        'answer_id',
        'additional_information',
        'created_at',
        'updated_at'
    ];


    /**
     * @return HasOne
     */
    public function user() : HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    /**
     * @return HasOne
     */
    public function test() : HasOne
    {
        return $this->hasOne(Test::class, 'id', 'test_id');
    }


    /**
     * @return HasOne
     */
    public function question() : HasOne
    {
        return $this->hasOne(Question::class, 'id', 'question_id');
    }


    /**
     * @return HasOne
     */
    public function answer() : HasOne
    {
        return $this->hasOne(Answer::class, 'id', 'answer_id');
    }
}
