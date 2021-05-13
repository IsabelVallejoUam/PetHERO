<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\Walker;
use Illuminate\Http\Request;
use App\Http\Requests\WalkerRequest;

use App\Http\Resources\walkers\WalkersCollection;
use App\Http\Resources\walkers\WalkersResource;


class WalkerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $walkers = Walker::orderBy('id', 'asc')->get();
        return (new WalkersCollection($walkers))
        ->response()
        ->setStatusCode(200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(WalkerRequest $request)
    {
        $walker = Walker::create($request->all());
        return (new WalkersResource($walker))
        ->response()
        ->setStatusCode(200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Walker  $walker
     * @return \Illuminate\Http\Response
     */
    public function show(Walker $walker)
    {
        
        return (new WalkersResource($walker))
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
    public function update(WalkerRequest $request, Walker $walker)
    {
        $walker->update($request->all());
        return (new WalkersResource($walker))
        ->response()
        ->setStatusCode(200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Walker  $walker
     * @return \Illuminate\Http\Response
     */
    public function destroy(Walker $walker)
    {
        $dataDeleted=$walker;
        $walker->delete();
        return response()->json(['data' => $dataDeleted], 200);
    }
}
