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
        $days = ['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'];
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
        
        
        return view('dashboard', ['user_cups' => $user_cups, 'cups' => $cups, 'users' => $users, 'machines' => $machines, 'drinks' => $drinks, 'preferences' => $preferences, 'time' => $time, 'days' => $days]);

    }
    



    public function update(Request $request)
    {
        //of gekozen drank volume <= gekozen cup volume
        //$cup_volume = \App\Cup::where('cup_id', '=', $request->input('cup');
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
        $cup_volume = \App\Cup::where('id', $request->input('cup'))->value('volume');
        $drink_volume = \App\Drink::where('id', $request->input('drink'))->value('volume');
        if ($cup_volume >= $drink_volume) {
            
            if($request->input('startTime') != null && $request->input('endTime') != null) {
                if ($request->input('startTime') < $request->input('endTime')){
                    
                    $startTime = $time[$request->input('startTime')];
                    $endTime = $time[$request->input('endTime')];
                }else{
                    return back()->with('warning', "Your start time is bigger than your end time.");
                }
            }
            
            $preference = \App\Preference::where('cup_id', $request->input('cup'))->first();

            if ($preference != ""){            
                $preference_data = json_decode($preference->data, true);
            }

            $preference_data['strength'] = $request->input('strength');            
            $days = ['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'];
            $selected_day='';
            $first_time = 1;
            foreach ($days as $day){

                $checkbox = strval('checkbox' . $day);
                if ($request->input($checkbox) == 1){
                    if ($first_time == 1){
                        $selected_day = substr($day, 0, 3);
                        $first_time = 0;
                    }else{
                        $selected_day = $selected_day . ', ' . substr($day, 0, 3);  
                    }                      
                }
            }
            if($selected_day == '') {
                $selected_day = "Mon,Tue,Wed,Thu,Fri,Sat,Sun";
            }

            $insertedPreference = \App\Preference::insert(['cup_id' => $request->input('cup'), 'drink_id' => $request->input('drink'), 'data' => json_encode($preference_data), 'machine_id' => $request->input('location')]);
            $max_id = \App\Preference::all()->max('id');
            
            if(isset($startTime) && isset($endTime)) {
                \App\PreferenceTimes::insert(['preference_id' => $max_id, 'days' => $selected_day, 'start_time' => $startTime, 'end_time' => $endTime]);
                return back()->with('success', 'Preference updated successfully.');
            } else {
                \App\PreferenceTimes::insert(['preference_id' => $max_id, 'days' => $selected_day, 'start_time' => $time[0], 'end_time' => $time[47]]);
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
            $checkbox = strval('checkbox' . $preference->id);
            if ($request->input($checkbox) == 1){ 
                \App\PreferenceTimes::where('preference_id', $preference->id)->delete();
                \App\Preference::where('id', $preference->id)->delete();
               
                $deleted += 1; 
            }
        }
        if ($deleted != 0) {
            return back()->with('success',$deleted . ' preferences deleted.');
        } else {
            return back()->with('warning', 'No preferences selected.');
        }
    }
}            

//\App\Preference::where('id', '=', $request->input('cup'))->update(array('drink_id' => $request->input('drink')));
//\App\Preference::where('id', '=', $request->input('cup'))->update(array('data' =>json_encode($preference_data)));
