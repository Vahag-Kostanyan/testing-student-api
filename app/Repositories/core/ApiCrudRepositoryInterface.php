<?php

namespace App\Repositories\core;

use Illuminate\Http\Request;

interface ApiCrudRepositoryInterface 
{
        /**
     * @param Request $request
     * @param mixed $model
     * @param array $searchFaild
     * @return mixed
     */
    public function index(Request $request, mixed $model, array $searchFaild) : mixed;
    
    /**
     * @param Request $request
     * @param int|string $id
     * @param mixed $model
     * @return mixed
     */
    public function show(Request $request, int|string $id, mixed $model) : mixed;
    
    /**
     * @param Request $request
     * @param mixed $model
     * @return mixed
     */
    public function store(Request $request, mixed $model) : mixed;

    /**
     * @param Request $request
     * @param int|string $id
     * @param mixed $model
     * @return mixed
     */
    public function update(Request $request, int|string $id, mixed $model) : mixed;

    /**
     * @param Request $request
     * @param int|string $id
     * @param mixed $model
     * @return mixed
     */
    public function destroy(Request $request, int|string $id, mixed $model) : mixed;
}