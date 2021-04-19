<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\StoreOwner;
use App\Http\Requests\StoreOwnerRequest;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class StoreOwnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $storeOwner = StoreOwner::ownedBy(auth()->user());

        return view('storeOwner.index', compact('storeOwner'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('storeOwner.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOwnerRequest $request, UserRequest $request2)
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

        $petOwner = new StoreOwner();
        $foregin_id= User::select('id')->where('document', '=', $request->input('document'))->value('id');
        $petOwner->user_id = $foregin_id;
        $petOwner->save();


        return redirect(route('storeOwner.show'))->with('_success', '¡Perfil creado exitosamente!');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(StoreOwner $storeOwner, User $user)
    {
        return view('storeOwner.show', compact('storeOwner','user'));
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(StoreOwner $walker, User $user)
    {
        return view('storeOwner.edit', compact('storeOwner','user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreOwnerRequest $request,  UserRequest $request2, StoreOwner $petOwner, User $user)
    {

        $user->name =  $request2->input('name');
        $user->lastname =  $request2->input('lastname');
        $user->email =  $request2->input('email');
        $user->password =  $request2->input('password');
        $user->document =  $request2->input('document');
        $user->phone =  $request2->input('phone');
        $user->save();

        return redirect(route('storeOwner.show'))->with('_success', 'Perfil editado exitosamente!') ;

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(StoreOwner $petOwner)
    {
        if($petOwner->owner->document == Auth::document())
        {
            $petOwner->delete();

            return back()->with('_success', 'Perfil de paseador eliminado exitosamente!');
        }
        
        return back()->with('_failure', '¡No tiene permiso de borrar ese perfil!');
    }

    public function login()
    {
        return view('storeOwner.login');
    }

}