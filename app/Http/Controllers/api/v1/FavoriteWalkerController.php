<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FavoriteWalker;

use App\Http\Resources\favoriteWalkers\FavoriteWalkersCollection;
use App\Http\Resources\favoriteWalkers\FavoriteWalkersResource;


class FavoriteWalkerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $favoriteWalkers = FavoriteWalker::orderBy('id', 'asc')->get();
        return (new FavoriteWalkersCollection($favoriteWalkers))
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
        $favoriteWalker = FavoriteWalker::create($request->all());
        return (new FavoriteWalkersResource($favoriteWalker))
        ->response()
        ->setStatusCode(200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pet  $Pet
     * @return \Illuminate\Http\Response
     */
    public function show(FavoriteWalker $favoriteWalker)
    {
        return (new FavoriteWalkersResource($favoriteWalker))
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
    public function update(Request $request, FavoriteWalker $favoriteWalker)
    {
        $favoriteWalker->update($request->all());
        return (new FavoriteWalkersResource($favoriteWalker))
        ->response()
        ->setStatusCode(200);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pet  $Pet
     * @return \Illuminate\Http\Response
     */
    public function destroy(FavoriteWalker $pet)
    {
        $dataDeleted=$pet;
        $pet->delete();
        return response()->json(['data' => $dataDeleted], 200);
    }

}

