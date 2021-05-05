<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\WalkRequest;
use App\Models\Walker;
use App\Models\Walk;
use App\Models\User;
use App\Models\Chat;
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
        $type = 'petOwner';
        return view('walks.index', compact('walks','type'));
    }
    public function indexPending()
    {
        $walks = Walk::ownedBy(Auth::id())->where('status','pending')->simplePaginate(5);
        $type = 'petOwner';
        return view('walks.index', compact('walks','type'));
    }
    public function indexActive()
    {
        $walks = Walk::ownedBy(Auth::id())->where('status','active')->simplePaginate(5);
        $type = 'petOwner';
        return view('walks.index', compact('walks','type'));
    }
    public function indexFinished()
    {
        $walks = Walk::ownedBy(Auth::id())->where('status','finished')->simplePaginate(5);
        $type = 'petOwner';
        return view('walks.index', compact('walks','type'));
    }

    public function walkerIndex()
    {
        $walks = Walk::where('walker',Auth::id())->simplePaginate(5);
        $type = 'walker';
        return view('walks.index', compact('walks','type'));
    }


    public function walkerIndexFinished()
    {
        $walks = Walk::where('walker',Auth::id())->where('status','finished')->simplePaginate(5);
        $type = 'walker';
        return view('walks.index', compact('walks','type'));
    }

    public function walkerIndexPending()
    {
        $walks = Walk::where('walker',Auth::id())->where('status','pending')->simplePaginate(5);
        $type = 'walker';
        return view('walks.index', compact('walks','type'));
    }

    public function walkerIndexActive()
    {
        $walks = Walk::where('walker',Auth::id())->where('status','active')->simplePaginate(5);
        $type = 'walker';
        return view('walks.index', compact('walks','type'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $walkers = Walker::get();
        $pets = Pet::ownedBy(Auth::id())->get();
        return view('walks.createNew', compact('walkers','pets'));
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

    public function walkerCancel(Request $request)
    {

        $walk = Walk::where('id',$request->input('walk_id'))->first();
        return view('walks.cancel.walkerCancel', compact('walk'));
    }

    public function submitWalkerCancel(Request $request)
    {
        $walk = Walk::where('id',$request->input('walk_id'))->first();
        $walk->status = 'canceled';
        $walk->commentary = $request->input('reason');
        $walk->cancel_confirmation = 'no';
        $walk->walker_confirmation = 'yes';
        $walk->save();
        return redirect(route('walk.walkerIndex'))->with('_success', 'Se ha confirmado la cancelación del paseo!');   
    }

    public function submitNewRoute(Request $request)
    {
        $walk = Walk::where('id',$request->input('walk_id'))->first();
        $walk->route = $request->input('route_id');
        $walk->save();
        return redirect(route('walk.walkerIndex'))->with('_success', 'Se ha confirmado la cancelación del paseo!');   
    }

    public function addRoute(Request $request)
    {
        $walk = Walk::where('id',$request->input('walker_id'))->first();
        $routes = Route::where('owner_id',$walk->walker)->get();
        return view('walks.addRoute', compact('walk','routes'));
    }

    public function petOwnerCancel(Request $request)
    {

        $walk = Walk::where('id',$request->input('walk_id'))->first();
        return view('walks.cancel.petOwnerCancel', compact('walk'));
    }

    public function submitPetOwnerCancel(Request $request)
    {
        $walk = Walk::where('id',$request->input('walk_id'))->first();
        $walk->status = 'canceled';
        $walk->commentary = $request->input('reason');
        $walk->cancel_confirmation = 'no';
        $walk->walker_confirmation = 'no';
        $walk->save();
        return redirect(route('walk.index'))->with('_success', 'Se ha confirmado la cancelación del paseo!');   
    }

    public function start(Request $request)
    {
        $walk = Walk::where('id',$request->input('walk_id'))->first();
        $walk->status = 'active';
        $walk->save();
        return redirect(route('walk.walkerIndex'))->with('_success', 'Paseo iniciado exitosamente!');
    }
    

    public function finish(Request $request)
    {
        $walk = Walk::where('id',$request->input('walk_id'))->first();
        return view('walks.walkerFinish', compact('walk'));
    }


    public function submitWalkerFinish(Request $request)
    {
        $walk = Walk::where('id',$request->input('walk_id'))->first();
        $walk->minutes_walked = $request->input('minutes');
        $walk->pet_calification = $request->input('petCalification');
        $walk->status = 'finished';
        $walk->save();
        return redirect(route('walk.walkerIndex'))->with('_success', 'Se ha finalizado el paseo!');   
    }

    public function confirmCancel(Request $request)
    {
        $walk = Walk::where('id',$request->input('walk_id'))->first();
        $walk->cancel_confirmation = 'yes';
        $walk->save();
        if($request->input('type') == 'walker'){
            return redirect(route('walk.walkerIndex'))->with('_success', 'Se ha confirmado la cancelación del paseo!');   
        } else {
            return redirect(route('walk.index'))->with('_success', 'Se ha confirmado la cancelación del paseo!');   
        }
    }

    public function walkerAccept(Request $request)
    {
        $walk = Walk::where('id',$request->input('walk_id'))->first();
        $walk->status = 'accepted';
        $walk->save();
        return redirect(route('walk.walkerIndex'))->with('_success', 'Se ha confirmado el paseo!');   
    }

    public function walkerReject(Request $request)
    {
        $walk = Walk::where('id',$request->input('walk_id'))->first();
        return view('walks.walkerReject', compact('walk'));
    }

    public function submitWalkerReject(Request $request)
    {
        $walk = Walk::where('id',$request->input('walk_id'))->first();
        $walk->commentary = $request->input('reason');
        $walk->status = 'rejected';
        $walk->save();
        return redirect(route('walk.walkerIndex'))->with('_success', 'Se ha rechazado el paseo!');   
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Walk $walk)
    {
        $chats = Chat::where('walk',$walk->id)->get();
        $pet = Pet::find($walk->pet_id);
        if($walk->route != null){
            $route = Route::find($walk->route)->first();
        } else {
            $route = null;
        }
        $walker = Walker::where('user_id',$walk->walker)->first();
        return view('walks.show', compact(['walk','pet','route','walker','chats']));
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
