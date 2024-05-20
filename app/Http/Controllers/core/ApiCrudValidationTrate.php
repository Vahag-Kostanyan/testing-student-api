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
     * @param int|null $id
     * @return void
     * @exception HttpResponseException
     */
    protected function validation(string $method, Request $request, int|null $id = null): void
    {
        $rules = $this->call_before_validations_and_validations_rules($method, $request, $id);

        $validateor = Validator::make($request->all(), $rules);
        if ($validateor->fails()) {
            validationException($validateor->errors() ?? []);
        }

        $this->call_after_validations($method, $request, $id);
    }

    /**
     * @param string $method
     * @param Request $request
     * @param int|null $id
     * @return array
     */
    private function call_before_validations_and_validations_rules(string $method, Request $request, int|null $id = null): array
    {
        switch ($method) {
            case self::METHOD_INDEX:
                $this->index_before_validation($request);
                return $this->index_validation_rules($request);
            case self::METHOD_SHOW:
                $this->show_before_validation($request, $id);
                return $this->show_validation_rules($request, $id);
            case self::METHOD_STORE:
                $this->store_before_validation($request);
                return $this->store_validation_rules($request);
            case self::METHOD_UPDATE:
                $this->update_before_validation($request, $id);
                return $this->update_validation_rules($request, $id);
            case self::METHOD_DESTROY:
                $this->destroy_before_validation($request, $id);
                return $this->destroy_validation_rules($request, $id);
            default:
                return [];
        }
    }

    /**
     * @param string $method
     * @param Request $request
     * @param int|null $id
     * @return void
     */
    private function call_after_validations(string $method, Request $request, int|null $id = null): void
    {
        switch ($method) {
            case self::METHOD_INDEX:
                $this->index_after_validation($request);
                break;
            case self::METHOD_SHOW:
                $this->show_after_validation($request, $id);
                break;
            case self::METHOD_STORE:
                $this->store_after_validation($request);
                break;
            case self::METHOD_UPDATE:
                $this->update_after_validation($request, $id);
                break;
            case self::METHOD_DESTROY:
                $this->destroy_after_validation($request, $id);
                break;
        }
    }

    /**
     * @param Request $request
     * @return array
     */
    protected function index_validation_rules(Request $request): array
    {
        return [
            'page' => ['sometimes', 'required', 'integer'],
            'limit' => ['sometimes', 'required', 'integer'],
        ];
    }

    /**
     * @param Request $request
     * @return void
     * @throws HttpResponseException
     */
    protected function index_before_validation(Request $request): void
    {
        $errorArray = [];

        if ($request->has('sortDir')) {
            if (strtolower($request->input('sortDir')) != 'asc' && strtolower($request->input('sortDir')) != 'desc') {
                $errorArray[] = 'Invalide sortDir!';
            }
        }

        if ($request->has('sortBy')) {
            if (!in_array($request->input('sortBy'), $this->searchField)) {
                $errorArray[] = 'Invalide sortBy!';
            }
        }

        if ($request->has('include')) {
            $includes = explode('&', $request->input('include'));
            foreach ($includes as $include) {
                if (!in_array($include, $this->allowedIncludes)) {
                    $errorArray[] = "This relations $include is invalide";
                }
            }
        }

        if (!empty($errorArray)) {
            validationException($errorArray);
        }
    }

    /**
     * @param Request $request
     * @return void
     * @throws HttpResponseException
     */
    protected function index_after_validation(Request $request): void
    {
        if ($this->role_id) {
            $request->merge(['role_id' => $this->role_id]);
        }
    }


    /**
     * @param Request $request
     * @param int|null $id
     * @return array
     */
    protected function show_validation_rules(Request $request, int|null $id): array
    {
        return [];
    }

    /**
     * @param Request $request
     * @param int|null $id
     * @return void
     * @throws HttpResponseException
     */
    protected function show_before_validation(Request $request, int|null $id): void
    {
        $errorArray = [];
        if ($request->has('include')) {
            $includes = explode('&', $request->input('include'));
            foreach ($includes as $include) {
                if (!in_array($include, $this->allowedIncludes)) {
                    $errorArray[] = "This relations $include is invalide";
                }
            }
        }

        if (!empty($errorArray)) {
            validationException($errorArray);
        }
    }

    /**
     * @param Request $request
     * @param int|null $id
     * @return void
     * @throws HttpResponseException
     */
    protected function show_after_validation(Request $request, int|null $id): void
    {
        if ($this->role_id) {
            $request->merge(['role_id' => $this->role_id]);
        }
    }

    /**
     * @param Request $request
     * @return array
     */
    protected function store_validation_rules(Request $request): array
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
     * @param Request $request
     * @return void
     * @throws HttpResponseException
     */
    protected function store_after_validation(Request $request): void
    {
        if ($this->role_id) {
            $request->merge(['role_id' => $this->role_id]);
        }
    }

    /**
     * @param int|null $id
     * @param Request $request
     * @return array
     */
    protected function update_validation_rules(Request $request, int|null $id): array
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
        if ($this->role_id) {
            $record = $this->model->where('id', $id)->where('role_id', $this->role_id)->first();
        } else {
            $record = $this->model->find($id);
        }

        if (!$record) {
            validationException(['Invalid record id']);
        }
    }

    /**
     * @param Request $request
     * @param int|null $id
     * @return void
     * @throws HttpResponseException
     */
    protected function update_after_validation(Request $request, int|null $id): void
    {
        if ($this->role_id) {
            $request->merge(['role_id' => $this->role_id]);
        }
    }

    /**
     * @param int|null $id
     * @param Request $request
     * @return array
     */
    protected function destroy_validation_rules(Request $request, int|string $id): array
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
        if ($this->role_id) {
            $record = $this->model->where('id', $id)->where('role_id', $this->role_id)->first();
        } else {
            $record = $this->model->find($id);
        }

        if (!$record) {
            validationException(['Invalid record id']);
        }
    }

    /**
     * @param Request $request
     * @param int|null $id
     * @return void
     * @throws HttpResponseException
     */
    protected function destroy_after_validation(Request $request, int|null $id): void
    {
    }
}