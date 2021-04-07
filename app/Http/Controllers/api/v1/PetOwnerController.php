<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\PetOwner;
use Illuminate\Http\Request;

class PetOwnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $owners = PetOwner::orderBy('user_id', 'asc')->get();
        return response()->json(['data' => $owners], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $owner = PetOwner::create($request->all()); 
        return response()->json(['data' => $owner], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PetOwner  $PetOwner
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $petOwner = PetOwner::findOrFail($id);
        if($petOwner != null){
            return response()->json(['data' => $petOwner], 200);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PetOwner  $PetOwner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $petOwner = PetOwner::find($id);

        $petOwner->update($request->all());
    
        return response()->json(['data' => $petOwner], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PetOwner  $PetOwner
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $petOwner = PetOwner::find($id);

        $petOwner->delete();
        return response(null, 204);
    }
}