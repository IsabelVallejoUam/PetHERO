<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use Illuminate\Http\Request;
use App\Http\Requests\PetRequest;
use App\Models\PetOwner;
use Illuminate\Support\Facades\Auth;

class PetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pet = Pet::ownedBy(auth()->user());

        return view('pet.index', compact('pet'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pet.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PetRequest $request)
    {
        $pet = new Pet();
        $pet->name = $request->input('name');
        $pet->sex = $request->input('sex');
        $pet->birthday = $request->input('birthday');
        $pet->race = $request->input('race');
        $pet->personality = $request->input('personality');
        $pet->commentary = $request->input('commentary');
        $pet->size = $request->input('size');
        $pet->type = $request->input('type');

        $foregin_id= PetOwner::select('id')->where('user_id', '=', Auth::id())->value('id');
        $pet->user_id = $foregin_id;
        $pet->save();

        return redirect(route('pet.index'))->with('_success', '¡Mascota agregada exitosamente!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Pet $pet)
    {
        return view('pet.show', compact('pet'));
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Pet $pet)
    {
        return view('pet.edit', compact('pet'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PetRequest $request, Pet $pet)
    {
        $pet->name = $request->input('name');
        $pet->sex = $request->input('sex');
        $pet->birthday = $request->input('birthday');
        $pet->race = $request->input('race');
        $pet->personality = $request->input('personality');
        $pet->commentary = $request->input('commentary');
        $pet->size = $request->input('size');
        $pet->type = $request->input('type');
        $pet->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pet $pet)
    {
        if($pet->owner->document == Auth::document())
        {
            $pet->delete();

            return back()->with('_success', 'Mascota eliminado exitosamente!');
        }
        
        return back()->with('_failure', '¡No tiene permiso de borrar esta mascota!');
    }
    
}
