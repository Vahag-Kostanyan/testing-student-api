<?php

namespace App\Http\Controllers\core;

use App\core\ApiCrudInterface;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

abstract class ApiCrudController extends Controller implements ApiCrudInterface
{
    protected Model $model;

    /**
     * @param Request $request
     * @return Response
     */
    public function find(Request $request) : Response
    {
        return response();
    }
    
    /**
     * @param Request $request
     * @return Response
     */
    public function create(Request $request) : Response
    {
        return response();
    }

    /**
     * @param Request $request
     * @param int|string $id
     * @return Response
     */
    public function update(Request $request, int|string $id) : Response
    {
        return response();
    }

    /**
     * @param Request $request
     * @param int|string $id
     * @return Response
     */
    public function delete(Request $request, int|string $id) : Response
    {
        return response();
    }
}
