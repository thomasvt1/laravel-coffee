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

Route::get('/', 'DashController@index')->name('/');

Auth::routes();
Route::post(,'DashController@update')->name('updateName');
//Route::group(['namespace' => 'DashController',], function () {
//Route::post('/',['as'=>'Dashcontroller.update', 'uses'=>'DashController@update']);


