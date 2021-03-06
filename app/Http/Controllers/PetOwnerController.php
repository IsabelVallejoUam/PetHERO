<?php

namespace App\Http\Controllers;

//MODELS
use App\Models\User;
use App\Models\PetOwner;
use App\Models\Walker;
use App\Models\Store;
use App\Models\Pet;

use App\Models\FavoriteWalker;
use App\Models\FavoriteStore;
//REQUESTS
use Illuminate\Http\Request;
use App\Http\Requests\PetOwnerRequest;
use App\Http\Requests\UserRequest;
//BASIC
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Image;

class PetOwnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $petOwner = PetOwner::ownedBy(auth()->user());
        $pets = Pet::where('owner_id','=',Auth::id())->get();
        return view('petOwner.index', compact(['petOwner','pets']));
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

        if ($existingUser == false) {
            $user = new User();
        } else {
            $user = User::where('document', '=', $request2->input('document'));
        }

        $user->name =  $request2->input('name');
        $user->lastname =  $request2->input('lastname');
        $user->email =  $request2->input('email');
        $user->password =  Hash::make($request2->input('password'));
        $user->document =  $request2->input('document');

        if ($request->hasFile('avatar')){
            $photo = $request->file('avatar');
            $filename = time() . '.' . $photo->getClientOriginalExtension();
            Image::make($photo)->resize(300,300)->save(public_path('uploads/avatars/'.$filename));
            $user->avatar=$filename;
        } else{
            $user->avatar='default.png';
        }
        $user->phone =  $request2->input('phone');
        $user->save();

        $petOwner = new PetOwner();
        $petOwner->address = $request->input('address');
        $foregin_id = User::select('id')->where('document', '=', $request->input('document'))->value('id');
        $petOwner->user_id = $foregin_id;
        $petOwner->save();


        return view('layouts.created', compact('user'))->with('_success', '??Perfil creado exitosamente!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(PetOwner $petOwner, User $user)
    {
        $user = User::findOrFail($petOwner->user_id);
        $pets = Pet::where('owner_id','=',Auth::id())->get();
        return view('petOwner.show', compact(['petOwner', 'user','pets']));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function profile(PetOwner $petOwner)
    {

        $user = User::findOrFail($petOwner->user_id);
        $pets = Pet::where('owner_id','=',Auth::id())->get();
        return view('petOwner.perfil', compact(['petOwner', 'user','pets']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(PetOwner $petOwner)
    {
        $user = User::findOrFail($petOwner->user_id);

        return view('petOwner.edit', compact('petOwner', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PetOwnerRequest $request,  UserRequest $request2, PetOwner $petOwner)
    {

        $user = User::findOrFail($petOwner->user_id);
        $petOwner->address = $request->input('address');
        $petOwner->save();
        $user->name =  $request2->input('name');
        $user->lastname =  $request2->input('lastname');
        $user->email =  $request2->input('email');
        $user->document =  $request2->input('document');
        $user->phone =  $request2->input('phone');
        if ($request->hasFile('avatar')){
            $photo = $request->file('avatar');
            $filename = time() . '.' . $photo->getClientOriginalExtension();
            Image::make($photo)->resize(300,300)->save(public_path('uploads/avatars/'.$filename));
            $user->avatar=$filename;
        }
        // if( $request2->filled('newpassword') && $request2->filled('newpasswordconfirmation')){
        //     $newpassword =  $request2->input('newpassword');
        //     $newpasswordconf =  $request2->input('newpasswordconfirmation');
        //     if($newpassword == $newpasswordconf){
        //         $user->password =  Hash::make($request2->input('newpassword'));
        //         $user->save();
        //         return redirect(route('petOwner.show', [$user,$petOwner]))->with('_success', 'Perfil editado exitosamente!') ;
        //     } else {
        //         return back()->with('_failure', 'Las contrase??as no coinciden');
        //     }
        // } else if(!$request2->filled('newpassword') && !$request2->filled('newpasswordconfirmation')) {
        //     $user->save();
        //     return redirect(route('petOwner.show', [$user, $petOwner]))->with('_success', 'Perfil editado exitosamente!');
        // } else {
        //     return back()->with('_failure', 'Debes completar los dos campos de contrase??as');
        // }

        if( $request2->filled('newpassword') && $request2->filled('newpasswordconfirmation')){
            $user->password =  Hash::make($request2->input('newpassword'));
            $user->save();
            return redirect(route('petOwner.show', [$user,$petOwner]))->with('_success', 'Perfil editado exitosamente!') ;
        } else {
            $user->save();
            return redirect(route('petOwner.show', [$user,$petOwner]))->with('_success', 'Perfil editado exitosamente!') ;
        }

   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(PetOwner $petOwner)
    {
        if ($petOwner->owner->document == Auth::document()) {
            $petOwner->delete();

            return back()->with('_success', 'Perfil de paseador eliminado exitosamente!');
        }

        return back()->with('_failure', '??No tiene permiso de borrar ese perfil!');
    }

    //MANAGE FAVORITES

    /**
     * Add a specifica Walker to the user favorite walkers table.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function addFavoriteWalker(FavoriteWalker $favoriteWalker, Walker $walker)
    {

        $existingFavorite = FavoriteWalker::where('walker_id', '=', $walker->user_id)->where('pet_owner_id', '=', Auth::id())->exists();

        //COMPROBAR QUE ESTA LOGEADO
        if (Auth::check()) {
            //COMPROBAR QUE NO EXISTE YA EL FAVORITO
            if ($existingFavorite) {
                return back()->with('_failure', 'Perfil de paseador ya estaba en favoritos!');
            } else {
                $favoriteWalker = new FavoriteWalker();
                $favoriteWalker->pet_owner_id = Auth::id();
                $favoriteWalker->walker_id = $walker->user_id;

                $favoriteWalker->save();
                return back()->with('_success', 'Perfil de paseador agregado a favoritos!');
            }
        } else {
            return back()->with('_failure', 'Debes estar Loggeado para agregar a favoritos!');
        }
    }

    /**
     * Add a specifica store to the user favorite stores table.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function addFavoriteStore(FavoriteStore $favoriteStore, Store $store)
    {

        $existingFavorite = FavoriteStore::where('store_id', '=', $store->id)->where('user_id', '=', Auth::id())->exists();

        //COMPROBAR QUE ESTA LOGEADO
        if (Auth::check()) {
            //COMPROBAR QUE NO EXISTE YA EL FAVORITO
            if ($existingFavorite) {
                return back()->with('_failure', 'Esta tienda ya estaba en favoritos!');
            } else {
                $favoriteStore = new FavoriteStore();
                $favoriteStore->user_id = Auth::id();
                $favoriteStore->store_id = $store->id;

                $favoriteStore->save();
                return back()->with('_success', 'tienda agregada a favoritos!');
            }
        } else {
            return back()->with('_failure', 'Debes estar Loggeado para agregar a favoritos!');
        }
    }
}
