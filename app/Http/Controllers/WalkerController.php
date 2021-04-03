<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Walker;
use App\Http\Requests\WalkerRequest;
use App\Http\Requests\UserRequest;

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
        $walker = Walker::ownedBy(Auth::id());

        return view('walker.index', compact('walker'));
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
        $user->password =  $request2->input('password');
        $user->document =  $request2->input('document');
        $user->phone =  $request2->input('phone');
        $user->save();
        } 

        $walker = new Walker();
        $walker->experience = $request->input('experience');
        echo (User::all());
        $foregin_id= User::select('id')->where('document', '=', $request->input('document'))->value('id');
        echo ($foregin_id);
        $walker->user_id = $foregin_id;
        $walker->save();


        return redirect(route('walker.index'))->with('_success', '¡Perfil creado exitosamente!');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('walker.show', compact('link'));
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('walker.edit', compact('link'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(WalkerRequest $request, Walker $walker, User $user)
    {

        $walker->experience = $request->input('experience');
        $walker->save();

        $user->name =  $request->input('name');
        $user->lastname =  $request->input('lastname');
        $user->email =  $request->input('email');
        $user->password =  $request->input('password');
        $user->document =  $request->input('document');
        $user->phone =  $request->input('phone');
        $user->address =  $request->input('address');
        $user->save();

        return redirect(route('walker.index'))->with('_success', 'Perfil editado exitosamente!');

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Walker $walker)
    {
        if($walker->owner->id == Auth::id())
        {
            $walker->delete();

            return back()->with('_success', 'Perfil de paseador eliminado exitosamente!');
        }
        
        return back()->with('_failure', '¡No tiene permiso de borrar ese perfil!');
    }
}
