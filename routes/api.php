<?php

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\NewsController;
use App\Http\Controllers\Api\TagsController;
use App\Http\Controllers\Api\CommentController;
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


Route::apiResource('news', NewsController::class)
    ->only(['index', 'show']);
Route::apiResource('tags', TagsController::class)
    ->only(['index', 'show']);
Route::apiResource('comments', CommentController::class)
    ->only(['index', 'show']);
Route::middleware('auth:sanctum')->group(function () {
    Route::resource('comments', CommentController::class)->except(['index', 'show']);
});


Route::prefix('api')
    ->middleware('api')->post('/login', [LoginController::class, 'login']);
