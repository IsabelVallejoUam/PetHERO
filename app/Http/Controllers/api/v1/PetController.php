<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\Pet;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\PetRequest;

use App\Http\Resources\pets\PetsCollection;
use App\Http\Resources\pets\PetsResource;


class PetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pets = Pet::orderBy('id', 'asc')->get();
        return (new PetsCollection($pets))
        ->response()
        ->setStatusCode(200);
    }

    public function indexUser(User $user)
    {
    
        $ownerPets = Pet::where('owner_id', $user->id)->get();
        return (new PetsCollection($ownerPets))
        ->response()
        ->setStatusCode(200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PetRequest $request)
    {
        $pet = Pet::create($request->all());
        return (new PetsResource($pet))
        ->response()
        ->setStatusCode(200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pet  $Pet
     * @return \Illuminate\Http\Response
     */
    public function show(Pet $pet)
    {
        return (new PetsResource($pet))
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
    public function update(PetRequest $request, Pet $pet)
    {
        $pet->update($request->all());
        return (new PetsResource($pet))
        ->response()
        ->setStatusCode(200);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pet  $Pet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pet $pet)
    {
        $dataDeleted=$pet;
        $pet->delete();
        return response()->json(['data' => $dataDeleted], 200);
    }

}