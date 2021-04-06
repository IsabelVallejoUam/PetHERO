<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\Walker;
use Illuminate\Http\Request;
use App\Http\Requests\WalkerRequest;


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
    public function store(WalkerRequest $request)
    {
        $walker = Walker::create($request->all());
        //$walker = Walker::searchUsers();
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
    public function update(WalkerRequest $request, Walker $walker)
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
        $dataDeleted=$walker;
        $walker->delete();
        return response()->json(['data' => $walker], 200);
    }
}
