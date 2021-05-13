<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\PetOwner;
use Illuminate\Http\Request;
use App\Http\Requests\PetOwnerRequest;


use App\Http\Resources\petOwners\PetOwnersCollection;
use App\Http\Resources\petOwners\PetOwnersResource;


class PetOwnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $walkers = PetOwner::orderBy('id', 'asc')->get();
        return (new PetOwnersCollection($walkers))
        ->response()
        ->setStatusCode(200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PetOwnerRequest $request)
    {
        $petOwner = PetOwner::create($request->all());
        return (new PetOwnersResource($petOwner))
        ->response()
        ->setStatusCode(200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PetOwner  $PetOwner
     * @return \Illuminate\Http\Response
     */
    public function show(PetOwner $petOwner)
    {
        return (new PetOwnersResource($petOwner))
        ->response()
        ->setStatusCode(200);
 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PetOwner  $PetOwner
     * @return \Illuminate\Http\Response
     */
    public function update(PetOwnerRequest $request, PetOwner $petOwner)
    {
        $petOwner->update($request->all());
        return (new PetOwnersResource($petOwner))
        ->response()
        ->setStatusCode(200);
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PetOwner  $PetOwner
     * @return \Illuminate\Http\Response
     */
    public function destroy(PetOwner $petOwner)
    {
        $dataDeleted=$petOwner;
        $petOwner->delete();
        return response()->json(['data' => $dataDeleted], 200);
    }
}