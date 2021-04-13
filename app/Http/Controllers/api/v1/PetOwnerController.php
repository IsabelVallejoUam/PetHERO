<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\PetOwner;
use Illuminate\Http\Request;
use App\Http\Requests\PetOwnerRequest;

class PetOwnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $owners = PetOwner::searchUsers();
        return response()->json(['data' => $owners], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PetOwnerRequest $request)
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
        $petOwner = PetOwner::searchUser($id);
  
            return response()->json(['data' => $petOwner], 200);
        
 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PetOwner  $PetOwner
     * @return \Illuminate\Http\Response
     */
    public function update(PetOwnerRequest $request, $id)
    {
        $petOwner = PetOwner::find($id);

        $petOwner->update($request->all());
        $user_id = $petOwner->user_id;
        $petOwner= PetOwner::searchUser($user_id);
       
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
        $deletedData = $petOwner;
        $petOwner->delete();
        return response()->json(['data' => $deletedData], 200);
    }
}