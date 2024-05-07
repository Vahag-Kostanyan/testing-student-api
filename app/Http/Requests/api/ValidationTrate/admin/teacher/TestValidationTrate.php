<?php

namespace App\Http\Requests\api\ValidationTrate\admin\teacher;

use App\Models\Test;
use Illuminate\Http\Request;
use Illuminate\Http\Exceptions\HttpResponseException;

trait TestValidationTrate
{

    /**
     * @param Request $request
     * @return array
     */
    protected function store_validation_rules(Request $request): array
    {
        return [
            'test_type_id' => ['required', 'integer', 'exists:test_type,id'],
            'subject_id' => ['required', 'integer', 'exists:subject,id'],
            'name' => ['required', 'string'],
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
        $request->merge(['user_id' => auth()->user()->id]);
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
        return [
            'test_type_id' => ['sometimes', 'required', 'integer', 'exists:test_type,id'],
            'subject_id' => ['sometimes', 'required', 'integer', 'exists:subject,id'],
            'name' => ['sometimes', 'required', 'string'],
        ];
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
        if(!auth()->user()->isSuperAdmin() && !Test::where('id', $id)->where('user_id', auth()->user()->id)->first()){

            validationException(["This user cannot $method this test"]);
        }
    }
}
