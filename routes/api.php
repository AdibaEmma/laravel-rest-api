<?php

use App\Http\Controllers\ItemsApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriesApiController;


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

#########################################################################

// Categories routes
Route::get('/categories', [CategoriesApiController::class, 'index']);
Route::post('/categories', [CategoriesApiController::class, 'store']);
Route::get('/categories/{category}', [CategoriesApiController::class, 'show']);
Route::put('/categories/{category}', [CategoriesApiController::class, 'update']);
Route::delete('/categories/{category}', [CategoriesApiController::class, 'destroy']);
