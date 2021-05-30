<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use Illuminate\Http\Request;
use App\Http\Requests\PetRequest;
use App\Models\PetOwner;
use Illuminate\Support\Facades\Auth;
use Image;

class PetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pets = Pet::where('owner_id','=',Auth::id())->get();

        return view('pet.index', compact('pets'));
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
        $pet->age = $request->input('age');
        $pet->race = $request->input('race');
        $pet->personality = $request->input('personality');
        $pet->commentary = $request->input('commentary');
        $pet->size = $request->input('size');
        $pet->species = $request->input('species');
        if ($request->hasFile('photo')){
            $photo = $request->file('photo');
            $filename = time() . '.' . $photo->getClientOriginalExtension();
            Image::make($photo)->resize(300,300)->save(public_path('uploads/pets/'.$filename));
            $pet->photo=$filename;
        }
        $foregin_id = PetOwner::where('user_id','=',Auth::id())->value('user_id');
        
        $pet->owner_id = $foregin_id;
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
        $pet->age = $request->input('age');
        $pet->race = $request->input('race');
        $pet->personality = $request->input('personality');
        $pet->commentary = $request->input('commentary');
        $pet->size = $request->input('size');
        $pet->species = $request->input('species');
        if ($request->hasFile('photo')){
            $photo = $request->file('photo');
            $filename = time() . '.' . $photo->getClientOriginalExtension();
            Image::make($photo)->resize(300,300)->save(public_path('uploads/pets/'.$filename));
            $pet->photo=$filename;
        }
        $pet->save();
        return redirect(route('pet.index'))->with('_success', '¡Mascota editada exitosamente!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pet $pet)
    {
        if($pet->owner_id == Auth::id())
        {
            $pet->delete();

            return redirect(route('pet.index'))->with('_success', '¡Mascota eliminada exitosamente!');
        }
        
        return back()->with('_failure', '¡No tiene permiso de borrar este recurso!');
    }
    
}
