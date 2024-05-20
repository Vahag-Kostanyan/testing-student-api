<?php

namespace App\Http\Requests\api\ValidationTrate\admin\teacher;

use App\Models\Question;
use App\Rules\GreaterThanZero;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;

trait QuestionValidationTrate
{

    /**
     * @param Request $request
     * @return array
     * @inheritDoc
     */
    protected function store_validation_rules(Request $request): array
    {
        return [
            'question_type_id' => ['required', 'exists:question_type,id'],
            'point' => ['required', 'integer', new GreaterThanZero],
            'title' => ['required', 'string'],
            'image' => ['nullable', 'string'],
            'answers.*.title' => ['sometimes', 'required', 'string'],
            'answers.*.image' => ['sometimes', 'required', 'url'],
            'answers.*.is_right' => ['sometimes', 'required', 'boolean'],
            'question_options.*.title' => ['sometimes', 'required', 'string'],
            'question_options.*.image' => ['sometimes', 'required', 'url'],
        ];
    }

    /**
     * @param Request $request
     * @return void
     */
    protected function store_after_validation(Request $request): void
    {
        parent::store_after_validation($request);
        if ($request->input('question_type_id') != 3) {
            if (!count($request->input('answers') ?? [])) {
                validationException(['answers is required!']);
            }

            $rightAnsswerCount = count(collect(array_column($request->input('answers'), 'is_right'))->filter(function ($answer) {
                return $answer === true;
            }));

            if ($rightAnsswerCount !== 1) {
                validationException(['There must be 1 right answer!']);
            }

            if (count($request->input('question_options') ?? [])) {
                if ($request->input('question_type_id') != 2) {
                    validationException(['Only optional_question type can have question_options field']);
                }
            }
            if ($request->input('question_type_id') == 2) {
                if (!count($request->input('question_options') ?? [])) {
                    validationException(['question_options is required!']);
                }
            }
        }
    }


    /**
     * @param int|null $id
     * @param Request $request
     * @return array
     */
    protected function update_validation_rules(Request $request, int|null $id): array
    {
        return [
            'question_type_id' => ['sometimes', 'required', 'exists:question_type,id'],
            'point' => ['sometimes', 'required', 'integer', new GreaterThanZero],
            'title' => ['sometimes', 'required', 'string'],
            'image' => ['sometimes', 'string', 'url'],
            'answers.*.title' => ['sometimes', 'required', 'string'],
            'answers.*.image' => ['sometimes', 'required', 'url'],
            'answers.*.is_right' => ['sometimes', 'required', 'boolean'],
            'answers.*.id' => ['sometimes', 'required', 'exists:answer,id'],
            'question_options.*.title' => ['sometimes', 'required', 'string'],
            'question_options.*.image' => ['sometimes', 'required', 'url'],
            'question_options.*.id' => ['sometimes', 'required', 'exists:question_option,id'],
        ];
    }

    /**
     * @return void
     * @param int|null $id
     * @param Request $request
     * @throws HttpResponseException
     */
    protected function update_before_validation(Request $request, int|null $id): void
    {
        parent::update_before_validation($request, $id);

        if (!auth()->user()->isSuperAdmin() && !Question::where('user_id', auth()->user()->id)->find($id)) {
            validationException(['This user cannot update this question']);
        }
    }


        /**
     * @return void
     * @param int|null $id
     * @param Request $request
     * @throws HttpResponseException
     */
    protected function update_after_validation(Request $request, int|null $id): void
    {
        parent::update_after_validation($request, $id);

        if (!auth()->user()->isSuperAdmin() && !Question::where('user_id', auth()->user()->id)->find($id)) {
            validationException(['This user cannot update this question']);
        }

        if ($request->input('question_type_id') != 3) {
            
            if($request->has('answers')){
                if (!count($request->input('answers') ?? [])) {
                    validationException(['answers is required!']);
                }
    
                $rightAnsswerCount = count(collect(array_column($request->input('answers'), 'is_right'))->filter(function ($answer) {
                    return $answer === true;
                }));
    
                if ($rightAnsswerCount !== 1) {
                    validationException(['There must be 1 right answer!']);
                }
            }

            if($request->has('question_options')){
                if (count($request->input('question_options') ?? []) && $request->input('question_type_id') != 2) {
                        validationException(['Only optional_question type can have question_options field']);
                }
                
                if ($request->input('question_type_id') == 2) {
                    if (!count($request->input('question_options') ?? [])) {
                        validationException(['question_options is required!']);
                    }
                }
            }
        }
    }

    /**
     * @return void
     * @param int|null $id
     * @param Request $request
     * @throws HttpResponseException
     */
    protected function destroy_before_validation(Request $request, int|null $id): void
    {
        parent::destroy_before_validation($request, $id);

        if (!auth()->user()->isSuperAdmin() && !Question::where('user_id', auth()->user()->id)->find($id)) {
            validationException(['This user cannot delete this question']);
        }
    }
}
