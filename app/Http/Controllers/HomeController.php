<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
    	$this->middleware('guest');
    	return view('welcome');
    }

    public function dashboard()
    {
    	$this->middleware('auth');
    	return view('admin.dashboard');
    }
}
