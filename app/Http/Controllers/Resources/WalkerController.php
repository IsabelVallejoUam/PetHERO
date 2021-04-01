<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Walker;
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
        //
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
    public function store(Request $request)
    {
        $walker = new Walker();
        $walker->experience = $request->input('experience');
        $walker->user_id = Auth::id();
        $walker->save();

        $existingUser = DB::table('users')->where('document', '=', $request->input('document'));
        if($existingUser === null){
        // if (User::where('document', '=', Input::get('documnt'))->exists())    
        $user = new User();
        $user->name =  $request->input('name');
        $user->lastname =  $request->input('lastname');
        $user->email =  $request->input('email');
        $user->password =  $request->input('password');
        $user->document =  $request->input('document');
        $user->phone =  $request->input('phone');
        $user->address =  $request->input('address');
        $user->name =  $request->input('name');
        $user->save();

        } 
        return redirect(route('links.index'))->with('_success', '¡Enlace creado exitosamente!');
        
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
    public function destroy($id)
    {
        //
    }
}
