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

Route::get('/', 'DashController@index')->name('Dashboard');
Route::get('/customize', 'CustomizeController@index')->name('Your Mugs');


Auth::routes();
Route::post('/','DashController@update')->name('updateCup');
Route::post('/deletePrefCup','DashController@deletePref')->name('deletePrefCup');
Route::post('/customize','CustomizeController@update')->name('updateName');
Route::post('/addCup', 'CustomizeController@addCup')->name('addCup');
