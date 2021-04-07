<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PetOwner;
use App\Http\Requests\PetOwnerRequest;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class WalkerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $petOwner = PetOwner::ownedBy(auth()->user());

        return view('petOwner.index', compact('petOwner'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('petOwner.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PetOwnerRequest $request, UserRequest $request2)
    {
      
        $existingUser = User::where('document', '=', $request2->input('document'))->exists();
        $user = new User();

        if ($existingUser == false){    
        $user->name =  $request2->input('name');
        $user->lastname =  $request2->input('lastname');
        $user->email =  $request2->input('email');
        $user->password =  Hash::make($request2->input('password'));
        $user->document =  $request2->input('document');
        $user->phone =  $request2->input('phone');
        $user->save();
        } 

        $petOwner = new PetOwner();
        $petOwner->address = $request->input('address');
        $foregin_id= User::select('id')->where('document', '=', $request->input('document'))->value('id');
        $petOwner->user_id = $foregin_id;
        $petOwner->save();


        return redirect(route('petOwner.show'))->with('_success', '¡Perfil creado exitosamente!');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(PetOwner $petOwner, User $user)
    {
        return view('petOwner.show', compact('petOwner','user'));
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(PetOwner $walker, User $user)
    {
        return view('petOwner.edit', compact('petOwner','user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PetOwnerRequest $request,  UserRequest $request2, PetOwner $petOwner, User $user)
    {

        $petOwner->address = $request->input('address');
        $petOwner->save();

        $user->name =  $request2->input('name');
        $user->lastname =  $request2->input('lastname');
        $user->email =  $request2->input('email');
        $user->password =  $request2->input('password');
        $user->document =  $request2->input('document');
        $user->phone =  $request2->input('phone');
        $user->save();

        return redirect(route('petOwner.show'))->with('_success', 'Perfil editado exitosamente!') ;

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(PetOwner $petOwner)
    {
        if($petOwner->owner->document == Auth::document())
        {
            $petOwner->delete();

            return back()->with('_success', 'Perfil de paseador eliminado exitosamente!');
        }
        
        return back()->with('_failure', '¡No tiene permiso de borrar ese perfil!');
    }
}
