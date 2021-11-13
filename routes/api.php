<?php

use App\Http\Controllers\LessonController;
use App\Http\Controllers\StudentController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('students')->group(function () {
    Route::get('/', [StudentController::class, 'index']);
    Route::get('/{student}', [StudentController::class, 'show']);
    Route::post('/{student}', [StudentController::class, 'store']);
});

Route::prefix('lessons')->group(function () {
    Route::get('/', [LessonController::class, 'index']);
    Route::patch('/{lesson}', [LessonController::class, 'update']);
    Route::post('/{lesson}', [LessonController::class, 'destroy']);
});