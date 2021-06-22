<?php

use Illuminate\Support\Facades\Route;



Route::prefix('setting')->middleware('auth')->group(function() {

    Route::get('/', 'SettingController@index')->name('setting.index')->middleware('permission');
    Route::post('/update-activation-status', 'SettingController@update_activation_status')->name('update_activation_status');

    Route::post('general-settings/update', 'GeneralSettingsController@update')->name('company_information_update');

    Route::post('template/update', 'GeneralSettingsController@template_update')->name('template_update');
    Route::post('general-setting-footer/update', 'GeneralSettingsController@footer_update')->name('general_setting_footer_update');
    Route::post('smtp-gateway-credentials/update', 'GeneralSettingsController@smtp_gateway_credentials_update')->name('smtp_gateway_credentials_update');

    Route::post('sms-demo-send', 'GeneralSettingsController@sms_send_demo')->name('sms_send_demo');
	Route::post('/test-mail/send', 'GeneralSettingsController@test_mail_send')->name('test_mail.send');

    Route::post('config-update','ConfigController@updateInfo')->name('config.update');

    Route::post('login_backgroud_image', 'ConfigController@updateLoginBG')->name('updateLoginBG');

});
Route::group(['middleware' => 'auth'], function(){
    Route::get('utilities', [\Modules\Setting\Http\Controllers\UtilitiesController::class, 'index'])->name('utilities');
});
