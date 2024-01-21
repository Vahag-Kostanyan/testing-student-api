<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\RoleModel;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function index(Request $request) 
    {
        
        return response()->json([
            'status' => 200,
            'message' => 'success',
        ]);  
    }
}
