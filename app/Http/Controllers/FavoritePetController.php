<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FavoritePet;
use App\Models\Pet;

use Illuminate\Support\Facades\Auth;

class FavoritePetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pets = FavoritePet::searchPet(Auth::user());
        
        return view('favoritePet.index', compact('pets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pet $pet)
    {
        $existingFavorite = FavoritePet::where('pet_id', '=', $pet->id)->where('walker_id', '=', Auth::id())->exists();
        $favoritePet = FavoritePet::where('pet_id', '=', $pet->id)->where('walker_id', '=', Auth::id())->get();
        $pet = Pet::where('id',$pet->id)->get();
        error_log('ayudaaaa');
            //COMPROBAR QUE EXISTE YA EL FAVORITO
            if ($existingFavorite) {             
                $favoritePet->delete();
                return redirect(route('pet.show', compact('pet')))->with('_success', '¡Mascota eliminado exitosamente de Favoritos!');
            } else {
                return redirect(route('pet.show', compact('pet')))->with('_failure', 'Esta mascota No estaba en favoritos!');
        }
    }
}
