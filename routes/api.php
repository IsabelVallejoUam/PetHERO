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

use App\Http\Controllers\api\v1\FavoritePetController as APIFavoritePetController;
use App\Http\Controllers\api\v1\FavoriteStoreController as APIFavoriteStoreController;
use App\Http\Controllers\api\v1\FavoriteWalkerController as APIFavoriteWalkerController;

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

Route::name('api.')->group(function () {
Route::apiResource('/v1/walkers', APIWalkerController::class);
Route::apiResource('/v1/users', APIUserController::class);
Route::apiResource('/v1/storeOwners', APIStoreOwnerController::class);
Route::apiResource('/v1/stores', APIStoreController::class);
    Route::get('/v1/stores/user/{user}', [APIStoreController::class,  'indexUser']);

Route::apiResource('/v1/products', APIProductController::class);
Route::apiResource('/v1/petOwners', APIPetOwnerController::class);
Route::apiResource('/v1/pets', APIPetController::class);
    Route::get('/v1/pets/user/{user}', [APIPetController::class,  'indexUser']);    
Route::apiResource('/v1/walks', APIWalkController::class);

Route::apiResource('/v1/favoritePets', APIFavoritePetController::class);
    Route::get('/v1/favoritePets/user/{user}', [APIFavoritePetController::class, 'indexUser']);
    Route::get('/v1/favoritePets/user/{user}/pet/{pet}', [APIFavoritePetController::class, 'showUser']);

Route::apiResource('/v1/favoriteStores', APIFavoriteStoreController::class);
    Route::get('/v1/favoriteStores/user/{user}', [APIFavoriteStoreController::class, 'indexUser']);
    Route::get('/v1/favoriteStores/user/{user}/store/{store}', [APIFavoriteStoreController::class, 'showUser']);

Route::apiResource('/v1/favoriteWalkers', APIFavoriteWalkerController::class);
    Route::get('/v1/favoriteWalkers/user/{user}', [APIFavoriteWalkerController::class, 'indexUser']);
    Route::get('/v1/favoriteWalkers/user/{user}/walker/{walker}', [APIFavoriteWalkerController::class, 'showUser']);

});

