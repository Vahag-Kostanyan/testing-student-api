<?php

namespace  App\core;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

interface ApiCrudInterface 
{
    /**
     * @param Request $request
     * @return Response
     */
    public function find(Request $request) : Response;
    
    /**
     * @param Request $request
     * @return Response
     */
    public function create(Request $request) : Response;

    /**
     * @param Request $request
     * @param int|string $id
     * @return Response
     */
    public function update(Request $request, int|string $id) : Response;

    /**
     * @param Request $request
     * @param int|string $id
     * @return Response
     */
    public function delete(Request $request, int|string $id) : Response;
}