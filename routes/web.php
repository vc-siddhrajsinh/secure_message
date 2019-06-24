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
    Route::get('/guest/{token?}', "MessageController@guestLogin")->name("guest.login");
//    Route::get('/guest/dashboard', "MessageController@guestDashboard")->name("guest.dashboard");

    Route::get('/', "MessageController@index");
    Route::get('/home', "MessageController@home")->name('home');
    Route::get('/home', 'MessageController@index')->name('message.index');

    Route::resource("messages","MessageController");
    Route::get("message/{token}","MessageController@show")->name('message.show');
    Route::post("message","MessageController@validatePassword")->name('message.password');
});


Auth::routes();


