<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\StoreOwner;
use Illuminate\Http\Request;
use app\Http\Requests\StoreOwnerRequest;


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
    public function show(StoreOwner $storeOwner)
    {
        $storeOwner= StoreOwner::searchUser($storeOwner);
        return response()->json(['data' => $storeOwner], 200); //BUG!! No sale nada :()
       
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StoreOwner  $storeOwner
     * @return \Illuminate\Http\Response
     */
    public function update(StoreOwnerRequest $request, StoreOwner $storeOwner)
    {
        $storeOwner->update($request->all()); //No sirve
        $storeOwner= StoreOwner::searchUser($storeOwner);
        return response()->json(['data' => $storeOwner], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StoreOwner  $storeOwner
     * @return \Illuminate\Http\Response
     */
    public function destroy(StoreOwner $storeOwner)
    {
        $storeOwner->delete(); //No sirve
        return response(null, 204);
    }
}
