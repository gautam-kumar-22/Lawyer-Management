<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth']], function(){
    Route::prefix('localization')->group(function() {

        // Route::middleware('permission')->group(function(){
                Route::get('/', 'LanguageController@index')->name('languages.index');
                Route::get('/languages/destroy/{id}', 'LanguageController@destroy')->name('languages.destroy');
                Route::post('/edit', 'LanguageController@edit')->name('languages.edit');
                Route::post('/store', 'LanguageController@store')->name('languages.store');
                Route::put('/update/{id}', 'LanguageController@update')->name('languages.update');
                Route::get('/translate-view/{id}', 'LanguageController@show')->name('language.translate_view');
                Route::post('/update-active-status', 'LanguageController@update_active_status')->name('languages.update_active_status');
                Route::post('/set-language', 'LanguageController@changeLanguage')->name('language.change');

        // });
        

        Route::post('/update-rtl-status', 'LanguageController@update_rtl_status')->name('languages.update_rtl_status');
    	Route::post('/languages/key_value_store', 'LanguageController@key_value_store')->name('languages.key_value_store');
        Route::post('/get-translate-file', 'LanguageController@get_translate_file')->name('language.get_translate_file');
        Route::get('/search', 'LanguageController@index')->name('languages.search_index');
    });
});