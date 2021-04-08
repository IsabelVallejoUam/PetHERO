<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\WalkRequest;
use App\Models\Walk;

class WalkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $walk = Walk::orderBy('user_id', 'asc')->get();
        return response()->json(['data' => $walk], 201);
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
        return response()->json(['data' => $walk], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Walker  $walker
     * @return \Illuminate\Http\Response
     */
    public function show(Walk $walk)
    {
        $walk= Walk::searchUser($walk);
        return response()->json(['data' => $walk], 200);
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
        $walk= Walk::searchUser($walk);
        return response()->json(['data' => $walk], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Walker  $walker
     * @return \Illuminate\Http\Response
     */
    public function destroy(WalkRequest $walk)
    {
        $walk->delete();
        return response(null, 204);
    }
}
