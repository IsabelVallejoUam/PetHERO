<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\WalkerController;
use App\Http\Controllers\WalkController;
use App\Http\Controllers\PetOwnerController;
use App\Http\Controllers\StoreOwnerController;

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
    return view('welcome');
});

//Route::get('/walker/show/{document}', [WalkerController::class, 'show']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('/walker', WalkerController::class);

Route::resource('/storeOwner', StoreOwnerController::class);

Route::resource('/petOwner', PetOwnerController::class);

Route::resource('/walkRequest',WalkController::class);

// Route::get('/walker/{document}', [App\Http\Controllers\WalkerController::class, 'show'])->name('show');
