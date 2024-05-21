<?php

namespace App\Http\Requests\api\ValidationTrait\admin\teacher;

use App\Models\Question;
use App\Models\Test;
use App\Models\TestQuestion;
use Illuminate\Http\Request;
use Illuminate\Http\Exceptions\HttpResponseException;

trait TestQuestionsValidationTrait
{

    /**
     * @param Request $request
     * @return array
     */
    protected function store_validation_rules(Request $request): array
    {
        return $this->validation_rules();
    }

    /**
     * @param Request $request
     * @return void
     * @throws HttpResponseException
     */
    protected function store_after_validation(Request $request): void
    {
        parent::store_after_validation($request);
        $this->after_validation($request);
    }


    /**
     * @return void
     * @param int|null $id
     * @param Request $request
     * @throws HttpResponseException
     */
    protected function update_before_validation(Request $request, int|null $id) : void
    {
        parent::update_before_validation($request, $id);
        
        $this->before_validation($id, 'update');
    }
    
    /**
     * @param Request $request
     * @param int|null $id
     * @return array
     */
    protected function update_validation_rules(Request $request, int|null $id): array
    {
        return $this->validation_rules();
    }

    /**
     * @param Request $request
     * @param int|null $id
     * @return void
     * @throws HttpResponseException
     */
    protected function update_after_validation(Request $request, int|null $id): void
    {
        parent::store_after_validation($request);
        $this->after_validation($request);
    }


    /**
     * @return void
     * @param int|null $id
     * @param Request $request
     * @throws HttpResponseException
     */
    protected function destroy_before_validation(Request $request, int|null $id) : void
    {
        parent::destroy_before_validation($request, $id);
        
        $this->before_validation($id, 'delete');
    }

    /**
     * @return void
     * @param int|null $id
     * @param string $method
     * @param Request $request
     * @throws HttpResponseException
     */
    private function before_validation(int|null $id, string $method) : void
    {
        if(!auth()->user()->isSuperAdmin() && !TestQuestion::where('id', $id)->where('user_id', auth()->user()->id)->first()){
            validationException(["This user cannot $method this testQuestion"]);
        }
    }

        /**
     * @return void
     * @param int|null $id
     * @param string $method
     * @param Request $request
     * @throws HttpResponseException
     */
    private function after_validation(Request $request) : void
    {
        
        if(!auth()->user()->isSuperAdmin()){
            if(!Test::where('user_id', auth()->user()->id)->find($request->input('test_id'))){
                validationException(['test_id' => 'This user cannot use this test with id ' .$request->input('test_id')]);
            }
            if(!Question::where('user_id', auth()->user()->id)->find($request->input('question_id'))){
                validationException(['test_id' => 'This user cannot use this questio with id ' .$request->input('test_id')]);
            }
        }
    }


    /**
     * @return array
     */
    private function validation_rules() : array
    {
        return [
            'test_id' => ['required', 'integer', 'exists:test,id'],
            'question_id' => ['required', 'integer', 'exists:questions,id'],
        ];
    }
}
