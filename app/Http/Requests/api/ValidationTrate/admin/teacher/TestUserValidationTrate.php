<?php

namespace App\Http\Requests\api\ValidationTrait\admin\teacher;

use App\Models\User;
use App\Models\UserTest;
use Illuminate\Http\Request;
use Illuminate\Http\Exceptions\HttpResponseException;

trait TestUserValidationTrait
{

    /**
     * @param Request $request
     * @return array
     */
    protected function store_validation_rules(Request $request): array
    {
        return [
            'test_id' => ['required', 'integer', 'exists:test,id'],
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'test_data_from' => ['required', 'string', 'date'],
            'test_data_to' => ['required', 'string', 'date'],
        ];
    }

    /**
     * @param Request $request
     * @return void
     * @throws HttpResponseException
     */
    protected function store_after_validation(Request $request): void
    {
        parent::store_after_validation($request);

        if(!User::find($request->input('user_id'))->isStudent()){
            validationException(['the user_id must be the id of students']);
        }

        if(UserTest::where('test_id', $request->input('test_id'))->where('user_id', $request->input('user_id'))->first()){
            validationException(['User already has this test']);
        }
    }

    /**
     * @return void
     * @param int|null $id
     * @param Request $request
     * @throws HttpResponseException
     */
    protected function destroy_after_validation(Request $request, int|null $id) : void
    {
        parent::destroy_after_validation($request, $id);
        
        if(!auth()->user()->isSuperAdmin() && !UserTest::where('id', $id)->where('user_id', auth()->user()->id)->first()){
            validationException(['This user cannot delete this test']);
        }
    }
}
