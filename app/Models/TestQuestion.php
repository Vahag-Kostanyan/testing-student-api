<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class TestQuestion extends Model
{
    use HasFactory;
    public const DEFINER = "get_test_question";
    public $table = "test_question";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'test_id',
        'question_id',
        'created_at',
        'updated_at'
    ];


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
}
