<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomizeController extends Controller
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
        $user_cups = $cups->where('user_id', '=', Auth::user()->id);
        $users = \App\User::all();
        $machines = \App\Machine::all();
        $drinks = \App\Drink::all();
        $preferences = \App\Preference::all()->whereIn('cup_id', $user_cups->pluck('id'));
        return view('customize', ['user_cups' => $user_cups, 'cups' => $cups, 'users' => $users, 'machines' => $machines, 'drinks' => $drinks, 'preferences' => $preferences]);

    }


    public function update(Request $request)
    {

        $newname = $request->input('newname');
        
        if (strlen($newname) > 12 || strlen($newname) < 4)
            return back()->with('warning', 'Please choose a name between 3 and 12 characters.');
        
        
        \App\Cup::where('id', '=', $request->input('cup'))->where('user_id', '=', Auth::user()->id)->update(array('name' => $request->input('newname')));
        
        return back()->with('success', 'Preference updated successfully.');
        

    }
    
    public function addCup(Request $request)
    {
        if($request->input('newuid')!= "" && $request->input('newuid') != "" ){
            if(strlen($request->input('newuid'))== 8 || strlen($request->input('newuid'))== 6 ){
                \App\Cup::insert(['user_id' => Auth::user()->id, 'volume' => 400, 'uid' => $request->input('newuid'), 'name' => $request->input('cupname')]);
                return back()->with('success', 'Preference updated successfully.');
            } else {
                return back()->with('warning', 'Please enter a valid UID');
            }
        } else {
            return back()->with('warning', 'Please fill in all fields.');
        }
    }
    
}
