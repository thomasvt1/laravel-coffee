<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $cups = \App\Cup::where('user_id', '=', Auth::user()->id);
        $users = \App\User::all();
        $machines = \App\Machine::all();
        $drinks = \App\Drink::all();
        $cups_id = $cups->pluck('id');
        $preferences = \App\Preference::all()->whereIn('cup_id',$cups->pluck('id'));
        return view('dashboard', ['cups' => $cups, 'users' => $users, 'machines' => $machines, 'drinks' => $drinks, 'preferences'=>$preferences]);

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
