<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\WalkRequest;
use App\Models\Walk;

use App\Http\Resources\walks\WalksCollection;
use App\Http\Resources\walks\WalksResource;

class WalkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $walks = Walk::orderBy('id', 'asc')->get();
        return (new WalksCollection($walks))
        ->response()
        ->setStatusCode(200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(WalkRequest $request)
    {
        $walk = Walk::create($request->all());
        return (new WalksResource($walk))
        ->response()
        ->setStatusCode(200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Walker  $walker
     * @return \Illuminate\Http\Response
     */
    public function show(Walk $walk)
    {
        return (new WalksResource($walk))
        ->response()
        ->setStatusCode(200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Walker  $walker
     * @return \Illuminate\Http\Response
     */
    public function update(WalkRequest $request, Walk $walk)
    {
        $walk->update($request->all());
        return (new WalksResource($walk))
        ->response()
        ->setStatusCode(200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Walker  $walker
     * @return \Illuminate\Http\Response
     */
    public function destroy(WalkRequest $walk)
    {
        $dataDeleted=$walk;
        $walk->delete();
        return response()->json(['data' => $dataDeleted], 200);
    }
}
