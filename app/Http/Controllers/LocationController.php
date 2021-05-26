<?php

namespace App\Http\Controllers;

use App\Http\Requests\LocationRequest;
use App\Models\Location;
use App\Models\StoreOwner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $locations = Location::where('owner_id','=',Auth::id())->get();

        return view('location.index', compact('locations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('location.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LocationRequest $request)
    {
        $location = new Location();
        $location->name = $request->input('name');
        $location->address = $request->input('address');
        $location->lat = $request->input('lat');
        $location->lng = $request->input('lng');
        $foregin_id = StoreOwner::where('user_id','=',Auth::id())->value('user_id');
        $location->owner_id = $foregin_id;
        $location->save();
        return redirect(route('location.index'))->with('_success', '¡Mascota agregada exitosamente!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function show(Location $location)
    {
        return view('location.show', compact('location'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function edit(Location $location)
    {
        return view('location.edit', compact('location'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function update(LocationRequest $request, Location $location)
    {
        $location = new Location();
        $location->name = $request->input('name');
        $location->address = $request->input('address');
        $location->lat = $request->input('lat');
        $location->lng = $request->input('lng');
        $foregin_id = StoreOwner::where('user_id','=',Auth::id())->value('user_id');
        $location->owner_id = $foregin_id;
        $location->save();
        return redirect(route('location.index'))->with('_success', '¡Ubicación editada exitosamente!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function destroy(Location $location)
    {
        if($location->owner_id == Auth::id())
        {
            $location->delete();

            return redirect(route('location.index'))->with('_success', '¡Ubicación eliminada exitosamente!');
        }
        
        return back()->with('_failure', '¡No tiene permiso de borrar este recurso!');
    }
}