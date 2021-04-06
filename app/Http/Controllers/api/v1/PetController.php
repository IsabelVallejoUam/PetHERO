<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\Pet;
use Illuminate\Http\Request;

class PetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pets=Pet::orderBy('name','asc')->get();
        return response()->json(['data' => $pets], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pet = Pet::create($request->all()); 
        return response()->json(['data' => $pet], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pet  $Pet
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pet= Pet::findOrFail($id);
        if($pet != null){
            return response()->json(['data' => $pet], 200);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pet  $Pet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $pet = Pet::find($id);

        $pet->update($request->all());
    
        return response()->json(['data' => $pet], 200);
    }
  /**public function update(Request $request, Pet $pet)
    {
        $pet->update($request->all());
        $pet= Pet::searchUser($pet);
        return response()->json(['data' => $pet], 200);
    }*/

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pet  $Pet
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pet = Pet::find($id);

        $pet->delete();
        return response(null, 204);
    }
 /**public function destroy(Pet $pet)
    {
        $pet->delete(); //No sirve
        return response(null, 204);
    }
    */
}