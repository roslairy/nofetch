<?php
use Illuminate\Support\Facades\Hash;
/*
 * |--------------------------------------------------------------------------
 * | Application Routes
 * |--------------------------------------------------------------------------
 * |
 * | Here is where you can register all of the routes for an application.
 * | It's a breeze. Simply tell Laravel the URIs it should respond to
 * | and give it the controller to call when that URI is requested.
 * |
 */

Route::get ( '/', [ 'as' => 'login', 'uses' => 'MyAuth@login' ] );
Route::post ( 'loginCheck', [ 'as' => 'loginCheck', 'uses' => 'MyAuth@loginCheck' ] );
Route::group ( [ 'middleware' => [ 'auth' ]  ], function () {
	Route::get ( 'logout', [  'as' => 'logout', 'uses' => 'MyAuth@logout' ] );
	Route::get ( 'main', [ 'as' => 'main', 'uses' => 'Admin@main' ] );
	Route::get ( 'novel', [ 'as' => 'novel', 'uses' => 'Admin@novel' ] );
	Route::get ( 'chapter', [ 'as' => 'chapter', 'uses' => 'Admin@chapter' ] );
	Route::get ( 'mail', [ 'as' => 'mail', 'uses' => 'Admin@mail' ] );
	Route::get ( 'setting', [ 'as' => 'setting', 'uses' => 'Admin@setting' ] );
	Route::post( 'settingSave', [ 'as' => 'settingSave', 'uses' => 'Admin@settingSave' ] );
	Route::get ( 'settingReset', [ 'as' => 'settingReset', 'uses' => 'Admin@settingReset' ] );
	Route::get ( 'edit', [ 'as' => 'edit', 'uses' => 'Admin@edit' ] );
	Route::post( 'editSave', [ 'as' => 'editSave', 'uses' => 'Admin@editSave' ] );
	Route::get ( 'novelPause', [ 'as' => 'novelPause', 'uses' => 'Admin@novelPause' ] );
	Route::get ( 'novelResume', [ 'as' => 'novelResume', 'uses' => 'Admin@novelResume' ] );
	Route::get ( 'novelDelete', [ 'as' => 'novelDelete', 'uses' => 'Admin@novelDelete' ] );
} );

Route::get ( 'gpass', function () {
	echo Hash::make ( Input::get ( 'pass' ) );
} );

Route::get ( 'test1', 'Test@test1' );
Route::get ( 'test2', 'Test@test2' );
Route::get ( 'test3', 'Test@test3' );
Route::get ( 'all', 'Test@all' );
Route::get ( 'push', 'Test@pushOne' );

Route::get('/send', 'Admin@sendView');
Route::post('/sendFile', 'Admin@send');
