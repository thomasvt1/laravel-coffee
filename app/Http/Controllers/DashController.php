<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {    
        $cups = \App\Cup::all();
        return view('dashboard', ['cups' => $cups]);
        
        $users = \App\User::all();
        return view('dashboard', ['users' => $users]);
        
        $machines = \App\Machine::all();
        return view('dashboard', ['machines' => $machines]);
        

        
        $drinks = \App\Drink::all();
        return view('dashboard', ['drinks' => $drinks]);
        
        
        
    }
}
