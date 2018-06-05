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
        
        $time= array();
        $hours= 00;
        $minutes =00;
        array_push($time,'00:00');
        
        for ($x = 0; $x <= 46; $x++){
            
            $minutes = $minutes + 30;
            
            if ($minutes == 60){
                $hours++;
                $minutes = 00;
            }            
            array_push($time, sprintf('%0' . 2 . 's', $hours) . ':' . sprintf('%0' . 2 . 's', $minutes));
        }
        
        
        return view('dashboard', ['user_cups' => $user_cups, 'cups' => $cups, 'users' => $users, 'machines' => $machines, 'drinks' => $drinks, 'preferences' => $preferences, 'time' => $time]);

    }
    



    public function update(Request $request)
    {
        //of gekozen drank volume <= gekozen cup volume
        //$cup_volume = \App\Cup::where('cup_id', '=', $request->input('cup');

        $cup_volume = \App\Cup::where('id', $request->input('cup'))->value('volume');
        $drink_volume = \App\Drink::where('id', $request->input('drink'))->value('volume');
        if ($cup_volume >= $drink_volume) {
            if (($request->input('startTime')) >= ($request->input('endTime'))){
                return back()->with('warning', "Your start time is bigger than your end time.");
            }else{
            //$request->input('cup') $request->input('drink')
          
            $preference = \App\Preference::where('cup_id', $request->input('cup'))->first();
            $preference_data = json_decode($preference->data, true);

            $preference_data['strength'] = $request->input('strength');
            
            //\App\Preference::where('id', '=', $request->input('cup'))->update(array('drink_id' => $request->input('drink')));
            //\App\Preference::where('id', '=', $request->input('cup'))->update(array('data' =>json_encode($preference_data)));
            \App\Preference::insert(['cup_id' => $request->input('cup'), 'drink_id' => $request->input('drink'), 'data' => json_encode($preference_data)]);
            $max_id = \App\Preference::all()->max('id');
            \App\Preference_time::insert(['preference_id' => $max_id;
            return back()->with('success', 'Preference updated successfully.');
            }
        } else {
            return back()->with('warning', "Your choice is too big for the selected cup. Cup volume: " . $cup_volume . ' drink volume: ' . $drink_volume . '.');
        }
    }
    
    public function deletePref(Request $request)
    {
        $cups = \App\Cup::all();
        $user_cups = $cups->where('user_id', '=', Auth::user()->id);
        $preferences = \App\Preference::all()->whereIn('cup_id', $user_cups->pluck('id'));
        $deleted= 0;
        foreach ($preferences as $preference){
            //$request->input('checkbox' . $preference->cup_id);
            $checkbox = strval('checkbox' . $preference->id);
            if ($request->input($checkbox) == 1){
                \App\Preference::where('id', $preference->id)->delete();
                $deleted += 1;
            }
                
            //$deleted +=  strval($request->input('checkbox' . $preference->cup_id));
            //array_push($deleted, $request->input('checkbox' . $preference->cup_id));
        }
        if ($deleted != 0) {
            return back()->with('success',$deleted . ' preferences deleted.');
        } else {
            return back()->with('warning', 'No preferences selected.');
        }
    }
}
