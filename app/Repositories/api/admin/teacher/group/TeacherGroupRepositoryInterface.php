<?php

namespace App\Repositories\api\admin\teacher\group;
use Illuminate\Http\Request;


interface TeacherGroupRepositoryInterface 
{
    /**
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request) : mixed;

    /**
     * @param Request $request
     * @param int|string $id
     * @return mixed
     */
    public function show(Request $request, int|string $id) : mixed;
}