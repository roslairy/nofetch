<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('test1', 'Test@test1');
Route::get('test2', 'Test@test2');
Route::get('test3', 'Test@test3');
Route::get('all', 'Test@all');
