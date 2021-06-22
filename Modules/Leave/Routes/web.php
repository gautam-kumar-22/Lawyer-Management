<?php

use Illuminate\Support\Facades\Route;

Route::prefix('leave')->middleware('auth')->group(function() {
    Route::get('/', 'LeaveController@index')->name('apply_leave.index');
    Route::post('/store', 'LeaveController@store')->name('apply_leave.store');
    Route::post('/edit', 'LeaveController@edit')->name('apply_leave.edit');
    Route::get('/carry-forward', 'LeaveController@carryForward')->name('carry.forward');
    Route::get('/generate-carry-forward', 'LeaveController@generateCarryForward')->name('generate.carry.forward');
    Route::post('{id}/update', 'LeaveController@update')->name('apply_leave.update');
    Route::post('carry-forward/add', 'LeaveController@updateCarryForward')->name('carry.forward.update');
    Route::get('/destroy/{id}', 'LeaveController@destroy')->name('apply_leave.destroy');
    Route::post('/view', 'LeaveController@show')->name('apply_leave.view');
    Route::get('/pending', 'LeaveController@pending_index')->name('pending_index');
    Route::get('/leave-application/download/{id}', 'LeaveController@downloadLeaveApplication')->name('leave.application.download');


    Route::middleware('permission')->group(function(){

        Route::get('/approved', 'LeaveController@approved_index')->name('approved_index');
        Route::post('/change-approval', 'LeaveController@change_approval')->name('set_approval_leave');

        Route::get('/define-lists', 'LeaveDefineController@index')->name('leave_define.index');
        Route::post('/define-store', 'LeaveDefineController@store')->name('leave_define.store');
        Route::post('/define-update', 'LeaveDefineController@update')->name('leave_define.update');
        Route::post('/define-delete', 'LeaveDefineController@delete')->name('leave_define.delete');

        Route::get('/types', 'LeaveTypeController@index')->name('leave_types.index');
        Route::post('/types-store', 'LeaveTypeController@store')->name('leave_types.store');
        Route::post('/types-update', 'LeaveTypeController@update')->name('leave_types.update');
        Route::post('/types-delete', 'LeaveTypeController@delete')->name('leave_types.delete');


        Route::resource('holidays', 'HolidayController');
        Route::post('/add-row', 'HolidayController@addRow')->name('add.row');
        Route::post('/holiday/add', 'HolidayController@holidayAdd')->name('holiday.add');
        Route::get('/holiday/delete/{year}', 'HolidayController@holidayDelete')->name('holiday.delete');
        Route::post('/last-year-data', 'HolidayController@getLastYearData')->name('last.year.data');
        Route::get('/year/details/{id}', 'HolidayController@yearData')->name('year.data');
        Route::get('/view/year/details/{id}', 'HolidayController@viewYearData')->name('view.year.data');
    });
});
