<?php

namespace App\Repositories\api\admin\teacher\question;

use App\Models\Answer;
use App\Models\Question;
use App\Models\QuestionOption;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class QuestionRepository implements QuestionRepositoryInterface
{
    /**
     * @param Request $request
     * @return array
     */
    public function store(Request $request): array
    {
        DB::beginTransaction();
        try {

            $question = Question::create([
                'question_type_id' => $request->input('question_type_id'),
                'user_id' => auth()->user()->id,
                'point' => $request->input('point'),
                'title' => $request->input('title'),
                'image' => $request->input('image') ?? null,
            ]);

            if ($request->has('question_options')) {
                $questionOptionsData = [];
                foreach ($request->input('question_options') as $question_option) {
                    $questionOptionsData[] = [
                        'question_id' => $question->id,
                        'title' => $question_option['title'],
                        'image' => $question_option['image'] ?? null,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }

                QuestionOption::insert($questionOptionsData);
            }

            if ($request->has('answers')) {
                $answersData = [];
                foreach ($request->input('answers') as $answer) {
                    $answersData[] = [
                        'question_id' => $question->id,
                        'title' => $answer['title'],
                        'is_right' => $answer['is_right'],
                        'image' => $answer['image'] ?? null,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];

                }
                Answer::insert($answersData);
            }

            DB::commit();
        } catch (Exception $error) {
            DB::rollBack();
            dd($error->getMessage());
            serverException();
        }

        return ['message' => 'Question created successfuly', 'data' => $question->load(['questionOptions', 'questionAnswers', 'questionType'])];
    }



    /**
     * @param Request $request
     * @param int|string $id
     * @return array
     */
    public function update(Request $request, int|string $id): array
    {
        DB::beginTransaction();

        try {
            $question = Question::find($id);
            $questionData = $request->only(['question_type_id', 'point', 'title', 'image']);

            if ($questionData) {
                foreach ($questionData as $key => $value) {
                    if (array_key_exists($key, $question->getAttributes())) {
                        $question->{$key} = $value; // Update the attribute with the new value
                    }
                }
            }

            if ($request->has('answers')) {
                $answersForDelete = Answer::where('question_id', $question->id)->whereNotIn('id', array_column($request->input('answers'), 'id'))->get();
                foreach ($answersForDelete as $item) {
                    $item->delete();
                }

                foreach ($request->input('answers') as $answer) {
                    if (isset($answer['id'])) {
                        $updateAnswer = Answer::find($answer['id']);
                        unset($answer['id']);
                        foreach ($answer as $key => $value) {
                            if (array_key_exists($key, $updateAnswer->getAttributes())) {
                                $updateAnswer->{$key} = $value; // Update the attribute with the new value
                            }
                        }
                        $updateAnswer->save();
                    } else {
                        Answer::create([
                            'question_id' => $question->id,
                            'title' => $answer['title'],
                            'is_right' => $answer['is_right'],
                            'image' => $answer['image'] ?? null,
                        ]);
                    }
                }
            }

            if ($request->has('question_options')) {
                $questionOptionForDelete = QuestionOption::where('question_id', $question->id)->whereNotIn('id', array_column($request->input('question_options'), 'id'))->get();
                foreach ($questionOptionForDelete as $item) {
                    $item->delete();
                }

                foreach ($request->input('question_options') as $question_option) {
                    if (isset($question_option['id'])) {
                        $updateQuestionOption = QuestionOption::find($question_option['id']);
                        unset($question_option['id']);
                        foreach ($question_option as $key => $value) {
                            if (array_key_exists($key, $updateQuestionOption->getAttributes())) {
                                $updateQuestionOption->{$key} = $value; // Update the attribute with the new value
                            }
                        }
                        $updateQuestionOption->save();
                    } else {
                        QuestionOption::create([
                            'question_id' => $question->id,
                            'title' => $answer['title'],
                            'image' => $answer['image'] ?? null,
                        ]);
                    }
                }
            }

            $question->save();
            DB::commit();
        } catch (Exception $error) {
            DB::rollBack();

            serverException();
        }


        return ['message' => 'Question created successfuly', 'data' => $question->load(['questionOptions', 'questionAnswers', 'questionType'])];
    }
}