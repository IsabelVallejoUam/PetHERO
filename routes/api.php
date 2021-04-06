<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\v1\WalkerController as APIWalkerController;
use App\Http\Controllers\api\v1\UserController as APIUserController;
use App\Http\Controllers\api\v1\StoreOwnerController as APIStoreOwnerController;
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
Route::apiResource('/v1/walkers', APIWalkerController::class);
Route::apiResource('/v1/users', APIUserController::class);
Route::apiResource('/v1/storeowners', APIStoreOwnerController::class);