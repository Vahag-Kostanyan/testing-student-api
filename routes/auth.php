<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\auth\AuthController;


Route::post('/login', [AuthController::class, 'login'])
        ->middleware('guest')
        ->name('login');

Route::get('/getMe', [AuthController::class, 'getMe'])->middleware('auth:sanctum');