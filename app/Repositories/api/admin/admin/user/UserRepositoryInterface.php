<?php

namespace App\Repositories\api\admin\admin\user;
use Illuminate\Http\Request;


interface UserRepositoryInterface 
{
    /**
     * @param Request $request
     * @return array
     */
    public function store(Request $request) : array;

    /**
     * @param Request $request
     * @param string|int $id
     * @return array
     */
    public function update(Request $request, string|int $id) : array;
}