<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\v1\WalkerController as APIWalkerController;
use App\Http\Controllers\api\v1\UserController as APIUserController;
use App\Http\Controllers\api\v1\StoreOwnerController as APIStoreOwnerController;
use App\Http\Controllers\api\v1\PetOwnerController as APIPetOwnerController;
use App\Http\Controllers\api\v1\PetController as APIPetController;
use App\Http\Controllers\api\v1\StoreController as APIStoreController;
use App\Http\Controllers\api\v1\ProductController as APIProductController;
use App\Http\Controllers\api\v1\WalkController as APIWalkController;

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
Route::apiResource('/v1/stores', APIStoreController::class);
Route::apiResource('/v1/stores/products', APIProductController::class);
Route::apiResource('/v1/petowners', APIPetOwnerController::class);
Route::apiResource('/v1/petowners/pets', APIPetController::class);
Route::apiResource('/v1/walks', APIWalkController::class);


// Route::get('V1/walker/{document}', [APIWalkerController::class, 'show']);
// Route::get('V1/storeowner/{document}', [APIWalkerController::class, 'show']);
// Route::get('V1/petowner/{document}', [APIWalkerController::class, 'show']);

