<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FavoritePet;


use App\Http\Resources\favoritePets\FavoritePetsCollection;
use App\Http\Resources\favoritePets\FavoritePetsResource;


class FavoritePetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $favoritePets = FavoritePet::orderBy('walker_id', 'asc')->get();
        return (new FavoritePetsCollection($favoritePets))
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
        $favoritePet = FavoritePet::create($request->all());
        return (new FavoritePetsResource($favoritePet))
        ->response()
        ->setStatusCode(200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pet  $Pet
     * @return \Illuminate\Http\Response
     */
    public function show(FavoritePet $favoritePet)
    {
        return (new FavoritePetsResource($favoritePet))
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
    public function update(Request $request, FavoritePet $favoritePet)
    {
        $favoritePet->update($request->all());
        return (new FavoritePetsResource($favoritePet))
        ->response()
        ->setStatusCode(200);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pet  $Pet
     * @return \Illuminate\Http\Response
     */
    public function destroy(FavoritePet $favoritePet)
    {
        $dataDeleted=$favoritePet;
        $favoritePet->delete();
        return response()->json(['data' => $dataDeleted], 200);
    }

}