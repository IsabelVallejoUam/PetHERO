<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\WalkerController;
use App\Http\Controllers\WalkController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\PetOwnerController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\StoreOwnerController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\FavoriteStoreController;
use App\Http\Controllers\FavoriteWalkerController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\CKEditorController;

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
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::resource('/walker', WalkerController::class);

Route::get('/walks', [App\Http\Controllers\WalkController::class,'walkerIndex'])->name('walk.walkerIndex');
Route::get('/walks/finished', [App\Http\Controllers\WalkController::class,'walkerIndexFinished'])->name('walk.walkerIndexFinished');
Route::get('/walks/pending', [App\Http\Controllers\WalkController::class,'walkerIndexPending'])->name('walk.walkerIndexPending');
Route::get('/walks/active', [App\Http\Controllers\WalkController::class,'walkerIndexActive'])->name('walk.walkerIndexActive');
Route::get('/petowner/walks/pending', [App\Http\Controllers\WalkController::class,'indexPending'])->name('walk.indexPending');
Route::get('/petowner/walks/active', [App\Http\Controllers\WalkController::class,'indexActive'])->name('walk.indexActive');
Route::get('/petowner/walks/finished', [App\Http\Controllers\WalkController::class,'indexFinished'])->name('walk.indexFinished');

Route::resource('/comment', CommentController::class);
Route::resource('/post', PostController::class);
Route::resource('/walker/route', RouteController::class);
Route::resource('/forum', ForumController::class);
Route::resource('/walk', WalkController::class);
Route::post('ckeditor/image_upload', [CKEditorController::class, 'upload'])->name('upload');

Route::get('/walker/profile/{walker}', [App\Http\Controllers\WalkerController::class, 'profile'])->name('walker.profile');
Route::post('/walker/favorite/pet/{pet}', [App\Http\Controllers\WalkerController::class, 'addFavoritePet'])->name('walker.addFavoritePet');

Route::resource('/storeOwner', StoreOwnerController::class);
Route::get('/storeOwner/profile/{storeOwner}', [App\Http\Controllers\StoreOwnerController::class, 'profile'])->name('storeOwner.profile');

Route::resource('/petOwner', PetOwnerController::class);
Route::get('/petOwner/profile/{petOwner}', [App\Http\Controllers\PetOwnerController::class, 'profile'])->name('petOwner.profile');
Route::post('/petOwner/favorite/walker/{walker}', [App\Http\Controllers\PetOwnerController::class, 'addFavoriteWalker'])->name('petOwner.addFavoriteWalker');
Route::post('/petOwner/favorite/store/{store}', [App\Http\Controllers\PetOwnerController::class, 'addFavoriteStore'])->name('petOwner.addFavoriteStore');

Route::resource('/pet', PetController::class);

Route::resource('/store',StoreController::class);
Route::get('/stores', [App\Http\Controllers\StoreController::class, 'indexAll'])->name('store.indexAll');

Route::resource('/product',ProductController::class);

Route::post('/useravatar', [App\Http\Controllers\UserController::class,'update_avatar']);
Route::post('/productdata', [App\Http\Controllers\ProductController::class,'getData'])->name('product.getData');
Route::post('/routes', [App\Http\Controllers\RouteController::class,'getData'])->name('route.getData');
Route::post('/walk/cancel', [App\Http\Controllers\WalkController::class,'cancel'])->name('walk.cancel');
Route::post('/walk/confirmCancel', [App\Http\Controllers\WalkController::class,'confirmCancel'])->name('walk.confirmCancel');
Route::post('/walk/accept', [App\Http\Controllers\WalkController::class,'walkerAccept'])->name('walk.walkerAccept');
Route::post('/walk/finish', [App\Http\Controllers\WalkController::class,'finish'])->name('walk.walkerFinish');
Route::post('/walk/start', [App\Http\Controllers\WalkController::class,'start'])->name('walk.start');
Route::post('/walk/submit/finish', [App\Http\Controllers\WalkController::class,'submitWalkerFinish'])->name('walk.submitWalkerFinish');
Route::post('/walk/reject', [App\Http\Controllers\WalkController::class,'walkerReject'])->name('walk.walkerReject');
Route::post('/walk/submit/reject', [App\Http\Controllers\WalkController::class,'submitWalkerReject'])->name('walk.submitWalkerReject');
//Ruta para crear paseos
Route::post('/walk/request', [App\Http\Controllers\WalkController::class,'requestNew'])->name('walk.requestNew');
Route::post('/product', [App\Http\Controllers\ProductController::class,'store'])->name('product.store');
Route::get('/store/public/{store}', [App\Http\Controllers\StoreController::class,'showPublic'])->name('store.showPublic');

Route::resource('/favoriteStore',FavoriteStoreController::class);

Route::resource('/favoriteWalker',FavoriteWalkerController::class);





