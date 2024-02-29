<?php

namespace App\Http\Controllers\core;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

interface ApiCrudInterface 
{
    /**
     * @param Request $request
     * @return Response
     */
    public function index(Request $request) : Response;
    
    /**
     * @param Request $request
     * @return Response
     */
    public function show(Request $request, int|string $id) : Response;
    
    /**
     * @param Request $request
     * @return Response
     */
    public function store(Request $request) : Response;

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
    public function destroy(Request $request, int|string $id) : Response;
}