<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\FavoriteStore;
use App\models\User;
use App\models\store;


use App\Http\Resources\favoriteStores\FavoriteStoresResource;
use App\Http\Resources\favoriteStores\FavoriteStoresCollection;


class FavoriteStoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $favoriteStores = FavoriteStore::orderBy('id', 'asc')->get();
        return (new FavoriteStoresCollection($favoriteStores))
        ->response()
        ->setStatusCode(200);
    }

      public function indexUser(User $user)
    {
    
        $favoriteStores = FavoriteStore::where('user_id', $user->id)->get();
        return (new FavoriteStoresCollection($favoriteStores))
        ->response()
        ->setStatusCode(200);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $favoriteStore = FavoriteStore::create($request->all());
        return (new FavoriteStoresResource($favoriteStore))
        ->response()
        ->setStatusCode(200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pet  $Pet
     * @return \Illuminate\Http\Response
     */
    public function show(FavoriteStore $favoriteStore)
    {
        return (new FavoriteStoresResource($favoriteStore))
        ->response()
        ->setStatusCode(200);
    }

    public function showUser(User $user, Store $store)
    {
        $favoriteStore = FavoriteStore::where('user_id', $user->id)->where('store_id', $store->id)->first();
        return (new FavoriteStoresResource($favoriteStore))
        ->response()
        ->setStatusCode(200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pet  $Pet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FavoriteStore $favoriteStore)
    {
        $favoriteStore->update($request->all());
        return (new FavoriteStoresResource($favoriteStore))
        ->response()
        ->setStatusCode(200);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pet  $Pet
     * @return \Illuminate\Http\Response
     */
    public function destroy(FavoriteStore $favoriteStore)
    {
        $dataDeleted=$favoriteStore;
        $favoriteStore->delete();
        return response()->json(['data' => $dataDeleted], 200);
    }

}
