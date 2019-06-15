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

/*Route::get('/', function () {
    return view('welcome');
});*/



Route::group(["namespace" => "Frontend", 'as' => 'frontend.'], function() {
    Route::get('/guest', "MessageController@guestLogin")->name("guest.login");
    Route::get('/', "MessageController@index");
    Route::get('/home', "MessageController@home")->name('home');
    Route::get('/home', 'MessageController@index')->name('home');
});


Auth::routes();


