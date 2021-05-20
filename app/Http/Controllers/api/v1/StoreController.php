<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\Store;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRequest;

use App\Http\Resources\stores\StoresCollection;
use App\Http\Resources\stores\StoresResource;


class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stores = Store::orderBy('id', 'asc')->get();
        return (new StoresCollection($stores))
        ->response()
        ->setStatusCode(200);
    }
    
    public function indexUser(User $user)
    {
    
        $ownerStore = Store::where('owner_id', $user->id)->get();
        return (new StoresCollection($ownerStore))
        ->response()
        ->setStatusCode(200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $store = Store::create($request->all());
        return (new StoresResource($store))
        ->response()
        ->setStatusCode(200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function show(Store $store)
    {
        return (new StoresResource($store))
        ->response()
        ->setStatusCode(200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function update(StoreRequest $request, Store $store)
    {
        $store->update($request->all());
        return (new StoresResource($store))
        ->response()
        ->setStatusCode(200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function destroy(Store $store)
    {
        $dataDeleted=$store;
        $store->delete();
        return response()->json(['data' => $dataDeleted], 200);
    }
}
