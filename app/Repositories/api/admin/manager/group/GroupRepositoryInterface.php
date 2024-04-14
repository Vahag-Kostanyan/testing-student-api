<?php

namespace App\Repositories\api\admin\manager\group;
use App\Http\Requests\api\admin\admin\ChangePasswordRequest;
use Illuminate\Http\Request;


interface GroupRepositoryInterface 
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

    /**
     * @param Request $request
     * @param int|string $id
     * @return mixed
     */
    public function destroy(Request $request, int|string $id) : mixed;
}