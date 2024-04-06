<?php

namespace App\Http\Controllers\core;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

trait ApiCrudValidationTrate
{

    /**
     * @param string $method
     * @param Request $request
     */
    protected function validation(string $action, Request $request, int|null $id = null)
    {
        switch ($action) {
            case 'store':
                $this->store_before_validation($request);
                $rules = $this->store_validation_rules();
                break;
            case 'update':
                $this->update_before_validation($request, $id);
                $rules = $this->update_validation_rules();
                break;
            case 'destroy':
                $this->destroy_before_validation($request, $id);
                $rules = $this->destroy_validation_rules();
                break;
            default:
                $rules = [];
        }

        $validateor = Validator::make($request->all(), $rules);
        if ($validateor->fails()) {
            throw new HttpResponseException(response()->json([
                'message' => 'Validation failed',
                'status' => false,
                'errors' => $validateor->errors(),
            ], 422));
        }
    }

    /**
     * @return array
     */
    protected function store_validation_rules(): array
    {
        return [];
    }

    /**
     * @param Request $request
     * @return void
     * @throws HttpResponseException
     */
    protected function store_before_validation(Request $request): void 
    {
    }

    /**
     * @return array
     */
    protected function update_validation_rules(): array
    {
        return [];
    }

    /**
     * @param int|null $id
     * @param Request $request
     * @return void
     * @throws HttpResponseException
     */
    protected function update_before_validation(Request $request, int|null $id): void 
    {
        $record = $this->model->find($id);
        
        if(!$record){
            throw new HttpResponseException(response()->json([
                'message' => 'Validation failed',
                'status' => false,
                'errors' => ['Invalid record id'],
            ], 422));
        }
    }

    /**
     * @return array
     */
    protected function destroy_validation_rules(): array
    {
        return [];
    }

    /**
     * @return void
     * @param int|null $id
     * @param Request $request
     * @throws HttpResponseException
     */
    protected function destroy_before_validation(Request $request, int|null $id): void
    {
        $record = $this->model->find($id);
        
        if(!$record){
            throw new HttpResponseException(response()->json([
                'message' => 'Validation failed',
                'status' => false,
                'errors' => ['Invalid record id'],
            ], 422));
        }
    }
}
