<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;

class MyAuth extends Controller {
	public function login() {
		$error = Input::get ( 'error', '' );
		return view ( 'login', [ 
				'error' => $error 
		] );
	}
	public function loginCheck() {
		$v = Validator::make ( Input::all (), [ 
				'username' => 'required',
				'password' => 'required' 
		] );
		
		if ($v->fails ()) {
			return redirect ()->route ( 'login', [ 
					'error' => '不正确的输入值' 
			] );
		}
		
		if (! Auth::attempt ( [ 
				'email' => Input::get ( 'username' ),
				'password' => Input::get ( 'password' ) 
		] )) {
			return redirect ()->route ( 'login', [ 
					'error' => '用户名或密码错误' 
			] );
		} else {
			return redirect ()->route ( 'main' );
		}
	}
	public function logout() {
		Auth::logout ();
		return redirect ()->route ( 'login' );
	}
}
