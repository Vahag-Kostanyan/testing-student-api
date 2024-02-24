<?php

use App\Http\Controllers\api\admin\PermissionController;
use App\Http\Controllers\api\admin\RoleController;
use App\Http\Controllers\api\ApiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/', [ApiController::class,'index'])->name('index');

Route::middleware(['auth:sanctum', 'action.permission'])->group(function () {
    Route::resource('/permission', PermissionController::class);
    Route::resource('/role', RoleController::class); 
});


require __DIR__.'/auth.php';