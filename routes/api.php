<?php

use App\Http\Controllers\api\admin\admin\PermissionController;
use App\Http\Controllers\api\admin\admin\ProfileConntroller;
use App\Http\Controllers\api\admin\admin\RoleController;
use App\Http\Controllers\api\admin\admin\RolePermissionController;
use App\Http\Controllers\api\admin\admin\UserConntroller;
use App\Http\Controllers\api\admin\manager\StudentsController;
use App\Http\Controllers\api\admin\manager\SubjectsController;
use App\Http\Controllers\api\admin\manager\TeachersController;
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

    Route::resource('/profile', ProfileConntroller::class)->only(['update']); 
    Route::patch('/profile/changePassword/{id}', [ProfileConntroller::class, 'changePassword']);

    Route::prefix('/admin')->group(function () {
        Route::resource('/roles', RoleController::class)->only(['index', 'show', 'store', 'update', 'destroy']); 
        Route::resource('/permissions', PermissionController::class)->only(['index']); 
        Route::post('/rolePermissions', [RolePermissionController::class, 'creadAndUpdate']);
        Route::resource('/users', UserConntroller::class)->only(['index', 'show', 'store', 'update', 'destroy']); 
    });

    Route::prefix('/manager')->group(function () {
        Route::resource('/students', StudentsController::class)->only(['index', 'show', 'store', 'update', 'destroy']); 
        Route::resource('/subjects', SubjectsController::class)->only(['index', 'show', 'store', 'update', 'destroy']); 
        Route::resource('/teachers', TeachersController::class)->only(['index', 'show', 'store', 'update', 'destroy']); 
    });

    Route::prefix('/teacher')->group(function () {
    });
    
});


require __DIR__.'/auth.php';