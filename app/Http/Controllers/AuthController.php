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
        } else {
            // invalid request method.
            abor('405');
        }
    }

    public function register()
    {
        if (request()->isMethod('get')) {
            // displays the registration page.
            return view('auth.register');
        } else if (request()->isMethod('post')) {
            // validates the register information
        } else {
            // invalid request method.
            abor('405');
        }
    }

    public function logout()
    {
        \Auth::logout();
        return redirect()->route('auth.login')->with('status', "Logged out successfully.");
    }
}
