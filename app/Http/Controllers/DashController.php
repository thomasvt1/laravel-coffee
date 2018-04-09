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
   /*  App\SomeModel::whereIn('abc', ['a', 'b', 'c'])->get();
    App\SomeModel::where('abc', 'a')->orWhere('abc', 'b')->orWhere('abc', 'c')->get();
    DB::table('users')->where('name', 'John')->value('email');
    DB::table('users')->where('name', 'John'); */
        $cups = \App\Cup::where('user_id', '=', middleware('Auth')::user()->id);
        $users = \App\User::all();
        $machines = \App\Machine::all();
        $drinks = \App\Drink::all();
        $preferences = \App\Preference::all();
        return view('dashboard', ['cups' => $cups, 'users' => $users, 'machines' => $machines, 'drinks' => $drinks, 'preferences'=>$preferences]);
        
        $users = \App\User::all();
        return view('dashboard', ['users' => $users]);
        
        $machines = \App\Machine::all();
        return view('dashboard', ['machines' => $machines]);
        

        
        $drinks = \App\Drink::all();
        return view('dashboard', ['drinks' => $drinks]);
    }
   
    
    public function update(Request $request)
    {
        \App\Preference::where('id', '=', $request->input('cup'))->update(array('drink_id' => $request->input('drink')));
        
        //return $request->all();
        return DashController::index();        // Make sure you've got the Page model
        //if($preferences) {
        //$preferences->;
       // $preferences->save();
        //} 

    }
}
