<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Route;
use App\Models\Walker;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\RouteRequest;
class RouteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('walker.route.create');
    }

    public function getData(Request $request)
    {
        
        $walker=Walker::find($request)->first();
        $user = User::find($walker->user_id)->first();
        $routes = Route::ownedBy($walker->user_id)->where('privacy','public')->get();
        $walker_id=$walker->id;
        return view('walker.route.showRoutes', compact('walker','user','routes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RouteRequest $request)
    {
        $route = new Route();
        $route->owner_id = Auth::id();
        $route->title = $request->input('title');
        $route->description = $request->input('description');
        $route->schedule = $request->input('schedule');
        $route->duration = $request->input('duration');
        $route->privacy = $request->input('privacy');
        $route->price = $request->input('price');
        $route->save();
        return redirect(route('walker.show',Auth::id()))->with('_success', 'Ruta creada exitosamente!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Route  $route
     * @return \Illuminate\Http\Response
     */
    public function show(Route $route)
    {
        return view('walker.route.show', compact('route'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Route  $route
     * @return \Illuminate\Http\Response
     */
    public function edit(Route $route)
    {
        return view('walker.route.edit', compact('route'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Route  $route
     * @return \Illuminate\Http\Response
     */
    public function update(RouteRequest $request, Route $route)
    {
        $route->title = $request->input('title');
        $route->description = $request->input('description');
        $route->schedule = $request->input('schedule');
        $route->duration = $request->input('duration');
        $route->privacy = $request->input('privacy');
        $route->price = $request->input('price');
        $route->save();
        return redirect(route('walker.show',Auth::id()))->with('_success', 'Ruta editada exitosamente!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Route  $route
     * @return \Illuminate\Http\Response
     */
    public function destroy(Route $route)
    {
        if(Auth::id() == $route->owner_id){
            $route ->delete();
            return redirect()->route('walker.show',Auth::id())->with('_success', '??Ruta eliminada exitosamente!');
        } else {
            return redirect()->route('walker.show',Auth::id())->with('_failure', '??No tienes permiso para esto!');
        }
    }
}
