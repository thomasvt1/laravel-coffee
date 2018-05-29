<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('special/{id}', function($id) {
    // Get cup
    $id = strtolower($id);
    $cup = App\Cup::where("uid", $id)->first();
    // Get preference
    $preference = App\Preference::where('cup_id', $cup->id)->first();
    $preference_data = json_decode($preference->data);
    $drink = $preference->drink;
    $drink_data = json_decode($drink->data);
    // Set id
    $id = $drink_data->id;
    $result = [ "K".$id."K".$id ];
    // Append stength
    if(isset($preference_data->strength)) {
        array_push($result, "B00B00".$preference_data->strength);
    }
    // Start
    array_push($result, "K34K34");
    // Format
    $final = [];
    $final["serial"] = $result;
    // Return
    return $final;
});