<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\Walker;
use Illuminate\Http\Request;

class WalkerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $walker = Walker::searchUsers();
        return response()->json(['data' => $walker], 201);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $walker = Walker::create($request->all());
        return response()->json(['data' => $walker], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Walker  $walker
     * @return \Illuminate\Http\Response
     */
    public function show(Walker $walker)
    {
        $walker= Walker::searchUser($walker);
        return response()->json(['data' => $walker], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Walker  $walker
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Walker $walker)
    {
        $walker->update($request->all());
        $walker= Walker::searchUser($walker);
        return response()->json(['data' => $walker], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Walker  $walker
     * @return \Illuminate\Http\Response
     */
    public function destroy(Walker $walker)
    {
        $walker->delete();
        return response(null, 204);
    }
}
