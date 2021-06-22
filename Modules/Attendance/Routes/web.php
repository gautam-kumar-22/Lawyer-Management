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


use Illuminate\Support\Facades\Route;

Route::prefix('attendance')->middleware('auth')->group(function () {
   

    Route::prefix('hr')->group(function () {
        Route::group(['prefix' => '/attendance', 'middleware' => 'permission'], function () {
            Route::get('/', 'AttendanceController@index')->name('attendances.index');
            Route::post('/store', 'AttendanceController@store')->name('attendances.store');
            
            Route::get('/report-index', 'AttendanceReportController@index')->name('attendance_report.index');
        });
    });

   

    Route::prefix('attendance')->group(function () {
        Route::post('/get-user-by-role', 'AttendanceController@get_user_by_role')->name('get_user_by_role');
        Route::get('/report-index/search', 'AttendanceReportController@reports')->name('attendance_report.search');
        Route::get('/attendence-report-print/{role_id}/{month}/{year}', 'AttendanceReportController@attendance_report_print')->name('attendance_report_print');
    });
});

Route::resource('to_dos','ToDoController');
Route::get('complete-to-do','ToDoController@completeToDo');
Route::get('get-to-do-list','ToDoController@completeList');
Route::resource('events','EventController');
Route::get('events-delete/{id}','EventController@destroy')->name('events.delete');
