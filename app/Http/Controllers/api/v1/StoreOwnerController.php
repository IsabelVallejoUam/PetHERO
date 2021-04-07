<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\StoreOwner;
use Illuminate\Http\Request;
use App\Http\Requests\StoreOwnerRequest;


class StoreOwnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $owners=StoreOwner::searchUsers();
        return response()->json(['data' => $owners], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOwnerRequest $request)
    {
        $owner = StoreOwner::create($request->all()); 
        return response()->json(['data' => $owner], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StoreOwner  $storeOwner
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    
        $storeOwner= StoreOwner::searchUser($id);
        return response()->json(['data' => $storeOwner], 200); //BUG!! storeOwner sale null
       
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StoreOwner  $storeOwner
     * @return \Illuminate\Http\Response
     */
    public function update(StoreOwnerRequest $request, $id)
    {
        $StoreOwner = StoreOwner::find($id);

        $StoreOwner->update($request->all());

        $StoreOwner= StoreOwner::searchUser($id);
       
        return response()->json(['data' => $StoreOwner], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StoreOwner  $storeOwner
     * @return \Illuminate\Http\Response
     */
    public function destroy(StoreOwner $storeOwner)
    {
        $dataDeleted=$storeOwner;
        $storeOwner->delete();
        return response()->json(['data' => $dataDeleted], 200);
    }
}
