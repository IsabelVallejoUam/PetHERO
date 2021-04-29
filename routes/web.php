<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\WalkerController;
use App\Http\Controllers\WalkController;
use App\Http\Controllers\PetOwnerController;
use App\Http\Controllers\StoreOwnerController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('Inicio.welcome');});

Route::view('/registerOptions', 'Inicio.register');

Route::view('/lobby', 'Inicio.lobby');


//Route::get('/walker/show/{document}', [WalkerController::class, 'show']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('/walker', WalkerController::class);

Route::resource('/storeOwner', StoreOwnerController::class);

Route::resource('/petOwner', PetOwnerController::class);

Route::resource('/walkRequest',WalkController::class);

Route::resource('/store',StoreController::class);

Route::resource('/product',ProductController::class);

Route::get('/walker/profile/{walker}', [App\Http\Controllers\WalkerController::class, 'profile'])->name('walker.profile');

Route::get('/petOwner/profile/{petOwner}', [App\Http\Controllers\PetOwnerController::class, 'profile'])->name('petOwner.profile');


Route::post('/petOwner/favorite/{walker}', [App\Http\Controllers\PetOwnerController::class, 'addFavoriteWalker'])->name('petOwner.addFavoriteWalker');

Route::post('/useravatar', [App\Http\Controllers\UserController::class,'update_avatar']);
Route::post('/productdata', [App\Http\Controllers\ProductController::class,'getData'])->name('product.getData');
Route::post('/product', [App\Http\Controllers\ProductController::class,'store'])->name('product.store');


