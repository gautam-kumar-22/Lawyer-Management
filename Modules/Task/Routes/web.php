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

Route::middleware(['auth'])->group(function(){

    Route::resource('task', 'TaskController')->middleware('permission');
    Route::get('my-task', 'TaskController@myTask')->name('my-task');
    Route::get('completed-task','TaskController@completed')->name('completed-task');
    Route::get('task-mark-completed/{id}','TaskController@taskMarkcompleted')->name('task.completed');
});
