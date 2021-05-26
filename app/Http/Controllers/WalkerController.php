<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\Walker;
use App\Models\Pet;
use App\Models\Route;
use App\Models\FavoritePet;
use App\Models\Review;

use Illuminate\Http\Request;
use App\Http\Requests\WalkerRequest;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Image;
class WalkerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $walkers = Walker::searchUsers($request);
        return view('walker.index', compact('walkers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('walker.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(WalkerRequest $request, UserRequest $request2)
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
            if ($request->hasFile('avatar')){
                $photo = $request->file('avatar');
                $filename = time() . '.' . $photo->getClientOriginalExtension();
                Image::make($photo)->resize(300,300)->save(public_path('uploads/avatars/'.$filename));
                $user->avatar=$filename;
            } else{
                $user->avatar='default.png';
            }
            $user->save();
        }

        $walker = new Walker();
        $walker->experience = $request->input('experience');
        $walker->slogan = $request->input('slogan');
        $foregin_id= User::select('id')->where('document', '=', $request->input('document'))->value('id');
        $walker->user_id = $foregin_id;
        $walker->save();

        return view('layouts.created', compact('user'))->with('_success', '¡Perfil creado exitosamente!');    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Walker $walker)
    {        
        
        $user = User::findOrFail($walker->user_id);
        $routes = Route::ownedBy($walker->user_id)->get();
        $rate = Review::where('type','walk')->where('walker_id',$walker->id)->count();
        dd($rate);
        return view('walker.show', compact('walker','user','routes'));
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function profile(Walker $walker)
    {        
        
        $user = User::findOrFail($walker->user_id);
        $routes = Route::ownedBy($walker->user_id)->where('privacy','public')->get();
        $rate = Review::where('type','walk')->where('walker_id',$walker->user_id)->avg('rate');
        return view('walker.perfil', compact('walker','user','routes','rate'));
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Walker $walker)
    {
        $user = User::findOrFail($walker->user_id);
        return view('walker.edit', compact('walker','user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(WalkerRequest $request,  UserRequest $request2, Walker $walker, User $user)
    {
        $user = User::findOrFail($walker->user_id);
        $walker->experience = $request->input('experience');
        $walker->slogan = $request->input('slogan');
        $walker->save();
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
        if( $request2->filled('newpassword') && $request2->filled('newpasswordconfirmation')){
            $user->password =  Hash::make($request2->input('newpassword'));
            $user->save();
            return redirect(route('walker.show', [$user,$walker]))->with('_success', 'Perfil editado exitosamente!') ;
        } else {
            $user->save();
            return redirect(route('walker.show', [$user,$walker]))->with('_success', 'Perfil editado exitosamente!') ;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Walker $walker)
    {
        if($walker->owner->document == Auth::document())
        {
            $walker->delete();

            return back()->with('_success', 'Perfil de paseador eliminado exitosamente!');
        }
        
        return back()->with('_failure', '¡No tiene permiso de borrar ese perfil!');
    }

    public function login()
    {

        return view('walker.login');
    }

    //MANAGE FAVORITES

    /**
     * Add a specifica pet to the user favorite pets table.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function addFavoritePet(FavoritePet $favoritePet, Pet $pet){

        $existingFavorite = FavoritePet::where('pet_id', '=', $pet->id)->where('walker_id', '=', Auth::id())->exists();

        //COMPROBAR QUE ESTA LOGEADO
        if (Auth::check()) {
            //COMPROBAR QUE NO EXISTE YA EL FAVORITO
            if ($existingFavorite) {
                return back()->with('_failure', 'Esta mascota ya estaba en favoritos!');
            } else {
                $favoritePet = new FavoritePet();
                $favoritePet->walker_id = Auth::id();
                $favoritePet->pet_id = $pet->id;

                $favoritePet->save();
                return back()->with('_success', 'mascota agregada a favoritos!');
            }
        } else {
            return back()->with('_failure', 'Debes estar Loggeado para agregar a favoritos!');
        }
    }

    //    /**
    //  * Delets a specific pet from the walker favorite
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function deleteFavoritePet(FavoritePet $favoritePet, Pet $pet){

    //     $existingFavorite = FavoritePet::where('pet_id', '=', $pet->id)->where('walker_id', '=', Auth::id())->exists();

    //         //COMPROBAR QUE EXISTE YA EL FAVORITO
    //         if ($existingFavorite) {             
    //             $existingFavorite->forceDelete();
    //         } else {
    //         return back()->with('_failure', 'Esta mascota no esta en tus favoritos!');
    //     }
    // }

}
