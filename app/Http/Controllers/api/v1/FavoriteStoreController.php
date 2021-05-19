<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\FavoriteStore;
use App\models\User;


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

      public function index2(User $user)
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
    public function show(FavoriteStore $favoriteStore, User $user)
    {
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
    public function update(Request $request, FavoriteStore $pet)
    {
        $pet->update($request->all());
        return (new FavoriteStoresResource($pet))
        ->response()
        ->setStatusCode(200);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pet  $Pet
     * @return \Illuminate\Http\Response
     */
    public function destroy(FavoriteStore $pet)
    {
        $dataDeleted=$pet;
        $pet->delete();
        return response()->json(['data' => $dataDeleted], 200);
    }

}
