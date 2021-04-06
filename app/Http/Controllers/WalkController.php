<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\Models\WalkRequest;
use app\http\Requests\WalkRequestRequest;
use Illuminate\Support\Facades\Auth;

class WalkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $walks = WalkRequest::ownedBy(Auth::id())->simplePaginate(5);

        return view('walks.index', compact('walks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('walks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(WalkRequestRequest $request)
    {
        
        $walk = new WalkRequest();
        $walk->user_id = Auth::id();
        $walk->requested_day = $request->input('requested_day');
        $walk->minutes_walked = $request->input('minutes_walked');
        $walk->route = $request->input('route');
        $walk->min_time = $request->input('min_time');
        $walk->max_time = $request->input('requestmax_timeed_day');
        $walk->commentary = $request->input('commentary');
        //$walk->walker = $request->input('walker'); id del paseador
        $walk->status = $request->input('status');
        $walk->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(WalkRequest $walk)
    {
        return view('walks.show', compact('link'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(WalkRequest $walk)
    {
        return view('walks.edit', compact('link'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(WalkRequestRequest $request, WalkRequest $walk)
    {
        $walk->requested_day = $request->input('requested_day');
        $walk->minutes_walked = $request->input('minutes_walked');
        $walk->route = $request->input('route');
        $walk->min_time = $request->input('min_time');
        $walk->max_time = $request->input('requestmax_timeed_day');
        $walk->commentary = $request->input('commentary');
        //$walk->walker = $request->input('walker'); id del paseador
        $walk->status = $request->input('status');
        $walk->save();

        return redirect(route('walks.index'))->with('_success', 'Paseo editado exitosamente!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(WalkRequest $walk)
    {
        if($walk->owner->id == Auth::id())
        {
            $walk->delete();
            return back()->with('_success', 'Paseo eliminado exitosamente!');
        }
        
        return back()->with('_failure', '¡No tiene permiso de borrar ese paseo!');
    }
}
