<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;

class LoginController extends Controller
{
    public function login(Request $request){
    	//dd($request->all());
		if($request->isMethod('post')) {

			$this->validate($request, [
				'email'    => 'required|email',
				'password' => 'required|max:30',
				'remember' => 'in:remember', // si checked bonne valeur
		 	]); 	

			$remember = $request->input('remember')? true : false; // rester connecter ou pas
			$credentials = $request->only('email', 'password');

			if(Auth::attempt($credentials, $remember)) {
				return redirect('dashboard')->with([
		    		'message' => "vous etes bien connecté !",
		    	]);
			}else {
				return back()->withInput($request->only('email', 'remember'))->with([
					'message'=> "Votre mot de passe ou votre login est incorrect !",
				]);
			}

    	}else{
    		return view('auth.login');
    	}
    }


}
