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
     * Lista todos los paseos del usuario
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $walks = Walk::ownedBy(Auth::id())->whereNotNull('walker')->simplePaginate(5);
        $type = 'petOwner';
        $request = false;
        $status = "";
        return view('walks.index', compact('walks','type','request','status'));
    }
    //Lista los paseos pendientes del usuario
    public function indexPending()
    {
        $walks = Walk::ownedBy(Auth::id())->where('status','pending')->whereNotNull('walker')->simplePaginate(5);
        $type = 'petOwner';
        $request = false;
        $status = "Pendientes";
        return view('walks.index', compact('walks','type','request','status'));
    }
    //Lista los paseos activos del usuario
    public function indexActive()
    {
        $walks = Walk::ownedBy(Auth::id())->where('status','active')->whereNotNull('walker')->simplePaginate(5);
        $type = 'petOwner';
        $request = false;
        $status = "Activos";
        return view('walks.index', compact('walks','type','request','status'));
    }
    //Lista los paseos finalizados del usuario
    public function indexFinished()
    {
        $walks = Walk::ownedBy(Auth::id())->where('status','finished')->whereNotNull('walker')->simplePaginate(5);
        $type = 'petOwner';
        $request = false;
        $status = "Finalizados";
        return view('walks.index', compact('walks','type','request','status'));
    }
    //Lista todos los paseos del paseador
    public function walkerIndex()
    {
        $walks = Walk::where('walker',Auth::id())->whereNotNull('walker')->simplePaginate(5);
        $type = 'walker';
        $request = false;
        $status = "";
        return view('walks.index', compact('walks','type','request','status'));
    }
    //Lista todos los paseos finalizados del paseador
    public function walkerIndexFinished()
    {
        $walks = Walk::where('walker',Auth::id())->where('status','finished')->whereNotNull('walker')->simplePaginate(5);
        $type = 'walker';
        $request = false;
        $status = "FInalizados";
        return view('walks.index', compact('walks','type','request','status'));
    }
    //Lista todos los paseos pendientes del paseador
    public function walkerIndexPending()
    {
        $walks = Walk::where('walker',Auth::id())->where('status','pending')->whereNotNull('walker')->simplePaginate(5);
        $type = 'walker';
        $request = false;
        $status = "Pendientes";
        return view('walks.index', compact('walks','type','request','status'));
    }
    //Lista todos los paseos activos del paseador
    public function walkerIndexActive()
    {
        $walks = Walk::where('walker',Auth::id())->where('status','active')->whereNotNull('walker')->simplePaginate(5);
        $type = 'walker';
        $request = false;
        $status = "Activos";
        return view('walks.index', compact('walks','type','request','status'));
    }
    //Lista todas las solicitudes de paseo disponibles 
    public function indexRequests()
    {
        $walks = Walk::where('status','pending')->whereNull('walker')->simplePaginate(5);
        $type = 'walker';
        $request = true;
        $status = "Globales";
        return view('walks.index', compact('walks','type','request','status'));
    }
    //Lista todas las solicitudes de paseo de un dueño de mascota
    public function petIndexRequests()
    {
        $walks = Walk::where('status','pending')->whereNull('walker')->simplePaginate(5);
        $type = 'petOwner';
        $request = true;
        $status = "Sin aceptar";
        return view('walks.index', compact('walks','type','request','status'));
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
    //Sirve para crear una petición de paseo sin ruta 
    public function createRequest()
    {
        $pets = Pet::ownedBy(Auth::id())->where('species','dog')->get();
        return view('walks.createRequest', compact('pets'));
    }
    //Sirve para crear una petición de paseo a un paseador en una ruta definida
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
    //Formulario para que el paseador cancele un paseo
    public function walkerCancel(Request $request)
    {
        $walk = Walk::where('id',$request->input('walk_id'))->first();
        return view('walks.cancel.walkerCancel', compact('walk'));
    }
    //Sirve para guardar el formulario para que un paseador cancele un paseo
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
    //Guarda la asignación de una ruta a un paseo que no tenga una
    public function submitNewRoute(Request $request)
    {
        $walk = Walk::where('id',$request->input('walk_id'))->first();
        $walk->route = $request->input('route_id');
        $walk->save();
        return redirect(route('walk.walkerIndex'))->with('_success', 'Se ha confirmado la cancelación del paseo!');   
    }
    //Formulario para asignarle una ruta a un paseo que no tenga una
    public function addRoute(Request $request)
    {
        $walk = Walk::where('id',$request->input('walker_id'))->first();
        $routes = Route::where('owner_id',$walk->walker)->get();
        return view('walks.addRoute', compact('walk','routes'));
    }
    //Formulario para que el dueño de mascota cancele un paseo
    public function petOwnerCancel(Request $request)
    {
        $walk = Walk::where('id',$request->input('walk_id'))->first();
        return view('walks.cancel.petOwnerCancel', compact('walk'));
    }
    //Guarda el formulario para que el paseador cancele un paseo
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
    //Sirve para que un paseador inicie un paseo
    public function start(Request $request)
    {
        $walk = Walk::where('id',$request->input('walk_id'))->first();
        $walk->status = 'active';
        $walk->save();
        return redirect(route('walk.walkerIndex'))->with('_success', 'Paseo iniciado exitosamente!');
    }
    //Sirve para que un paseador finalice un paseo
    public function finish(Request $request)
    {
        $walk = Walk::where('id',$request->input('walk_id'))->first();
        return view('walks.walkerFinish', compact('walk'));
    }
    //Cambia el estado del paseo a finalizado cuando el paseador lo indique
    public function submitWalkerFinish(Request $request)
    {
        $walk = Walk::where('id',$request->input('walk_id'))->first();
        $walk->minutes_walked = $request->input('minutes');
        $walk->pet_calification = $request->input('petCalification');
        $walk->status = 'finished';
        $walk->save();
        return redirect(route('walk.walkerIndex'))->with('_success', 'Se ha finalizado el paseo!');   
    }
    //Sirve para modificar la confirmación cuando un paseo se cancela 
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
    //Cambia el estado de un paseo de un paseador cuando este lo acepte
    public function walkerAccept(Request $request)
    {
        $walk = Walk::where('id',$request->input('walk_id'))->first();
        $walk->status = 'accepted';
        $walk->save();
        return redirect(route('walk.walkerIndex'))->with('_success', 'Se ha confirmado el paseo!');   
    }
    //Formulario para cuando un paseador acepte una petición de paseo global
    public function walkerAcceptRequest(Request $request)
    {
        $walk = Walk::where('id',$request->input('walk_id'))->first();
        $routes = Route::where('owner_id',Auth::id())->get();
        return view('walks.walkerAcceptRequest', compact('walk','routes'));
    }
    //Modifica el estado de la petición para cuando un paseador acepte una y pase a ser su paseo
    public function submitWalkerAcceptRequest(Request $request)
    {
        $walk = Walk::where('id',$request->input('walk_id'))->first();
        $walk->walker = Auth::id();
        $walk->route = $request->input('route_id');
        $walk->status = 'accepted';
        $walk->save();
        return redirect(route('walk.walkerIndex'))->with('_success', 'Se ha aceptado el paseo!');   
    }
    //Formulario para cuando un paseador rechaza una solicitud de paseo
    public function walkerReject(Request $request)
    {
        $walk = Walk::where('id',$request->input('walk_id'))->first();
        return view('walks.walkerReject', compact('walk'));
    }
    //Guarda el formulario para cuando un paseador rechaza una solicitud de paseo
    public function submitWalkerReject(Request $request)
    {
        $walk = Walk::where('id',$request->input('walk_id'))->first();
        $walk->commentary = $request->input('reason');
        $walk->status = 'rejected';
        $walk->cancel_confirmation='no';
        $walk->save();
        return redirect(route('walk.walkerIndex'))->with('_success', 'Se ha rechazado el paseo!');   
    }
    //Formulario para cuando un usuario quiee calificar el paseo
    public function rate(Request $request)
    {
        $walk = Walk::where('id',$request->input('walk_id'))->first();
        return view('walks.rate', compact('walk'));
    }
    //Guarda el formulario para cuando un usuario quiee calificar el paseo
    public function submitRate(Request $request)
    {
        $walk = Walk::where('id',$request->input('walk_id'))->first();
        $walk->walker_calification = $request->input('calification');
        $walk->save();
        return redirect(route('walk.index'))->with('_success', 'Gracias por tu opinión!');   
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
        if($walk->owner->id == Auth::id() || $walk->walker == Auth::id())
        {
            $walk->delete();
            return back()->with('_success', 'Paseo eliminado exitosamente!');
        }
        return back()->with('_failure', '¡No tiene permiso de borrar ese paseo!');
    }
}
