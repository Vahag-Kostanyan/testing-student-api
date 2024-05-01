<?php

use App\Http\Controllers\api\admin\admin\PermissionController;
use App\Http\Controllers\api\admin\ProfileConntroller;
use App\Http\Controllers\api\admin\admin\RoleController;
use App\Http\Controllers\api\admin\admin\RolePermissionController;
use App\Http\Controllers\api\admin\admin\UserConntroller;
use App\Http\Controllers\api\admin\manager\GroupController;
use App\Http\Controllers\api\admin\manager\GroupTypeController;
use App\Http\Controllers\api\admin\manager\StudentController;
use App\Http\Controllers\api\admin\manager\SubjectController;
use App\Http\Controllers\api\admin\manager\TeacherController;
use App\Http\Controllers\api\admin\teacher\AnswerController;
use App\Http\Controllers\api\admin\teacher\QuestionController;
use App\Http\Controllers\api\admin\teacher\QuestionOptionController;
use App\Http\Controllers\api\admin\teacher\QuestionTypeController;
use App\Http\Controllers\api\ApiController;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\api\admin\teacher\GroupController as TeacherGroupController;
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
        Route::resource('/students', StudentController::class)->only(['index', 'show', 'store', 'update', 'destroy']); 
        Route::resource('/subjects', SubjectController::class)->only(['index', 'show', 'store', 'update', 'destroy']); 
        Route::resource('/teachers', TeacherController::class)->only(['index', 'show', 'store', 'update', 'destroy']); 
        Route::put('/teachers/subjects/{id}', [TeacherController::class, 'updateTeacherSubjects']); 
        Route::resource('/group_types', GroupTypeController::class)->only(['index']);
        Route::resource('/groups', GroupController::class)->only(['index', 'show', 'store', 'update', 'destroy']); 
        Route::put('/group/students/{id}', [GroupController::class, 'updateGroupStudents']); 
        Route::put('/group/teacher_and_subject/{id}', [GroupController::class, 'updateGroupTeacherAndSubjects']); 
    });

    Route::prefix('/teacher')->group(function () {
        Route::resource('/groups', TeacherGroupController::class)->only(['index', 'show']); 
        Route::resource('/questions', QuestionController::class)->only(['index', 'show', 'store', 'update', 'destroy']);
        Route::resource('/questions_type', QuestionTypeController::class)->only(['index']);
    });
    
});


require __DIR__.'/auth.php';