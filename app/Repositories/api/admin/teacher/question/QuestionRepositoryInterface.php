<?php

namespace App\Repositories\api\admin\teacher\question;
use Illuminate\Http\Request;


interface QuestionRepositoryInterface 
{
    /**
     * @param Request $request
     * @return array
     */
    public function store(Request $request) : array;
    
    /**
     * @param Request $request
     * @param int|string $id
     * @return array
     */
    public function update(Request $request, int|string $id) : array;
}