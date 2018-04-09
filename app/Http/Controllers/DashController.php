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

        $cups = \App\Cup::where('user_id', '=', Auth::user()->id);
        $users = \App\User::all();
        $machines = \App\Machine::all();
        $drinks = \App\Drink::all();
        $preferences = \App\Preference::all()->whereIn('cup_id',$cups->pluck('id'));
        return view('dashboard', ['cups' => $cups, 'users' => $users, 'machines' => $machines, 'drinks' => $drinks, 'preferences'=>$preferences]);

    }
   
    
    public function update(Request $request)
    {
        //of gekozen drank volume <= gekozen cup volume
        //$cup_volume = \App\Cup::where('cup_id', '=', $request->input('cup');
        
        
        $volume = $drinks->firstWhere('id', $request->input('drink')->volume;
        
        //$request->input('cup') $request->input('drink')
        \App\Preference::where('id', '=', $request->input('cup'))->update(array('drink_id' => $request->input('drink')));
        return DashController::index();        // Make sure you've got the Page model
    }
}
