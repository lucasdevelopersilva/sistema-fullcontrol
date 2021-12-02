<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller {

    //

    public function index() {
        if (Auth::check() === true) {
            return redirect('dashboard');
        }
        return view("backend.index");
    }

    public function loginForm() {
        return view("backend.index");
    }

    public function login(Request $request) {
        if (!filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            return redirect()->back()->with("message", "E-mail informado não é válido");
        }
        $credencials = [
          'email'=>$request->email,  
          'password'=>$request->password,  
        ];
         
        if(Auth::attempt($credencials)){
            return redirect('dashboard');
        }
       return redirect()->back()->withInput()->with("message", "Os dados informados não estão corretos");
    }
    
    public function logout(){
        Auth::logout();
        return redirect("/");
    }

}
