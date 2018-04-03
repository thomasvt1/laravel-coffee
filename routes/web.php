<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('dashboard');
})->middleware('auth');

Route::get('/test', function() {
    $users = \App\User::all();
    //return dd($users);
    foreach ($users as $user) {
        echo $user->name . "<br />";
    }
    return view('dashboard', ['users' => $users]);
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
