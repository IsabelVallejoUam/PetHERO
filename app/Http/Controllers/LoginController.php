<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class LoginController extends Controller{
    public function authenticate(Request $request){
        // Retrive Input
        $credentials = $request->only('email', 'password');

        $exsitingProfile = DB::select('SELECT :PERFIL.*, users.* FROM users 
        JOIN :PERFIL WHERE users.email =:email AND users.id = PERFIL.user_id', ['email' => $request->input('email'), 'perfil' =>$request->input('perfil')]);
          
        
        if (Auth::attempt($credentials) && count($exsitingProfile)>0) {
            // if success login

            return redirect('home');

            //return redirect()->intended('/details');
        }
        // if failed login
        return redirect('login');
    }
}
