<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\StoreOwner;
use App\Models\Store;
use App\Http\Requests\StoreOwnerRequest;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Image;

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
       
        $user = Auth::user();
        $stores = Store::where('owner_id','=',Auth::id())->get();
       
        return view('storeOwner.index', compact(['storeOwner','user','stores']));
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

        if ($existingUser == false){  
            $user = new User();  
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
            }
            $user->save();
        } 

        $storeOwner = new StoreOwner();
        $foregin_id= User::select('id')->where('document', '=', $request->input('document'))->value('id');
        $storeOwner->user_id = $foregin_id;
        $storeOwner->save();

        return redirect()->route('storeOwner.show', [$user])->with('_success', '¡Perfil creado exitosamente!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(StoreOwner $storeOwner)
    {
        $user = User::findOrFail($storeOwner->user_id);
        $stores = Store::where('owner_id','=',Auth::id())->get();

        return view('storeOwner.show', compact(['storeOwner','user','stores']));
        
    }

       /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function profile(StoreOwner $storeOwner)
    {
        $storeOwner = StoreOwner::where('user_id',Auth::id())->first();
        $user = User::findOrFail($storeOwner->user_id);
        $stores = Store::where('owner_id','=',$storeOwner->user_id)->get();

        return view('storeOwner.perfil', compact('storeOwner', 'user','stores'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(StoreOwner $storeOwner)
    {
        $storeOwner = StoreOwner::where('user_id',Auth::id())->first();
        $user = User::findOrFail($storeOwner->user_id);

        return view('storeOwner.edit', compact('storeOwner','user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreOwnerRequest $request,  UserRequest $request2, StoreOwner $storeOwner)
    {
        $user = User::findOrFail($storeOwner->user_id);
        $storeOwner = StoreOwner::where('user_id',Auth::id())->first();
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
            $newpassword =  $request2->input('newpassword');
            $newpasswordconf =  $request2->input('newpasswordconfirmation');
            if($newpassword == $newpasswordconf){
                $user->password =  Hash::make($request2->input('newpassword'));
                $user->save();
                return redirect(route('storeOwner.show', [$user,$storeOwner]))->with('_success', 'Perfil editado exitosamente!') ;
            } else {
                return back()->with('_failure', 'Las contraseñas no coinciden');
            }
        } else {
            $user->save();
            return redirect(route('storeOwner.show', [$user,$storeOwner]))->with('_success', 'Perfil editado exitosamente!') ;
        }
        
       
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(StoreOwner $storeOwner)
    {
        if($storeOwner->user_id == Auth::id())
        {
            $storeOwner->delete();

            return redirect()->route('/')->with('_success', 'Perfil de paseador eliminado exitosamente!');
        }
        
        return back()->with('_failure', '¡No tiene permiso de borrar ese perfil!');
    }

    public function login()
    {
        return view('storeOwner.login');
    }

}
