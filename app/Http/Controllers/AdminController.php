<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Session;

class AdminController extends Controller
{
    public function login()
    {
    	return view('admin.login');
    }

    public function makeLogin(Request $request)
    {
    	$data = array(
    			'email' => $request->email,
    			'password' => $request->password,
    			'role' => '1'
    	);
        
        
    	if (Auth::guard('admin')->attempt($data) == true) {
    		return redirect()->route('admin.dashboard');
            Session::put('data',$data);
    	}
    	else{
    		return back()->withErrors(['message' => 'invalid email or password']);
    	}
    }

    public function dashboard(){
    	return view('admin.dashboard');
    }

    public function logout(){
    	Auth::logout();
    	return redirect()->route('admin.login');
    }
}
