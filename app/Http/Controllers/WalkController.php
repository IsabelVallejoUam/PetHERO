<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\WalkRequest;
use App\Models\Walker;
use App\Models\Walk;
use App\Models\User;
use App\Models\Route;
use App\Models\Pet;
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
        $walks = Walk::ownedBy(Auth::id())->simplePaginate(5);
        return view('walks.index', compact('walks'));
    }

    public function walkerIndex()
    {
        $walks = Walk::where('walker',Auth::id())->simplePaginate(5);
        return view('walks.index', compact('walks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
    }


    public function requestNew(Request $request)
    {
        $walker=Walker::find($request)->first();
        $user = User::find($walker->user_id)->first();
        $routes = Route::ownedBy($walker->user_id)->where('privacy','public')->get();
        $walker_id=$walker->id;
        $pets = Pet::ownedBy(Auth::id())->get();
        return view('walks.create', compact('walker','user','routes','pets'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $walk = new Walk();
        $walk->pet_id = $request->input('pet_id');
        $walk->requested_day = $request->input('requested_day');
        $walk->requested_hour = $request->input('requested_hour');
        $walk->route = $request->input('route_id');
        $walk->minutes_walked = 0;
        $walk->min_time = $request->input('min_time');
        $walk->max_time = $request->input('max_time');
        $walk->commentary = $request->input('commentary');
        $walk->walker = $request->input('walker_id');
        $walk->status = 'pending';
        $walk->user_id = Auth::id();
        $walk->save();
        return redirect(route('walk.index'))->with('_success', 'Petición de paseo añadida exitosamente!');
    }

    public function cancel(Request $request)
    {

        $walk = Walk::find($request)->first();
        $walk->status = 'canceled';
        $walk->cancel_confirmation = 'no';
        $walk->save();
    
        return redirect(route('walk.index'))->with('_success', 'Paseo cancelado exitosamente!');
    }

    public function confirmCancel(Request $request)
    {
        $walk = Walk::find($request->input('walk_id'))->first();
        $walk->cancel_confirmation = 'yes';
        $walk->save();
        if($request->input('type') == 'walker'){
            return redirect(route('walk.walkerIndex'))->with('_success', 'Se ha confirmado la cancelación del paseo!');   
        } else {
            return redirect(route('walk.index'))->with('_success', 'Se ha confirmado la cancelación del paseo!');   
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Walk $walk)
    {
        $pet = Pet::find($walk->pet_id);
        $route = Route::find($walk->route)->first();
        $walker = Walker::where('user_id',$walk->walker)->first();
        return view('walks.show', compact(['walk','pet','route','walker']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Walk $walk)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(WalkRequest $request, Walk $walk)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Walk $walk)
    {
        if($walk->owner->id == Auth::id())
        {
            $walk->delete();
            return back()->with('_success', 'Paseo eliminado exitosamente!');
        }
        return back()->with('_failure', '¡No tiene permiso de borrar ese paseo!');
    }
}
