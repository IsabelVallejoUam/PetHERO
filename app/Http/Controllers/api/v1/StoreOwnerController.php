<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\StoreOwner;
use Illuminate\Http\Request;
use App\Http\Requests\StoreOwnerRequest;

use App\Http\Resources\storeOwners\StoreOwnersCollection;
use App\Http\Resources\storeOwners\StoreOwnersResource;


class StoreOwnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $storeOwners = StoreOwner::orderBy('user_id', 'asc')->get();
        return (new StoreOwnersCollection($storeOwners))
        ->response()
        ->setStatusCode(200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOwnerRequest $request)
    {
        $storeOwner = StoreOwner::create($request->all());
        return (new StoreOwnersResource($storeOwner))
        ->response()
        ->setStatusCode(200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StoreOwner  $storeOwner
     * @return \Illuminate\Http\Response
     */
    public function show(StoreOwner $storeOwner)
    { 
        return (new StoreOwnersResource($storeOwner))
        ->response()
        ->setStatusCode(200); 
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
        $storeOwner->update($request->all());
        return (new StoreOwnersResource($storeOwner))
        ->response()
        ->setStatusCode(200);
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
