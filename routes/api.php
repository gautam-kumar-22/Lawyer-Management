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

Route::group(['as' => 'api.'], function () {
	Route::group(['as' => 'select.', 'prefix' => 'select'], function () {
		Route::get('/division', 'Api\SelectController@division')->name('division');
		Route::post('/state', 'Api\SelectController@state')->name('state');
		Route::post('/city', 'Api\SelectController@city')->name('city');
		Route::post('/court', 'Api\SelectController@court')->name('court');
	});
});