<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:passport')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('teacher', App\Http\Controllers\Api\TeacherController::class)->except('store', 'update', 'destroy');
Route::apiResource('direction', App\Http\Controllers\Api\DirectionController::class)->except('store', 'update', 'destroy');
Route::apiResource('student', App\Http\Controllers\Api\StudentController::class)->except('store', 'update', 'destroy');
Route::apiResource('course', App\Http\Controllers\Api\CourseController::class)->except('store', 'update', 'destroy');

Route::prefix('admin')->middleware('auth:passport')->group(function () {
    Route::apiResource('teacher', App\Http\Controllers\Admin\TeacherController::class);
    Route::apiResource('direction', App\Http\Controllers\Admin\DirectionController::class);
    Route::apiResource('student', App\Http\Controllers\Admin\StudentController::class);
    Route::apiResource('course', App\Http\Controllers\Admin\CourseController::class);
});
