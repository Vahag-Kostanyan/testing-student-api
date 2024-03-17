<?php

use App\Http\Controllers\api\admin\admin\PermisionController;
use App\Http\Controllers\api\admin\admin\RoleController;
use App\Http\Controllers\api\admin\admin\RolePermissionController;
use App\Http\Controllers\api\admin\admin\UserConntroller;
use App\Http\Controllers\api\admin\admin\UserProfileConntroller;
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

    Route::prefix('/admin')->group(function () {
        Route::resource('/roles', RoleController::class)->only(['index', 'show', 'store', 'update', 'destroy']); 
        Route::resource('/permissions', PermisionController::class)->only(['index']); 
        Route::resource('/rolePermissions', RolePermissionController::class)->only(['index', 'store', 'update', 'destroy']); 
        Route::resource('/users', UserConntroller::class)->only(['index', 'show', 'store', 'update', 'destroy']); 
        // Route::resource('/user_profile', UserProfileConntroller::class)->only(['show', 'update']); 
    });

    Route::prefix('/manager')->group(function () {
    });

    Route::prefix('/teacher')->group(function () {
    });
    
});


require __DIR__.'/auth.php';