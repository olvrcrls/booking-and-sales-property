<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class AuthController extends Controller
{
    public function login()
    {
    	if (request()->isMethod('get')) {
    		// if the request method is a 'GET'
    		return view('auth.login');
    	} else if (request()->isMethod('post')) {
    		$authenticated = Auth::attempt([
                        'user_email' => request('username'), 
                        'password' => request('password'),
                        'user_active' => 1
                        ]);
    		if ($authenticated) {
    			// redirect to dashboard
    		} else {
    			redirect()->route('auth.login')->with('status', "Invalid credentials.");
    		}
    	} else {
    		// invalid request method.
    		abort('405');
    	}
    } // public function login()

    public function reset()
    {
        if (request()->isMethod('get')) {
            // display reset password view
        } else if (request()->isMethod('post')) {
            // validates then resets password
        }
    }
}
