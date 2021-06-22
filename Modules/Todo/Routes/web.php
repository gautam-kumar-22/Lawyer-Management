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

Route::resource('to_dos','TodoController');
Route::get('complete-to-do','TodoController@completeToDo');
Route::get('remove-to-do','TodoController@completeToDo');
Route::get('get-to-do-list','TodoController@completeList');