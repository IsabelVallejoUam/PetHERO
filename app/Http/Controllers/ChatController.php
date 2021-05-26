<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Walk;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $chat = new Chat();
        $chat->walk = $request->input('walk_id');
        $chat->owner_id = $request->input('owner_id');
        $chat->content = $request->input('content');
        $chat->save();
        $walk = Walk::where('id',$request->input('walk_id'))->first();        
        return redirect(route('walk.show',$walk->id))->with('_success', 'Comentario añadido exitosamente!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CHat  $cHat
     * @return \Illuminate\Http\Response
     */
    public function show(CHat $cHat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CHat  $cHat
     * @return \Illuminate\Http\Response
     */
    public function edit(CHat $cHat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CHat  $cHat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CHat $cHat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CHat  $cHat
     * @return \Illuminate\Http\Response
     */
    public function destroy(CHat $cHat)
    {
        //
    }
}
