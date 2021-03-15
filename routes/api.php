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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Items routes
Route::get('/items', [ItemsApiController::class, 'index']);
Route::post('/items', [ItemsApiController::class, 'store']);
Route::get('/items/{item}', [ItemsApiController::class, 'show']);
Route::put('/items/{item}', [ItemsApiController::class, 'update']);
Route::delete('/items/{item}', [ItemsApiController::class, 'destroy']);
