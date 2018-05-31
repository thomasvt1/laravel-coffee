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

        
        $cups = \App\Cup::all();
        $user_cups = $cups->where('user_id', '=', Auth::user()->id);
        $users = \App\User::all();
        $machines = \App\Machine::all();
        $drinks = \App\Drink::all();
        $preferences = \App\Preference::all()->whereIn('cup_id', $user_cups->pluck('id'));
        return view('dashboard', ['user_cups' => $user_cups, 'cups' => $cups, 'users' => $users, 'machines' => $machines, 'drinks' => $drinks, 'preferences' => $preferences]);

    }


    public function update(Request $request)
    {
        //of gekozen drank volume <= gekozen cup volume
        //$cup_volume = \App\Cup::where('cup_id', '=', $request->input('cup');

        $cup_volume = \App\Cup::where('id', $request->input('cup'))->value('volume');
        $drink_volume = \App\Drink::where('id', $request->input('drink'))->value('volume');
        if ($cup_volume >= $drink_volume) {
            //$request->input('cup') $request->input('drink')
          
            $preference = \App\Preference::where('cup_id', $request->input('cup'))->first();
            $preference_data = json_decode($preference->data, true);

            $preference_data['strength'] = $request->input('strength');
            
            \App\Preference::where('id', '=', $request->input('cup'))->update(array('drink_id' => $request->input('drink')));
            \App\Preference::where('id', '=', $request->input('cup'))->update(array('data' =>json_encode($preference_data)));
            \App\Preference::create(['id' => $request->input('cup')], ['drink_id' => $request->input('drink')], ['data' => json_encode($preference_data)]);
            return back()->with('message', 'Preference updated successfully.');
        } else {
            return back()->with('message', "Your choice is too big for the selected cup. Cup volume: " . $cup_volume . ' drink volume: ' . $drink_volume . $request->input('strength') . '.');
        }
    }
}
